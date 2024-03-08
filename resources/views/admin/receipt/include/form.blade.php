<div class="row">
    <div class="col-md-6">
        <!-- /.form-group -->
        <div class="form-group">
            <label>No Faktur <span class="text-danger">*</span></label>
            <select id="selectPurchase" class="form-control select2" style="width: 100%;" name="purchase_id"
                data-placeholder="-- Pilih Faktur --">
                @foreach ($purchases as $purchase)
                    <option></option>
                    <option value="{{ $purchase->id }}" data-supplier="{{ $purchase->supplier->name }}"
                        data-sp="{{ $purchase->purchase_number }}" data-od="{{ $purchase->order_date }}">
                        {{ $purchase->invoice_number }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Supplier<span class="text-danger">*</span></label>
            <input id="supplier" type="text" class="form-control" name="supplier" readonly>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>No SP<span class="text-danger">*</span></label>
            <input id="sp" type="number" class="form-control" name="sp" readonly>
        </div>

    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Tanggal Pesan<span class="text-danger">*</span></label>
            <input id="od" type="date" class="form-control" name="pesan" readonly>
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            <label>Tanggal Penerimaan<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="receipt_date">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="information" class="form-control" rows="2"></textarea>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-12">
        <h4>Rincian Penerimaan</h4>
        <hr>
        <table id="detailPurchase" class="table table-sm table-striped table-bordered text-center">
            <thead class="bg-navy">
                <tr>
                    <th>Nama</th>
                    <th>No Batch</th>
                    <th>Tanggal Expired</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Kuanti Pesan</th>
                    <th>Kuanti Terima</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" id="name" class="form-control" name="nama" readonly /></td>
                    <td><input type="text" id="batch" class="form-control" name="batch" readonly /></td>
                    <td><input type="date" id="expire" class="form-control" name="tanggal" readonly /></td>
                    <td><input type="text" id="unit" class="form-control" name="satuan" readonly /></td>
                    <td><input type="text" id="price"class="form-control" name="harga" readonly /></td>
                    <td><input type="text" id="quantity"class="form-control" name="pesan" readonly /></td>
                    <td><input type="text" class="form-control" name="amount" /></td>
                    <td><input type="text" id="total" class="form-control" name="total" readonly /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->
