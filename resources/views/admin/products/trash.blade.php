@extends('admin.layouts.admin')

@section('title', 'Thùng rác sản phẩm')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách sản phẩm - Đang chờ xóa ({{ $trashCount ?? 0 }})</h3>
        <div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            @if(($trashCount ?? 0) > 0)
                <form action="{{ route('admin.products.restoreAll') }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Khôi phục tất cả</button>
                </form>
                <form action="{{ route('admin.products.forceDeleteAll') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa vĩnh viễn tất cả?')">Xóa vĩnh viễn tất cả</button>
                </form>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($list as $item)
                    <tr>
                        <td>{{ $list->firstItem() + $loop->index }}</td>
                        <td>{{ $item->productname }}</td>
                        <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.products.restore', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Khôi phục</button>
                            </form>
                            <form action="{{ route('admin.products.forceDelete', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa vĩnh viễn?')">Xóa vĩnh viễn</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có dữ liệu trong thùng rác.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end">
        {{ $list->links() }}
    </div>
</div>
@endsection
