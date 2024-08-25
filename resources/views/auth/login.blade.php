@extends('layouts.auth.index')

@section('title', 'Login')

@section('content')
    <p class="login-box-msg">Login pengguna</p>

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="text" class="form-control @error('username')
            is-invalid
        @enderror"
                placeholder="Username" name="username">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password')
                is-invalid
            @enderror"
                placeholder="Password" name="password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-success btn-block">Masuk</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
    <p class="mt-2 text-center">
        Belum punya akun?, <a href="{{ route('register') }}" class="text-center">Daftar disini</a>
    </p>
@endsection
