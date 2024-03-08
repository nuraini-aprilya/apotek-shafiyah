<div class="row">
    <div class="col-md-6">
        <!-- /.form-group -->
        <div class="form-group">
            <label>No SP<span class="text-danger">*</span></label>
            <select id="selectPurchase" class="form-control select2" style="width: 100%;" name="purchase_id"
                data-placeholder="-- Pilih SP --">
                @foreach ($purchases as $purchase)
                    <option></option>
                    <option value="{{ $purchase->id }}" data-faktur="{{ $purchase->invoice_number }}"
                        data-supplier="{{ $purchase->supplier->name }}" data-receipt="{{ $purchase->receipt->id }}">
                        {{ $purchase->purchase_number }}
                    </option>
                @endforeach
            </select>
        </div>
        <!-- /.form-group -->
        <input type="hidden" id="receipt" name="receipt_id">
        <div class="form-group">
            <label>No Faktur<span class="text-danger">*</span><span class="text-danger">*</span></label>
            <input type="text" id="faktur" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Supplier<span class="text-danger">*</span></label>
            <input type="text" id="supplier" class="form-control" readonly>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Tanggal Retur<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="refund_date">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="information" class="form-control" rows="4"></textarea>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-12">
        <h4>Rincian Retur</h4>
        <hr>
        <table id="detailRefund" class="table table-sm table-striped table-bordered text-center">
            <thead class="bg-navy">
                <tr>
                    <th>No Batch</th>
                    <th>Nama Item</th>
                    <th>Tanggal Expired</th>
                    <th>Satuan</th>
                    <th>Kuanti Terima</th>
                    <th>Kuanti Retur</th>
                </tr>
            </thead>
            <tbody>
                <!-- Baris default atau awal -->
                <tr>
                    <td>
                        <input type="text" id="batch" class="form-control" readonly>
                    </td>
                    <td><input type="text" id="name" class="form-control" readonly /></td>
                    <td><input type="text" id="expired" class="form-control" readonly /></td>
                    <td><input type="text" id="unit" class="form-control" readonly /></td>
                    <td><input type="text" id="amount_received" class="form-control" readonly /></td>
                    <td><input type="text" class="form-control" name="amount" /></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- /.row -->
