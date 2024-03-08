<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DetailCart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $productId = $request->input('product_id');
        $customerId = $request->input('customer_id');

        $adminId = 1;
        $customerId = auth()->user()->id;

        $cart = Cart::where('customer_id', $customerId)->first();

        if (!$cart) {
            $cart = Cart::create([
                'admin_id' => $adminId,
                'customer_id' => $customerId,
                'total_price' => 0,
            ]);
        }

        $product = Product::findOrFail($productId);
        $detailCart = DetailCart::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($detailCart) {
            $detailCart->amount++;
            $detailCart->total_price = $detailCart->amount * $detailCart->price;
            $detailCart->save();
        } else {
            $detailCart = new DetailCart([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'price' => $product->price,
                'discount' => $product->discount->discount ?? 0,
                'amount' => 1,
                'total_price' => $product->price
            ]);
            $detailCart->save();
        }

        $cartTotalPrice = DetailCart::where('cart_id', $cart->id)->sum('total_price');
        $cart->total_price = $cartTotalPrice;
        $cart->save();

        return redirect()->back();
    }

    public function destroy($cartId, $productId)
    {
        $cart = Cart::where('id', $cartId)->first();

        $detailCart = DetailCart::where('cart_id', $cartId)
            ->where('product_id', $productId)
            ->first();

        $newTotalPrice = $cart->total_price - $detailCart->total_price;

        $cart->update(['total_price' => $newTotalPrice]);

        $detailCart->delete();

        return redirect()->back();
    }
}
