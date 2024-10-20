@extends('layouts.admin.index')

@section('title', 'Detail Produk')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Detail Pembelian</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Pembelian</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Tanggal Pemesanan</td>
                                        <td>:</td>
                                        <td>{{ $purchase->order_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>No SP</td>
                                        <td>:</td>
                                        <td>{{ $purchase->purchase_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>:</td>
                                        <td>{{ $purchase->supplier->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Invoice</td>
                                        <td>:</td>
                                        <td>{{ $purchase->invoice_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>:</td>
                                        <td>{{ $purchase->information }}</td>
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
                    <a href="{{ route('admin.print.purchase', $purchase->id) }}" class="btn btn-sm btn-success"><i
                            class="fa fa-print"></i>
                        Cetak</a>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered text-center">
                        <thead class="bg-navy">
                            <tr>
                                <th style="width:20%;">Kode Obat</th>
                                <th style="width:20%;">Nama</th>
                                <th>Tanggal Expired</th>
                                <th>Jumlah Pemesanan</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchase->detail_purchase as $item)
                                <tr>
                                    <td>{{ $item->product->code }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->expired_date }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->product->unit->name }}</td>
                                    <td>{{ $item->price }}</td>
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
