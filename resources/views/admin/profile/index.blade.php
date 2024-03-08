@extends('layouts.admin.index')

@section('title', 'Profil')


@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Deskripsi Toko</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Deskripsi Toko</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-desc">
                        <i class="fa fa-pencil-alt" aria-hidden="true" style="font-size: 12px;"></i>
                        Update Deskripsi
                    </button>
                </div>
            </div>
            <!-- modal gambar -->
            <div class="modal fade" id="modal-desc">
                <div class="modal-dialog modal-l">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h6 class="modal-title">Update Deskripsi</h6>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.profile.update', $profile->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="5">
                                        {{ $profile->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea name="address" class="form-control" id="" cols="30" rows="5">
                                        {{ $profile->address }}
                                    </textarea>
                                </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-plus"
                                    aria-hidden="true" style="font-size: 12px;"></i> Simpan</button>
                            </form>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal gambar -->
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="bg-info">
                        <tr>
                            <th>No</th>
                            <th>Deskripsi</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <td>1</td>
                            <td>{{ $profile->description }}</td>
                            <td>{{ $profile->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection
