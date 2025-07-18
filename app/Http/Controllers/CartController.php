<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
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
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $cartItem = CartItem::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'menu_item_id' => $request->menu_item_id
            ],
            [
                'quantity' => $request->quantity ?? 1
            ]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        }

        return response()->json(['message' => 'Item added to cart successfully']);
    }

    // app/Http/Controllers/CartController.php

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
