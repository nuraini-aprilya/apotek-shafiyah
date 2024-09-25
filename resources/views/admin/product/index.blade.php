@extends('layouts.admin.index')

@section('title', 'List Produk')

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"
        integrity="sha512-wXEyXmtKft9mEiu8LTc3+3BQ95aYbvxgvzH4IzFHOwvGlA14B6zREXD4CRmUPx8r2Z1RVUOXS47bwjsotSlZkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>List Produk</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">List Produk</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Master Item</h3>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3">
                                <button type="button" class="btn btn-success btn-block btn-sm mr-1" data-toggle="modal"
                                    data-target="#modal-l">
                                    <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                    Kategori Obat
                                </button>
                            </div>

                            <div class="col-3">
                                <button type="button" class="btn btn-success btn-block btn-sm mr-1" data-toggle="modal"
                                    data-target="#modal-jenis">
                                    <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                    Jenis Obat
                                </button>
                            </div>

                            <div class="col-3">
                                <button type="button" class="btn btn-success btn-block btn-sm mr-1" data-toggle="modal"
                                    data-target="#modal-merk">
                                    <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                    Merk Obat
                                </button>
                            </div>

                            <div class="col-3">
                                <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal"
                                    data-target="#modal-satuan">
                                    <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                    Satuan Obat
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- modal kategori -->
                    <div class="modal fade" id="modal-l">
                        <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Kategori Obat</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.category.store') }}" method="POST">
                                        @csrf
                                        <label class="text-secondary">Kategori</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Kategori Obat">
                                        <button type="submit" class="btn btn-success btn-sm btn-block mt-3"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <table class="table table-sm table-striped table-bordered" style="text-align:center;">
                                        <thead class="bg-navy">
                                            <td>No</td>
                                            <td>Kategori</td>
                                            <td>Aksi</td>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $category)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <form action={{ route('admin.category.destroy', $category->id) }}
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm ">
                                                                <i class="fa fa-trash" style="font-size:12px;"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Data belum ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal kategori -->


                    <!-- modal jenis -->
                    <div class="modal fade" id="modal-jenis">
                        <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Jenis Obat</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.type.store') }}" method="POST">
                                        @csrf
                                        <label class="text-secondary">Jenis Obat</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Jenis Obat">
                                        <button type="submit" class="btn btn-success btn-sm btn-block mt-3"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <table class="table table-sm table-striped table-bordered" style="text-align:center;">
                                        <thead class="bg-navy">
                                            <td>No</td>
                                            <td>Jenis Obat</td>
                                            <td>Aksi</td>
                                        </thead>
                                        <tbody>
                                            @forelse ($types as $type)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $type->name }}</td>
                                                    <td>
                                                        <form action={{ route('admin.type.destroy', $type->id) }}
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm ">
                                                                <i class="fa fa-trash" style="font-size:12px;"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Data belum ada</td>
                                                </tr>
                                            @endforelse
                                    </table>

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal jenis -->

                    <!-- modal merk -->
                    <div class="modal fade" id="modal-merk">
                        <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Merk Obat</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.brand.store') }}" method="POST">
                                        @csrf
                                        <label class="text-secondary">Merk Obat</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Merk Obat">
                                        <button type="submit" class="btn btn-success btn-sm btn-block mt-3"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <table class="table table-sm table-striped table-bordered" style="text-align:center;">
                                        <thead class="bg-navy">
                                            <td>No</td>
                                            <td>Merk Obat</td>
                                            <td>Aksi</td>
                                        </thead>
                                        <tbody>
                                            @forelse ($brands as $brand)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $brand->name }}</td>
                                                    <td>
                                                        <form action={{ route('admin.brand.destroy', $brand->id) }}
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm ">
                                                                <i class="fa fa-trash" style="font-size:12px;"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Data belum ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal merk -->

                    <!-- modal satuan -->
                    <div class="modal fade" id="modal-satuan">
                        <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Satuan Obat</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('admin.unit.store') }}" method="POST">
                                        @csrf
                                        <label class="text-secondary">Satuan</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Satuan Obat">
                                        <button type="submit" class="btn btn-success btn-sm btn-block mt-3"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <table class="table table-sm table-striped table-bordered" style="text-align:center;">
                                        <thead class="bg-navy">
                                            <td>No</td>
                                            <td>Satuan</td>
                                            <td>Aksi</td>
                                        </thead>
                                        <tbody>
                                            @forelse ($units as $unit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $unit->name }}</td>
                                                    <td>
                                                        <form action={{ route('admin.unit.destroy', $unit->id) }}
                                                            method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-sm ">
                                                                <i class="fa fa-trash" style="font-size:12px;"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Data belum ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal satuan -->

                </div>
            </div>

            <div class="card">
                <div class="card-header bg-light">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="float-right">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modal-produk">
                            <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                            Tambah Produk
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <!-- modal produk -->
                        <div class="modal fade" id="modal-produk">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header bg-info">
                                        <h6 class="modal-title">Tambah Produk</h6>
                                        <button type="button" class="close text-white" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formProduct" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @include('admin.product.include.form')
                                            <!-- /.row -->

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-success btn-sm btn-block"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal produk -->
                    </div>
                    <table id="example" class="table table-bordered table-striped table-sm text-center">
                        <thead class="bg-info">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->



@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"
        integrity="sha512-98e5nQTE7pmtZ3xoD5GCVKafmziXDT5WINC91MugFzF57zzBnmvGQl1N70cvdyBSWxjCOC55gq9Zn76MUgtEMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: '{{ route('admin.product.index') }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'code',
                    }, {
                        data: 'name',
                    }, {
                        data: 'type.name',
                    }, {
                        data: 'category.name',
                    },
                    {
                        data: 'stock',
                    },
                    {
                        data: 'price',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#body').summernote({
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

            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder: function() {
                    $(this).data('placeholder');
                }
            })

            $('#formProduct').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.product.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('.modal').removeClass('in');
                        $('.modal').attr("aria-hidden", "true");
                        $('.modal').css("display", "none");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil Ditambah!',
                        }).then(function() {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                $('#' + key + '_error').text(value);
                            });
                            $('#modal-produk').modal('show');
                        }
                    }
                });
            });


            $("body").on('submit', `form[role='alert']`, function(event) {
                event.preventDefault();

                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: "warning",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    reverseButton: true,
                    confirmButtonText: "Hapus",
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                })
            });
        });
    </script>
@endpush
