<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DetailCart;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $productId = $request->input('product_id');
            $customerId = auth()->user()->id;
            $total_price = $request->input('total_price');
            $status = 4;
            $amountValue = $request->input('amountValue');
            $priceValue = $request->input('priceValue');
            $discountValue = $request->input('discountValue');
            $totalValue = $request->input('totalValue');

            $adminId = 1;
            $customerId = $customerId;

            $order = Order::where('customer_id', $customerId)->first();

            if (!$order) {
                $order = Order::create([
                    'admin_id' => $adminId,
                    'customer_id' => $customerId,
                    'total_price' => $total_price,
                    'status' => $status
                ]);
            }

            $detailOrder = new DetailOrder([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $priceValue,
                'discount' => $discountValue,
                'amount' => $amountValue,
                'total_price' => $totalValue
            ]);

            $detailOrder->save();

            $cart = Cart::where('customer_id', $customerId)->first();
            $detailCart = DetailCart::where('cart_id', $cart->id)->get();

            if ($cart) {
                $detailCart = DetailCart::where('cart_id', $cart->id)->get();

                if ($cart->total_price == $order->total_price) {
                    foreach ($detailCart as $detail) {
                        $detail->delete();
                    }

                    $cart->delete();
                }
            }

            DB::commit();

            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function cancel(Order $order)
    {
        $order->update([
            'status' => 3
        ]);

        return redirect()->back();
    }
}
