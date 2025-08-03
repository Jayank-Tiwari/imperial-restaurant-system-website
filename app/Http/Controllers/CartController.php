<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('menuItem')
            ->where('user_id', Auth::id())
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request)
    {
        try {
            // Check if user is authenticated
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
            
            // Check if item already exists in cart
            $cartItem = CartItem::where('user_id', auth()->id())
                           ->where('menu_item_id', $request->menu_item_id)
                           ->first();

            if ($cartItem) {
                // Update quantity if item exists
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                // Create new cart item
                CartItem::create([
                    'user_id' => auth()->id(),
                    'menu_item_id' => $request->menu_item_id,
                    'quantity' => $request->quantity
                ]);
            }

            // Get updated cart count
            $cartCount = CartItem::where('user_id', auth()->id())->sum('quantity');

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

    public function update(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($request->input('action') === 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->input('action') === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        }

        $cartItem->save();

        return redirect()->route('cart.index');
    }


    public function remove($id)
    {
        CartItem::where('id', $id)->where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index');
    }
}
