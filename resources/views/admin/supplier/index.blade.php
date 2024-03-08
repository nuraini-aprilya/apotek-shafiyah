@extends('layouts.admin.index')

@section('title', 'Supplier')

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Supplier</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Supplier</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-light">
                <div class="float-right">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-supplier">
                        <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                        Tambah data
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <!-- modal produk -->
                    <div class="modal fade" id="modal-supplier">
                        <div class="modal-dialog modal-l">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Tambah Supplier</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formSupplier" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Kontak (Sales)<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="person">
                                            <span class="text-danger" id="person_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="phone_number">
                                            <span class="text-danger" id="phone_number_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Alamat<span class="text-danger">*</span></label>
                                            <textarea name="address" class="form-control" cols="10" rows="4"></textarea>
                                            <span class="text-danger" id="address_error"></span>
                                        </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fa fa-plus"
                                            aria-hidden="true" style="font-size: 12px;"></i>
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
                            <th>Nama</th>
                            <th>Kontak (Sales)</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
@endsection

@push('script')
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: '{{ route('admin.supplier.index') }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                    }, {
                        data: 'person',
                    }, {
                        data: 'phone_number',
                    }, {
                        data: 'address',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $('#formSupplier').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.supplier.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('.modal').removeClass('in');
                        $('.modal').attr("aria-hidden", "true");
                        $('.modal').css("display", "none");
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            $.each(errors, function(key, value) {
                                $('#' + key + '_error').text(value);
                            });
                            $('#modal-supplier').modal('show');
                        }
                    }
                });
            });

        });
    </script>
@endpush
