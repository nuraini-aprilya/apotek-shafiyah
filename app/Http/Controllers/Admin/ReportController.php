<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function order()
    {
        if (request()->ajax()) {
            $orders = DetailOrder::latest()->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('M d Y');
                })
                ->addColumn('price', function ($row) {
                    return 'Rp. ' . number_format($row->price, 0, ",", ".");
                })
                ->addColumn('total_price', function ($row) {
                    return 'Rp. ' . number_format($row->total_price, 0, ",", ".");
                })
                ->make(true);
        }

        return view('admin.report.order');
    }

    public function purchase()
    {
        if (request()->ajax()) {
            $purchases = Purchase::with(['detail_purchase', 'supplier'])->latest()->get();

            return DataTables::of($purchases)
                ->addIndexColumn()
                ->addColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('M d Y');
                })
                ->addColumn('supplier', function ($row) {
                    return  $row->supplier ?  $row->supplier->name : '';
                })
                ->addColumn('total_price', function ($row) {
                    $totalPrice = 0;
                    foreach ($row->detail_purchase as $detail) {
                        $totalPrice += $detail->total_price;
                    }
                    return 'Rp. ' . number_format($totalPrice, 0, ",", ".");;
                })
                ->make(true);
        }

        return view('admin.report.purchase');
    }

    public function receipt()
    {
        if (request()->ajax()) {
            $receipts = Receipt::with('purchase')->latest()->get();
            return DataTables::of($receipts)
                ->addIndexColumn()
                ->addColumn('purchase_number', function ($row) {
                    return $row->purchase ? $row->purchase->purchase_number : '';
                })
                ->addColumn('receipt_date', function ($row) {
                    return Carbon::parse($row->receipt_date)->format('M d Y');
                })
                ->addColumn('invoice_number', function ($row) {
                    return $row->purchase ? $row->purchase->invoice_number : '';
                })
                ->make(true);
        }

        return view('admin.report.receipt');
    }
}
