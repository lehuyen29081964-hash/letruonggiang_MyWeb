@extends('admin.layouts.admin')

@section('title', 'Trash Loại sản phẩm')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách loại sản phẩm - Đang chờ xóa</h3>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $item)
                    <tr>
                        <td>{{ $list->firstItem() + $loop->index }}</td>
                        <td>{{ $item->catename }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.restore', $item->cateid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.categories.forceDelete', $item->cateid) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $list->links() }}
    </div>
</div>
@endsection
