@extends('layouts.admin.index')

@section('title', 'Detail Produk')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Detail Produk</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Produk</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <table class="table table-bordered table-sm">
        <tr>
            <td rowspan="8" style="width:20%;"><img src="{{ asset('storage/upload/produk/' . $product->image) }}"
                    style="max-width:300px;">
            </td>
            <td>Kode Obat</td>
            <td>:</td>
            <td>{{ $product->code }}</td>
        </tr>
        <tr>
            <td>Merk</td>
            <td>:</td>
            <td>{{ $product->brand->name }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $product->category->name }}</td>
        </tr>
        <tr>
            <td>Jenis</td>
            <td>:</td>
            <td>{{ $product->type->name }}</td>
        </tr>
        <tr>
            <td>Stok - Satuan</td>
            <td>:</td>
            <td>{{ $product->stock }} {{ $product->unit->name }}</td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td>
                <h4 class="text-success">{{ $product->price }}</h4>
            </td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>:</td>
            <td>{!! $product->information !!}</td>
        </tr>
    </table>
@endsection
