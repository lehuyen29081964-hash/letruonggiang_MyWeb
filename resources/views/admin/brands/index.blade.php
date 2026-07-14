@extends('admin.layouts.admin')

@section('title', 'Danh sách Thương hiệu')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0">DANH SÁCH THƯƠNG HIỆU</h3>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm thương hiệu</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:60px;">STT</th>
                        <th style="width:100px;">Ảnh</th>
                        <th>Tên thương hiệu</th>
                        <th>Slug</th>
                        <th style="width:120px;">Trạng thái</th>
                        <th style="width:140px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($list as $brand)
                        <tr>
                            <td>{{ $list->firstItem() + $loop->index }}</td>
                            <td>
                                @php $src = $brand->image_url ?? null; @endphp
                                @if($src)
                                    <img src="{{ $src }}" alt="{{ $brand->brandname }}" style="width:60px; height:auto; object-fit:contain;">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="No image" style="width:60px; height:auto; object-fit:contain;">
                                @endif
                            </td>
                            <td>{{ $brand->brandname }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>
                                @if($brand->status)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-success me-1" title="Chỉnh sửa">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
