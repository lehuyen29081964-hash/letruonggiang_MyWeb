@extends('admin.layouts.admin')

@section('title', 'Thêm loại sản phẩm')

@section('content')

<h1 class="h3 mb-3">Thêm loại sản phẩm</h1>

<x-admin.alert />

<form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Tên loại</label>
        <input type="text" name="catename" class="form-control" value="{{ old('catename') }}" required>
        @error('catename')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
        @error('slug')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3 img-group">
        <label class="form-label">Hình ảnh</label>
        <input type="file" name="img" class="form-control img-input">
        @error('img')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="img-preview mt-2"></div>
    </div>
    <div class="mb-3">
        <label class="form-label d-block">Trạng thái</label>
        <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', 1) == 1 ? 'checked' : '' }}>
        <label class="btn btn-outline-success me-1" for="active">Hiển thị</label>
        <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', 1) == 0 ? 'checked' : '' }}>
        <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
        @error('status')
            <span class="text-danger d-block mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Thứ tự</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
    </div>
    <button class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
