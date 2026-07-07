@extends('admin.layouts.admin')

@section('title', 'Thêm thương hiệu')

@section('content')

<h1 class="h3 mb-3">Thêm thương hiệu</h1>

<x-admin.alert />

<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Tên thương hiệu</label>
        <input type="text" name="brandname" class="form-control" value="{{ old('brandname') }}" required>
        @error('brandname')
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

    <div class="mb-3">
        <label class="form-label">Ảnh</label>
        <input type="file" name="image" class="form-control">
        @error('image')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label d-block">Trạng thái</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="status_active" value="1" {{ old('status', 1) == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="status_active">Hiển thị</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="status" id="status_inactive" value="0" {{ old('status') === '0' ? 'checked' : '' }}>
            <label class="form-check-label" for="status_inactive">Ẩn</label>
        </div>
        @error('status')
            <span class="text-danger d-block mt-1">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Thứ tự</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
        @error('sort_order')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
