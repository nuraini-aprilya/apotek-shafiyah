@extends('layouts.admin.index')

@section('title', 'Detail Produk')

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Detail Resep</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Detail Resep</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-info">
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-sm text-center">
                <tbody>
                    <tr>
                        <td rowspan="5" data-target="#modal-detail" data-toggle="modal" href="#"><img
                                src="{{ asset('storage/upload/resep/' . $recipe->image) }}" width="100"></td>
                    </tr>
                    <tr>
                        <td>Pembeli</td>
                        <td>:</td>
                        <td>{{ $recipe->customer->full_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td style="vertical-align: middle;"><span class="badge bg-orange"
                                style="font-size:16px">{{ $recipe->status() }}</span></td>
                    </tr>
                    <tr>
                        <td>Obat dibeli</td>
                        <td>:</td>
                        <td>Paramex, panadol, antasida</td>
                    </tr>
                    <tr>
                        <td>Berakhir</td>
                        <td>:</td>
                        <td>Hari ini, 23:59 WITA</td>
                    </tr>
                </tbody>
            </table>

            @if ($recipe->status == 1)
                <div class="row mt-2">
                    <div class="col-md-6">
                        <form action="{{ route('admin.approveRecipe', $recipe->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-block"> <i class="fa fa-check-circle"></i>
                                Setujui
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('admin.rejectRecipe', $recipe->id) }}" method="POST">
                            @csrf
                            <button type="submit"class="btn btn-danger btn-block"> <i class="fa fa-window-close"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <!-- modal detail gambar -->
            <div class="modal fade" id="modal-detail">
                <div class="modal-dialog modal-l modal-dialog-centered">
                    <div class="modal-content centered">
                        <div class="modal-body text-center">
                            <img src="{{ asset('storage/upload/resep/' . $recipe->image) }}" style="width:100%;"
                                alt="">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal detail gambar -->
        </div>
        <!-- /.card-body -->
    </div>
@endsection
