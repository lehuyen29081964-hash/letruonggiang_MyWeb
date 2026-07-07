@extends('admin.layouts.admin')

@section('title', 'Chỉnh sửa thương hiệu')

@section('content')

<h1 class="h3 mb-3">Chỉnh sửa thương hiệu</h1>

<x-admin.alert />

<form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Tên thương hiệu</label>
        <input type="text" name="brandname" class="form-control" value="{{ old('brandname', $brand->brandname) }}" required>
        @error('brandname')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $brand->slug) }}" required>
        @error('slug')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh</label>
        <input type="file" name="image" class="form-control">
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        @if($brand->image)
            <div class="mt-2">
                <img src="{{ asset($brand->image) }}" alt="{{ $brand->brandname }}" class="img-thumbnail" style="width: 150px; height: auto;">
            </div>
        @endif
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Trạng thái</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="status_active" value="1" {{ old('status', $brand->status) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_active">Hiển thị</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0" {{ old('status', $brand->status) == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_inactive">Ẩn</label>
        </div>
        @error('status')
            <span class="text-danger d-block mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Thứ tự</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $brand->sort_order) }}">
        @error('sort_order')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $brand->description) }}</textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
