@extends('admin.layouts.admin')

@section('title', 'Danh sách Thương hiệu')

@section('content')
    <div class="container">
        <h3>Danh sách Thương hiệu</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th>Ảnh</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>{{ $brand->brandname }}</td>
                        <td>{{ $brand->slug }}</td>
                        <td>
                            @if($brand->image)
                                <img src="/{{ $brand->image }}" alt="" width="80">
                            @endif
                        </td>
                        <td>{{ $brand->status ? 'Hiện' : 'Ẩn' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $list->links() }}
        </div>
    </div>
@endsection
