<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $orders = Order::with('customer')->latest()->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    return $row->customer ? $row->customer->full_name : '-';
                })
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('M d Y');
                })
                ->addColumn('status', function ($row) {
                    return $row->status();
                })
                ->addColumn('action', 'admin.order.include.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.order.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->input('product_id');
        $customerId = $request->input('customer_id');
        $total_price = $request->input('total_price');
        $status = 2;
        $amountValue = $request->input('amountValue');
        $priceValue = $request->input('priceValue');
        $discountValue = $request->input('discountValue');
        $totalValue = $request->input('totalValue');

        $adminId = 1;
        $customerId = $customerId;

        $order = Order::create([
            'admin_id' => $adminId,
            'customer_id' => $customerId,
            'total_price' => $total_price,
            'status' => $status
        ]);

        $detailOrder = new DetailOrder([
            'order_id' => $order->id,
            'product_id' => $productId,
            'price' => $priceValue,
            'discount' => $discountValue,
            'amount' => $amountValue,
            'total_price' => $totalValue
        ]);

        $detailOrder->save();

        return response()->json(['message' => 'Produk berhasil dibayar.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $detailOrders = DetailOrder::where('order_id', $order->id)->get();

        $price = 0;
        $discount = 0;
        $totalPrice = 0;

        foreach ($detailOrders as $detailOrder) {
            $price += $detailOrder->price;
            $discount += $detailOrder->discount;
            $totalPrice += $detailOrder->total_price;
        }

        return view('admin.order.show', compact('order', 'price', 'discount', 'totalPrice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
