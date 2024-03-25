<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APOTEK SHAFIYAH - INVOICE</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
</head>

<body>
    <div class="container">
        <div class="card mt-2">
            <div class="card-body">
                <div class="atas" style="vertical-align: middle;">
                    <img src="{{ asset('template/dist/img/logo apotek.png') }}" alt="" style="width:18%;">
                    <h4 class="text-right" style="font-weight: bold;">Faktur Penerimaan</h4>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6" style="font-size:14px;">
                        <b>APOTEK SHAFIYAH</b>
                        <br><span>Jalan Madura Komp. SMK 1 Telaga, Kab. Gorontalo</span>
                    </div>

                    <div class="col-3" style="font-size: 14px;">
                        No Faktur <br>
                        Tanggal Pembelian <br>
                        Nama Supplier <br>
                        Telpon <br>
                    </div>

                    <div class="col-3" style="font-size: 14px;">
                        : {{ $receipt->purchase->invoice_number }} <br>
                        : {{ $receipt->purchase->order_date }} <br>
                        : {{ $receipt->purchase->supplier->name }} <br>
                        : {{ $receipt->purchase->supplier->phone_number }} <br>
                    </div>
                </div>

                <table class="table table-sm table-bordered mt-4 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Batch</th>
                            <th>Nama Item</th>
                            <th>QTY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipt->detail_receipt as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->product->batch_number }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="col-6 mt-2">
                    <h5>Keterangan :</h5>
                    <table class="table text-center table-bordered table-sm">
                        <tbody>
                            <tr>
                                <td>{{ $receipt->information }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-5">
                    <div class="col-4" style="font-size:14px;text-align:center;">
                        Disiapkan Oleh
                        <hr style="width:50%;color:black;margin-top:20%;">
                    </div>

                    <div class="col-4" style="font-size:14px;text-align:center;">
                        Disetujui Oleh
                        <hr style="width:50%;color:black;margin-top:20%;">
                    </div>

                    <div class="col-4" style="font-size:14px;text-align:center;">
                        Diketahui Oleh
                        <hr style="width:50%;color:black;margin-top:20%;">
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
