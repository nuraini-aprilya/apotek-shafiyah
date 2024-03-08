@extends('layouts.admin.index')

@section('title', 'Detail Produk')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Detail Retur</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Retur</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>No SP</td>
                        <td>:</td>
                        <td>{{ $refund->purchase->purchase_number }}</td>
                    </tr>
                    <tr>
                        <td>No Faktur</td>
                        <td>:</td>
                        <td>{{ $refund->purchase->invoice_number }}</td>
                    </tr>
                    <tr>
                        <td>Supplier</td>
                        <td>:</td>
                        <td>{{ $refund->purchase->supplier->name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Tanggal Retur</td>
                        <td>:</td>
                        <td>{{ $refund->refund_date }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>:</td>
                        <td>{{ $refund->information }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- /.col -->
        <div class="col-md-12">
            <h4>Rincian Retur</h4>
            <hr>
            <table class="table table-sm table-striped table-bordered text-center">
                <thead class="bg-navy">
                    <tr>
                        <th>No Batch</th>
                        <th>Nama Item</th>
                        <th>Satuan</th>
                        <th>Kuanti Retur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($refund->detail_refund as $detail)
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="batch" readonly
                                    value="{{ $detail->product->batch_number }}">
                            </td>
                            <td><input type="text" class="form-control" name="nama" readonly
                                    value="{{ $detail->product->name }}"></td>
                            <td><input type="text" class="form-control" name="satuan" readonly
                                    value="{{ $detail->product->unit->name }}"></td>
                            <td><input type="text" class="form-control" name="retur" readonly
                                    value="{{ $detail->amount }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
