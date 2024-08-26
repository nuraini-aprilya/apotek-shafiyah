@extends('layouts.admin.index')

@section('title', 'Resep')

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
            <h4>Persetujuan Resep</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Resep</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header bg-info">
            <div class="card-title">
                <h5>Resep</h5>
            </div>
        </div>
        <!-- modal gambar -->
        <div class="modal fade" id="modal-gambar">
            <div class="modal-dialog modal-l">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h6 class="modal-title">Tambah Gambar</h6>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi" required>
                            </div>
                            <div class="form-group">
                                <label for="">Upload gambar</label>
                                <input type="file" class="form-control" name="gambar" required>
                            </div>
                            <div class="form-group text-center">
                                <img src="dist/img/avatar2.png" class="p-2"
                                    style="max-width:500px;border:2px solid darkgreen;">
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
            <table id="example" class="table table-bordered table-striped table-sm text-center">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Tanggal Upload</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
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
                ajax: '{{ route('admin.recipe.index') }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'customer',
                    }, {
                        data: 'created_at',
                    }, {
                        data: 'status',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });


        });
    </script>
@endpush
