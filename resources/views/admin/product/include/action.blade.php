<div class="dropdown show">
    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" id="menu" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.product.show', $id) }}">Detail</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modal-edit-{{ $id }}"
            href="#">Edit</a>
        <form action={{ route('admin.product.destroy', $id) }} method="post" role="alert" alert-title="Hapus Produk"
            alert-text="Yakin ingin menghapusnya?">
            @csrf
            @method('delete')
            <button type="submit" class="dropdown-item">
                Hapus
            </button>
        </form>
    </div>
</div>

<!-- modal edit produk -->
<div class="modal fade" id="modal-edit-{{ $id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h6 class="modal-title">Edit Produk</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUpdateProduct" action="{{ route('admin.product.update', $id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.product.include.form')
                    <!-- /.row -->

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
<!-- /.modal edit produk -->
