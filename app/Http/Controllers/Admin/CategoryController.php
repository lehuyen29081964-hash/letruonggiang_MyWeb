<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response('Hiển thị danh sách loại sản phẩm/danh mục', 200);
    }

    public function create()
    {
        return response('Hiển thị form thêm loại sản phẩm/danh mục', 200);
    }

    public function store(Request $request)
    {
        return response('Lưu loại sản phẩm/danh mục mới', 200);
    }

    public function show($id)
    {
        return response("Hiển thị chi tiết loại sản phẩm/danh mục: $id", 200);
    }

    public function edit($id)
    {
        return response("Hiển thị form sửa loại sản phẩm/danh mục: $id", 200);
    }

    public function update(Request $request, $id)
    {
        return response("Cập nhật loại sản phẩm/danh mục: $id", 200);
    }

    public function destroy($id)
    {
        return response("Xóa loại sản phẩm/danh mục: $id", 200);
    }
}
