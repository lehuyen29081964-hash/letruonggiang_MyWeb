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

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $image->getClientOriginalName());
            $destination = public_path('images/brands');
            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $data['image'] = 'images/brands/' . $filename;
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

        if ($request->hasFile('image')) {
            if ($brand->image && file_exists(public_path($brand->image))) {
                @unlink(public_path($brand->image));
            }
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $image->getClientOriginalName());
            $destination = public_path('images/brands');
            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $data['image'] = 'images/brands/' . $filename;
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
}
