<div class="dropdown show">
    <a class="btn btn-success dropdown-toggle btn-sm" href="#" role="button" id="menu" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        Action
    </a>

    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('admin.refund.show', $id) }}">Detail</a>
        <a class="dropdown-item" data-toggle="modal" data-target="#modal-edit-{{ $id }}"
            href="#">Edit</a>
        <form action={{ route('admin.refund.destroy', $id) }} method="post">
            @csrf
            @method('delete')
            <button type="submit" class="dropdown-item">
                Hapus
            </button>
        </form>
    </div>
</div>
