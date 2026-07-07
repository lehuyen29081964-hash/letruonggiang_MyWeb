@extends('admin.layouts.admin')

@section('title', 'Chi tiết loại sản phẩm')

@section('content')

<h1 class="h3 mb-3">Chi tiết loại sản phẩm</h1>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Mã loại</dt>
            <dd class="col-sm-9">{{ $category->cateid }}</dd>

            <dt class="col-sm-3">Tên loại</dt>
            <dd class="col-sm-9">{{ $category->catename }}</dd>

            <dt class="col-sm-3">Slug</dt>
            <dd class="col-sm-9">{{ $category->slug }}</dd>

            <dt class="col-sm-3">Ảnh</dt>
            <dd class="col-sm-9">
                @if($category->image)
                    <img src="{{ asset($category->image) }}" alt="{{ $category->catename }}" class="img-fluid img-thumbnail" style="max-width: 280px; height: auto;">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </dd>

            <dt class="col-sm-3">Trạng thái</dt>
            <dd class="col-sm-9">{{ $category->status == 1 ? 'Hiển thị' : 'Ẩn' }}</dd>

            <dt class="col-sm-3">Thứ tự</dt>
            <dd class="col-sm-9">{{ $category->sort_order }}</dd>

            <dt class="col-sm-3">Mô tả</dt>
            <dd class="col-sm-9">{{ $category->description }}</dd>
        </dl>

        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay lại</a>
        <a href="{{ route('admin.categories.edit', $category->cateid) }}" class="btn btn-primary">Sửa</a>
    </div>
</div>

@endsection
