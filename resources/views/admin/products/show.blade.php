@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Chi tiết sản phẩm</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            @if ($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->productname }}"
                                    class="img-fluid img-thumbnail">
                            @else
                                <img src="https://via.placeholder.com/300x300?text=No+Image" alt="No image"
                                    class="img-fluid img-thumbnail">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $product->productname }}</h4>
                            <p class="text-muted">
                                <strong>Slug:</strong> {{ $product->slug }}
                            </p>

                            <div class="mb-2">
                                <strong>Loại:</strong>
                                @if ($product->category)
                                    <span class="badge bg-info">{{ $product->category->catename }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>

                            <div class="mb-2">
                                <strong>Thương hiệu:</strong>
                                @if ($product->brand)
                                    <span class="badge bg-secondary">{{ $product->brand->brandname }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Giá:</strong>
                                @if ($product->pricesdiscount && $product->pricesdiscount > 0)
                                    <del class="text-danger">{{ number_format($product->price, 0, ',', '.') }} đ</del>
                                    <br>
                                    <strong class="text-success">{{ number_format($product->pricesdiscount, 0, ',', '.') }} đ</strong>
                                @else
                                    <strong>{{ number_format($product->price, 0, ',', '.') }} đ</strong>
                                @endif
                            </div>

                            <div class="mb-3">
                                <strong>Trạng thái:</strong>
                                @if ($product->status == 1)
                                    <span class="badge bg-success">Hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Ẩn</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <strong>Mô tả:</strong>
                        <p>{{ $product->description ?? 'Không có mô tả' }}</p>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
