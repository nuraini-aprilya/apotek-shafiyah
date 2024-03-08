<form action={{ route('admin.banner.destroy', $id) }} method="post" role="alert" alert-title="Hapus Banner"
    alert-text="Yakin ingin menghapusnya?">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger btn-sm">
        <i class="fa fa-trash-alt"></i>
    </button>
</form>
