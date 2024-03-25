@extends('layouts.admin.index')

@section('title', 'Laporan Pembelian')

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Laporan Pembelian</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Laporan Pembelian</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">
                        <label for="" class="text-sm">Tanggal awal</label>
                        <input type="date" class="form-control" id="searchName">
                    </div>
                    <div class="col-6">
                        <label for="" class="text-sm">Tanggal akhir</label>
                        <input type="date" class="form-control" id="searchKode">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-download"></i>
                            Tampilkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-bordered table-striped table-sm text-center">
                    <thead class="bg-info">
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal Pembelian</th>
                            <th>Nama Supplier</th>
                            <th>Total Harga</th>
                            <th>Keterangan</th>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                rowReorder: {
                    selector: 'td:nth-child(2)'
                },
                ajax: '{{ route('admin.report.purchase') }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'invoice_number',
                    }, {
                        data: 'order_date',
                    }, {
                        data: 'supplier',
                    }, {
                        data: 'total_price',
                    }, {
                        data: 'information',
                    },
                ],
            });
        });
    </script>
@endpush
