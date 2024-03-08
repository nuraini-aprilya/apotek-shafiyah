<div class="dropdown show">
    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" id="menu" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item" data-toggle="modal" data-target="#modal-edit-{{ $id }}"
            href="#">Edit</a>
        <form action={{ route('admin.supplier.destroy', $id) }} method="post">
            @csrf
            @method('delete')
            <button type="submit" class="dropdown-item">
                Hapus
            </button>
        </form>
    </div>
</div>

<!-- modal edit modal -->
<div class="modal fade" id="modal-edit-{{ $id }}">
    <div class="modal-dialog modal-l">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdateSupplier" action="{{ route('admin.supplier.update', $id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $name }}">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Kontak (Sales)<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="person" value="{{ $person }}">
                    </div>
                    <div class="form-group">
                        <label>Telepon<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="phone_number" value="{{ $phone_number }}">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat<span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control" cols="10" rows="4">{{ $address }}</textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-pencil-alt"
                        aria-hidden="true" style="font-size: 12px;"></i>
                    Update</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal edit -->
