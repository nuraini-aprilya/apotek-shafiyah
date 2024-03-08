<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request()->ajax()) {
            $products = Product::with('category', 'type')->latest()->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', 'admin.product.include.action')
                ->toJson();
        }

        return view('admin.product.index');
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
    public function store(StoreProductRequest $request)
    {
        try {
            $attr = $request->validated();

            if ($request->file('image') && $request->file('image')->isValid()) {

                $filename = $request->file('image')->hashName();
                $request->file('image')->storeAs('upload/produk', $filename, 'public');

                $attr['image'] = $filename;
            }

            Product::create($attr);

            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category', 'unit', 'brand', 'type');
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $attr = $request->validated();

        if ($request->file('image') && $request->file('image')->isValid()) {

            $path = storage_path('app/public/upload/produk/');
            $filename = $request->file('image')->hashName();

            // delete old file from storage
            if ($product->image != null && file_exists($path . $product->image)) {
                unlink($path . $product->image);
            }

            $request->file('image')->storeAs('upload/produk/', $filename, 'public');

            $attr['image'] = $filename;
        }

        $product->update($attr);

        return redirect()->route('admin.product.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $path = storage_path('app/public/upload/produk/');

            if ($product->image != null && file_exists($path . $product->image)) {
                unlink($path . $product->image);
            }
            $product->delete();

            return redirect()
                ->back()
                ->with('success', __('Data Berhasil Dihapus'));
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', __($th->getMessage()));
        }
    }

    public function dwindling()
    {

        if (request()->ajax()) {
            $products =  Product::where('stock', '<=', 5)->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', 'admin.product.include.action')
                ->toJson();
        }

        return view('admin.product.dwindling');
    }

    public function expire()
    {


        if (request()->ajax()) {
            $today = Carbon::today();
            $products = Product::join('detail_purchases', 'products.id', '=', 'detail_purchases.product_id')
                ->whereDate('detail_purchases.expired_date', '<=', $today)
                ->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.product.expire');
    }
}
