@extends('layouts.user.index')

@section('title', 'Data Diri')

@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0  text-success"> Data diri</h5>
                </div><!-- /.col -->
            </div><!-- /.container-fluid -->
            <hr class="custom-hr">
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content blink-animation">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('account.update', $user->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <label for="">Foto</label>
                                        <div class="p-1 m-2" style="border:2px solid rgb(19, 168, 171);text-align: center;">
                                            @if (auth()->user() && $user && $user->image == null)
                                                <img src="{{ asset('template/dist/img/avatar4.png') }}" alt="">
                                            @else
                                                <img src="{{ asset('storage/upload/avatar/' . $user->image) }}"
                                                    alt="" width="300">
                                            @endif

                                        </div>
                                        <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" placeholder="Nama depan"
                                                    name="first_name" value="{{ $user->first_name ?? 'Nama Depan' }}">
                                            </div>
                                            <!-- /.form-group -->
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nama belakang"
                                                    name="last_name" value="{{ $user->last_name ?? 'Nama Belakang' }}">
                                            </div>
                                            <div class="form-group">
                                                <label>No Hp</label>
                                                <input type="text" class="form-control" name="phone_number"
                                                    value="{{ $user->phone_number ?? 'Nomor HP' }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="birth_date"
                                                    value="{{ $user->birth_date ?? 'Tanggal Lahir' }}">
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="province" class="form-control"
                                                    placeholder="Provinsi" value="{{ $user->province ?? 'Provinsi' }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="district" class="form-control"
                                                    placeholder="Kecamatan" value="{{ $user->district ?? 'Kecamatan' }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="subdistrict" class="form-control"
                                                    placeholder="Kelurahan" value="{{ $user->subdistrict ?? 'Kelurahan' }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="postal_code" class="form-control"
                                                    placeholder="Kode Pos" value="{{ $user->postal_code ?? 'Kode Pos' }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Detail alamat</label>
                                                <textarea class="form-control" name="address" rows="5">{{ $user->address ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-block"><i class="fa fa-save"></i>
                                            Simpan data</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </div>

            <!-- /.content -->
        </div>
    </div>
@endsection
