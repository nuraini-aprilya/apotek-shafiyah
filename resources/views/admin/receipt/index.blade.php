@extends('layouts.admin.index')

@section('title', 'Data Penerimaan')

@push('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
@endpush

@section('breadcrumb')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4>Data Penerimaan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Data Penerimaan</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalReceiptsToday }}</h3>

                        <p>Penerimaan Hari Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalReceiptsThisWeek }}</h3>

                        <p>Penerimaan Minggu Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalReceiptsThisMonth }}</h3>

                        <p>Penerimaan Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </div>
                </div>
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
                        data-target="#modal-penerimaan">
                        <i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                        Tambah Data
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row mb-3">
                    <!-- modal penerimaan -->
                    <div class="modal fade" id="modal-penerimaan" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h6 class="modal-title">Tambah Penerimaan</h6>
                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.receipt.store') }}" method="POST">
                                    <div class="modal-body">

                                        @csrf
                                        @include('admin.receipt.include.form')

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-success btn-sm btn-block"><i
                                                class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>
                                            Tambah</button>

                                    </div>
                                </form>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal penerimaan -->
                </div>
                <!-- row -->
            </div>
            <table id="example" class="table table-bordered table-striped table-sm text-center">
                <thead class="bg-info">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Penerimaan</th>
                        <th>No. SP</th>
                        <th>Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
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
                ajax: '{{ route('admin.receipt.index') }}',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'receipt_date',
                    },
                    {
                        data: 'purchase.purchase_number',
                    },
                    {
                        data: 'purchase.supplier.name',
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $(".select2").select2({
                placeholder: function() {
                    $(this).data('placeholder');
                }
            });

            $('#selectPurchase').on('change', function() {
                var selectedOption = $(':selected', this);
                var purchaseId = selectedOption.val();

                let supplier = selectedOption.data('supplier');
                let sp = selectedOption.data('sp');
                let od = selectedOption.data('od');

                $('#supplier').val(supplier);
                $('#sp').val(sp);
                $('#od').val(od);

                $.ajax({
                    url: '/admin/getPurchaseDetails/' + purchaseId,
                    type: 'GET',
                    success: function(response) {
                        var tableBody = $('#detailPurchase tbody');
                        tableBody.empty();

                        $.each(response, function(index, detail) {
                            tableBody.append('<tr><td>' + detail.product.name +
                                '</td>' +
                                '<input type="hidden" class="form-control" name="product_id[]" value="' +
                                detail.product.id + '" />' +
                                '<td>' + detail.product.batch_number +
                                '</td><td>' + detail.expired_date +
                                '</td><td>' + detail.product.unit.name +
                                '</td><td>' + detail.price +
                                '</td><td>' + detail.quantity +
                                '</td><td>' +
                                '<input type="text" class="form-control" name="amount[]" />' +
                                '</td><td>' + detail.total_price +
                                '</td></tr>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

        });
    </script>
@endpush
