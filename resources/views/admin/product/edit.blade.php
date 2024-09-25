@extends('layouts.admin.index')

@section('title', 'Edit Produk')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"
        integrity="sha512-wXEyXmtKft9mEiu8LTc3+3BQ95aYbvxgvzH4IzFHOwvGlA14B6zREXD4CRmUPx8r2Z1RVUOXS47bwjsotSlZkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Edit Produk</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Produk</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form id="formUpdateProduct" action="{{ route('admin.product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                @method('PUT')
                @include('admin.product.include.form')
                <!-- /.row -->

            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-pencil-alt"
                        aria-hidden="true" style="font-size: 12px;"></i>
                    Update</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"
        integrity="sha512-98e5nQTE7pmtZ3xoD5GCVKafmziXDT5WINC91MugFzF57zzBnmvGQl1N70cvdyBSWxjCOC55gq9Zn76MUgtEMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#information').summernote({
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['help']],
                ],
            });
        });
    </script>
@endpush
