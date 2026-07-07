@extends('admin.layouts.admin')

@section('title', 'Danh sách loại sản phẩm')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">DANH SÁCH LOẠI SẢN PHẨM</h1>
    </div>
    <div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm mới</a>
    </div>
</div>

<div class="table-responsive bg-white rounded shadow-sm p-3">
    <table class="table table-bordered table-hover table-striped align-middle mb-0">
        <thead class="table-dark text-white">
        <tr>
            <th style="width: 80px;">STT</th>
            <th style="width: 120px;">Mã loại</th>
            <th style="width: 120px;">Ảnh</th>
            <th>Tên loại</th>
            <th>Slug</th>
            <th style="width: 140px;">Trạng thái</th>
            <th style="width: 120px;">Hành động</th>
        </tr>
        </thead>
        <tbody>
        @forelse($list as $item)
            <tr>
                <td>{{ ($list->currentPage() - 1) * $list->perPage() + $loop->iteration }}</td>
                <td>{{ $item->cateid }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset($item->image) }}" alt="{{ $item->catename }}" class="img-thumbnail" style="width: 100px; height: auto; object-fit: cover;" />
                    @else
                        <span class="text-muted">Không có ảnh</span>
                    @endif
                </td>
                <td>{{ $item->catename }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    @if($item->status == 1)
                        <span class="badge bg-success">Hiển thị</span>
                    @else
                        <span class="badge bg-danger">Ẩn</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.categories.show', $item->cateid) }}" class="btn btn-sm btn-info me-1" title="Xem">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-sm btn-warning me-1" title="Sửa">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Không có danh mục nào.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $list->links() }}
</div>

@endsection
