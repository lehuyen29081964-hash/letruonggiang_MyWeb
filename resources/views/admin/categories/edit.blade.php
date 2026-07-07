@extends('admin.layouts.admin')

@section('title', 'Chỉnh sửa loại sản phẩm')

@section('content')

<h1 class="h3 mb-3">Chỉnh sửa loại sản phẩm</h1>

<x-admin.alert />

<form action="{{ route('admin.categories.update', $category->cateid) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Tên loại</label>
        <input type="text" name="catename" class="form-control" value="{{ old('catename', $category->catename) }}" required>
        @error('catename')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
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
        @if($category->image)
            <div class="mt-2">
                <img src="{{ asset($category->image) }}" alt="Ảnh hiện tại" class="img-thumbnail" style="width: 120px; height: auto;">
            </div>
        @endif
    </div>
    <div class="mb-3">
        <label class="form-label d-block">Trạng thái</label>
        <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $category->status) == 1 ? 'checked' : '' }}>
        <label class="btn btn-outline-success me-1" for="active">Hiển thị</label>
        <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', $category->status) == 0 ? 'checked' : '' }}>
        <label class="btn btn-outline-danger" for="inactive">Ẩn</label>
        @error('status')
            <span class="text-danger d-block mt-1">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Thứ tự</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $category->sort_order) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
    </div>
    <button class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection
