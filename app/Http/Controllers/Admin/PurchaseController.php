<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePurchaseRequest;
use App\Http\Requests\Admin\UpdatePurchaseRequest;
use App\Models\DetailPurchase;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $purchases = Purchase::with('supplier')->latest()->get();
            return DataTables::of($purchases)
                ->addIndexColumn()
                ->addColumn('action', 'admin.purchase.include.action')
                ->toJson();
        }

        return view('admin.purchase.index');
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
    public function store(StorePurchaseRequest $request)
    {
        try {
            DB::beginTransaction();

            $attr = $request->validated();

            $purchase = new Purchase();
            $purchase->supplier_id = $attr['supplier_id'];
            $purchase->purchase_number = $attr['purchase_number'];
            $purchase->invoice_number = Str::random(8);
            $purchase->order_date = $attr['order_date'];
            $purchase->information = $attr['information'];
            $purchase->save();

            foreach ($attr['product_id'] as $index => $productId) {
                DetailPurchase::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'expired_date' => $attr['expired_date'][$index],
                    'quantity' => $attr['quantity'][$index],
                    'price' => $attr['price'][$index],
                    'total_price' => $attr['total_price'][$index],
                ]);
            }


            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load('product', 'supplier');
        return view('admin.purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        try {
            DB::beginTransaction();

            DetailPurchase::where('purchase_id', $purchase->id)->delete();

            $purchase->delete();

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }

    public function getPurchaseDetails($id)
    {
        $details = DetailPurchase::with('product.unit')->where('purchase_id', $id)->get();
        return response()->json($details);
    }

    public function print(Purchase $purchase)
    {
        $purchase->load('detail_purchase', 'supplier');
        return view('admin.purchase.print', compact('purchase'));
    }
}
