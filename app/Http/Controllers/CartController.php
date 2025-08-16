<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the contents of the cart.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('menuItem')->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->menuItem->price * $item->quantity;
        });

        $isEligibleForDiscount = !$user->has_one_time_discount;
        $discountAmount = 0;
        $discountPercentage = 0;
        $finalTotal = $subtotal;

        if ($isEligibleForDiscount && !$cartItems->isEmpty()) {
            // Generate a random discount percentage to display to the user.
            $discountPercentage = rand(15, 20);
            $discountAmount = ($subtotal * $discountPercentage) / 100;
            $finalTotal = $subtotal - $discountAmount;
        }

        return view('cart.index', compact(
            'cartItems',
            'subtotal',
            'isEligibleForDiscount',
            'discountAmount',
            'discountPercentage',
            'finalTotal'
        ));
    }

    /**
     * Add an item to the cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please log in to add items to cart'
                ], 401);
            }

            $request->validate([
                'menu_item_id' => 'required|exists:menu_items,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $menuItem = MenuItem::findOrFail($request->menu_item_id);
            
            $cartItem = CartItem::where('user_id', auth()->id())
                                  ->where('menu_item_id', $request->menu_item_id)
                                  ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                CartItem::create([
                    'user_id' => auth()->id(),
                    'menu_item_id' => $request->menu_item_id,
                    'quantity' => $request->quantity
                ]);
            }

            // Get updated cart item count (not quantity sum)
            $cartCount = CartItem::where('user_id', auth()->id())->count();

            return response()->json([
                'success' => true,
                'message' => 'Item added to cart successfully',
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            \Log::error('Cart add error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to add item to cart'
            ], 500);
        }
    }

    /**
     * Update the quantity of a cart item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $cartItem = CartItem::where('user_id', auth()->id())->findOrFail($id);
            
            if ($request->has('action')) {
                $action = $request->input('action');
                
                if ($action === 'increase') {
                    $cartItem->quantity += 1;
                    $cartItem->save();
                } elseif ($action === 'decrease') {
                    if ($cartItem->quantity > 1) {
                        $cartItem->quantity -= 1;
                        $cartItem->save();
                    } else {
                        $cartItem->delete();
                    }
                }
                
                return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
                
            } else {
                $request->validate([
                    'quantity' => 'required|integer|min:1|max:99'
                ]);

                $cartItem->update(['quantity' => $request->quantity]);

                // Get updated cart item count (not quantity sum)
                $cartCount = CartItem::where('user_id', auth()->id())->count();

                return response()->json([
                    'success' => true,
                    'message' => 'Cart updated successfully',
                    'cart_count' => $cartCount
                ]);
            }

        } catch (\Exception $e) {
            \Log::error('Cart update error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update cart'
                ], 500);
            }
            
            return redirect()->route('cart.index')->with('error', 'Failed to update cart');
        }
    }

    /**
     * Remove an item from the cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        try {
            $cartItem = CartItem::where('user_id', auth()->id())->findOrFail($id);
            $cartItem->delete();

            // Get updated cart item count (not quantity sum)
            $cartCount = CartItem::where('user_id', auth()->id())->count();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart',
                    'cart_count' => $cartCount
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Item removed from cart');

        } catch (\Exception $e) {
            \Log::error('Cart remove error: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove item'
                ], 500);
            }
            
            return redirect()->route('cart.index')->with('error', 'Failed to remove item');
        }
    }

    /**
     * Get the number of items in the cart.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCount()
    {
        if (!auth()->check()) {
            return response()->json(['cart_count' => 0]);
        }

        // Return count of unique items, not total quantity
        $cartCount = CartItem::where('user_id', auth()->id())->count();
        return response()->json(['cart_count' => $cartCount]);
    }
}
