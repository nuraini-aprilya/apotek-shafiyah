<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRefundRequest;
use App\Http\Requests\Admin\UpdateRefundRequest;
use App\Models\DetailRefund;
use App\Models\Product;
use App\Models\Refund;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $refunds = Refund::with('receipt.purchase.supplier')->latest()->get();
            return DataTables::of($refunds)
                ->addIndexColumn()
                ->addColumn('action', 'admin.refund.include.action')
                ->toJson();
        }

        return view('admin.refund.index');
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
    public function store(StoreRefundRequest $request)
    {
        $attr = $request->validated();

        try {
            DB::beginTransaction();
            $refund = new Refund();
            $refund->receipt_id = $attr['receipt_id'];
            $refund->purchase_id = $attr['purchase_id'];
            $refund->refund_date = $attr['refund_date'];
            $refund->information = $attr['information'];
            $refund->save();

            foreach ($attr['product_id'] as $index => $productId) {
                DetailRefund::create([
                    'refund_id' => $refund->id,
                    'product_id' => $productId,
                    'amount' => $attr['amount'][$index],
                ]);

                $product = Product::find($productId);
                $product->stock -= $attr['amount'][$index];
                $product->save();
            }

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Refund $refund)
    {
        return view('admin.refund.show', compact('refund'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Refund $refund)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRefundRequest $request, Refund $refund)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Refund $refund)
    {
        try {
            DB::beginTransaction();
            $detail_refund = DetailRefund::where('refund_id', $refund->id)->get();

            foreach ($detail_refund as $index => $detail) {
                $product = Product::find($detail->product_id);

                $product->stock += $detail->amount;
                $product->save();
            }

            $refund->detail_refund()->delete();
            $refund->delete();

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
