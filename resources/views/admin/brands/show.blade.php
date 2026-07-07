@extends('admin.layouts.admin')

@section('title', 'Chi tiết thương hiệu')

@section('content')

<h1 class="h3 mb-3">Chi tiết thương hiệu</h1>

<div class="card">
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">ID</dt>
            <dd class="col-sm-9">{{ $brand->id }}</dd>

            <dt class="col-sm-3">Tên thương hiệu</dt>
            <dd class="col-sm-9">{{ $brand->brandname }}</dd>

            <dt class="col-sm-3">Slug</dt>
            <dd class="col-sm-9">{{ $brand->slug }}</dd>

            <dt class="col-sm-3">Ảnh</dt>
            <dd class="col-sm-9">
                @if($brand->image)
                    <img src="{{ asset($brand->image) }}" alt="{{ $brand->brandname }}" class="img-fluid img-thumbnail" style="max-width: 280px; height: auto;">
                @else
                    <span class="text-muted">Không có ảnh</span>
                @endif
            </dd>

            <dt class="col-sm-3">Trạng thái</dt>
            <dd class="col-sm-9">{{ $brand->status == 1 ? 'Hiển thị' : 'Ẩn' }}</dd>

            <dt class="col-sm-3">Thứ tự</dt>
            <dd class="col-sm-9">{{ $brand->sort_order }}</dd>

            <dt class="col-sm-3">Mô tả</dt>
            <dd class="col-sm-9">{{ $brand->description }}</dd>
        </dl>

        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-primary">Sửa</a>
    </div>
</div>

@endsection
