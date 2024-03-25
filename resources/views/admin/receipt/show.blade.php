@extends('layouts.admin.index')

@section('title', 'Detail Penerimaan')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Detail Penerimaan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Penerimaan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>No SP</td>
                                        <td>:</td>
                                        <td>{{ $receipt->purchase->purchase_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Faktur</td>
                                        <td>:</td>
                                        <td>{{ $receipt->purchase->invoice_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>:</td>
                                        <td>{{ $receipt->purchase->supplier->name }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Tanggal Pesan</td>
                                        <td>:</td>
                                        <td>{{ $receipt->purchase->order_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Penerimaan</td>
                                        <td>:</td>
                                        <td>{{ $receipt->receipt_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $receipt->information }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-right">
                    <a href="{{ route('admin.print.receipt', $receipt->id) }}" class="btn btn-sm btn-success"><i
                            class="fa fa-print"></i>
                        Cetak</a>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered text-center">
                        <thead class="bg-navy">
                            <tr>
                                <th>Nama Item</th>
                                <th>No Batch</th>
                                <th>Satuan</th>
                                <th>Kuanti Terima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receipt->detail_receipt as $detail)
                                <tr>
                                    <td><input type="text" class="form-control" value="{{ $detail->product->name }}"
                                            readonly>
                                    </td>
                                    <td><input type="text" class="form-control"
                                            value="{{ $detail->product->batch_number }}" readonly>
                                    </td>
                                    <td><input type="text" class="form-control"
                                            value="{{ $detail->product->unit->name }}" readonly>
                                    </td>
                                    <td><input type="text" class="form-control" value="{{ $detail->amount }}" readonly>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
