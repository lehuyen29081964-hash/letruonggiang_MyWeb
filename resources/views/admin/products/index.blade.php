@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Quản lý sản phẩm</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Thêm sản phẩm
            </a>
            <a href="{{ route('admin.products.trash') }}" class="btn btn-danger ms-2">
                <i class="bi bi-trash"></i> Thùng rác
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Loại</th>
                    <th>Thương hiệu</th>
                    <th>Giá</th>
                    <th style="width: 100px;">Trạng thái</th>
                    <th style="width: 120px;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($list as $item)
                    <tr>
                        <td>{{ $list->firstItem() + $loop->index }}</td>
                        <td>{{ $item->productname }}</td>
                        <td>{{ $item->category?->catename }}</td>
                        <td>{{ $item->brand?->brandname }}</td>
                        <td>{{ number_format($item->price) }} đ</td>
                        <td>@if($item->status)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                        </td>
                        <td width="120">
                            <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <a href="{{ route('admin.products.destroy', $item->id) }}" class="btn btn-danger btn-sm"
                               onclick="event.preventDefault(); if(confirm('Bạn có chắc chắn muốn xóa?')) { var f = document.createElement('form'); f.method = 'POST'; f.action = this.href; var csrf = document.createElement('input'); csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}'; f.appendChild(csrf); var m = document.createElement('input'); m.type = 'hidden'; m.name = '_method'; m.value = 'DELETE'; f.appendChild(m); document.body.appendChild(f); f.submit(); }">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            Không có dữ liệu
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <nav class="mt-3">
        {{ $list->links() }}
    </nav>
</div>
@endsection
