<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReceiptRequest;
use App\Http\Requests\Admin\UpdateReceiptRequest;
use App\Models\DetailReceipt;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $receipts = Receipt::with('purchase.supplier')->latest()->get();
            return DataTables::of($receipts)
                ->addIndexColumn()
                ->addColumn('action', 'admin.receipt.include.action')
                ->toJson();
        }

        return view('admin.receipt.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReceiptRequest $request)
    {
        $attr = $request->validated();
        try {
            DB::beginTransaction();

            $receipt = new Receipt();
            $receipt->purchase_id = $attr['purchase_id'];
            $receipt->receipt_date = $attr['receipt_date'];
            $receipt->information = $attr['information'];
            $receipt->save();

            foreach ($attr['product_id'] as $index => $productId) {
                DetailReceipt::create([
                    'receipt_id' => $receipt->id,
                    'product_id' => $productId,
                    'amount' => $attr['amount'][$index],
                ]);

                $product = Product::find($productId);
                $product->stock += $attr['amount'][$index]; // Menambah jumlah penerimaan ke stok produk
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
    public function show(Receipt $receipt)
    {
        $receipt->load('purchase.detail_purchase', 'detail_receipt.product');
        return view('admin.receipt.show', compact('receipt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        try {
            $receipt->detail_receipt()->delete();
            $receipt->delete();

            return redirect()->back();
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function print(Receipt $receipt)
    {
        $receipt->load('purchase', 'detail_receipt');
        return view('admin.receipt.print', compact('receipt'));
    }
}
