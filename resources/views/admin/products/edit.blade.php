@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Chỉnh sửa sản phẩm</h2>
        </div>
    </div>

    <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-4">Chỉnh sửa sản phẩm</h3>

        <x-admin.alert />

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productname" class="form-control" value="{{ old('productname', $product->productname) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="pricesdiscount" class="form-control" value="{{ old('pricesdiscount', $product->pricesdiscount) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Loại sản phẩm</label>
                        <select name="cateid" class="form-select">
                            <option value="">-- Chọn loại sản phẩm --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->cateid }}" {{ old('cateid', $product->cateid) == $category->cateid ? 'selected' : '' }}>
                                    {{ $category->catename }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brandid" class="form-select">
                            <option value="">-- Chọn thương hiệu --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brandid', $product->brandid) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->brandname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="status" id="active" value="1" {{ old('status', $product->status) == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">
                                Hiển thị
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="status" id="inactive" value="0" {{ old('status', $product->status) == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="inactive">
                                Ẩn
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>
@endsection
