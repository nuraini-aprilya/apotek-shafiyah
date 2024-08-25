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
            <form id="formUpdateSupplier" action="{{ route('admin.supplier.update', $id) }}" method="POST">
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    @include('admin.supplier.include.form')
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-success btn-sm btn-block"><i class="fas fa-pencil-alt"
                            aria-hidden="true" style="font-size: 12px;"></i>
                        Update</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal edit -->
