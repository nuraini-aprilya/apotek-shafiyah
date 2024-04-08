@if ($status == 4)
    <a href="{{ route('admin.approve.order', $id) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
@endif

<a href="{{ route('admin.order.show', $id) }}" class="btn btn-info btn-sm">
    <i class="fa fa-eye"></i>
</a>
