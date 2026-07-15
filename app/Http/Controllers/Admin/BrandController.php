<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index($limit = 10)
    {
        $list = Brand::select('id', 'brandname', 'slug', 'image', 'status')
            ->orderBy('brandname')
            ->paginate($limit);

        return view('admin.brands.index', compact('list'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(BrandRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->brandname) . '.' . $file->extension();
            $file->storeAs('brands', $fileName, 'public');
            $data['image'] = $fileName;
        }

        $data['slug'] = Str::slug($data['slug']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['description'] = $data['description'] ?? null;

        try {
            Brand::create($data);
            return Redirect::route('admin.brands.index')
                ->with('success', 'Thêm thương hiệu thành công.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $data = $request->validated();

        if ($request->hasFile('img')) {
            if ($brand->image && file_exists(storage_path('app/public/brands/' . $brand->image))) {
                @unlink(storage_path('app/public/brands/' . $brand->image));
            }
            $file = $request->file('img');
            $fileName = Str::slug($request->brandname) . '.' . $file->extension();
            $file->storeAs('brands', $fileName, 'public');
            $data['image'] = $fileName;
        } else {
            $data['image'] = $brand->image;
        }

        $data['slug'] = Str::slug($data['slug']);
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['description'] = $data['description'] ?? null;

        try {
            $brand->update($data);
            return Redirect::route('admin.brands.index')
                ->with('success', 'Cập nhật thương hiệu thành công.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy(Brand $brand)
    {
        if ($brand->image && file_exists(public_path($brand->image))) {
            @unlink(public_path($brand->image));
        }

        $brand->delete();

        return Redirect::route('admin.brands.index')
            ->with('success', 'Xóa thương hiệu thành công.');
    }

    public function trash($limit = 10)
    {
        $list = Brand::onlyTrashed()->orderBy('brandname')->paginate($limit);
        $trashCount = Brand::onlyTrashed()->count();

        return view('admin.brands.trash', compact('list', 'trashCount'));
    }

    public function restore($id)
    {
        try {
            Brand::onlyTrashed()->findOrFail($id)->restore();
            return Redirect::route('admin.brands.trash')
                ->with('success', 'Khôi phục thương hiệu thành công.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Khôi phục thất bại.');
        }
    }

    public function restoreAll()
    {
        try {
            Brand::onlyTrashed()->restore();
            return Redirect::route('admin.brands.trash')
                ->with('success', 'Khôi phục tất cả thương hiệu thành công.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Khôi phục tất cả thất bại.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $brand = Brand::withTrashed()->findOrFail($id);

            if ($brand->image && file_exists(public_path($brand->image))) {
                @unlink(public_path($brand->image));
            }

            $brand->forceDelete();

            return Redirect::route('admin.brands.trash')
                ->with('success', 'Xóa vĩnh viễn thương hiệu thành công.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Xóa vĩnh viễn thất bại.');
        }
    }

    public function forceDeleteAll()
    {
        try {
            Brand::onlyTrashed()->forceDelete();
            return Redirect::route('admin.brands.trash')
                ->with('success', 'Xóa vĩnh viễn tất cả thương hiệu thành công.');
        } catch (\Exception $e) {
            return Redirect::back()->with('error', 'Xóa vĩnh viễn tất cả thất bại.');
        }
    }
}
