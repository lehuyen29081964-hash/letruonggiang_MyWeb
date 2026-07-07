<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($limit = 10)
    {
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.index', compact('list'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $image->getClientOriginalName());
            $destination = public_path('images/categories');
            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $imagePath = 'images/categories/' . $filename;
        }

        Category::create([
            'catename' => $data['catename'],
            'slug' => Str::slug($data['slug']),
            'image' => $imagePath,
            'status' => $data['status'],
            'sort_order' => $data['sort_order'] ?? 0,
            'description' => $data['description'] ?? null,
        ]);

        return Redirect::route('admin.categories.index')
            ->with('success', 'Tạo danh mục thành công.');
    }

    public function show($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return Redirect::route('admin.categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        if (! $category) {
            return Redirect::route('admin.categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        if (! $category) {
            return Redirect::route('admin.categories.index')->with('error', 'Danh mục không tồn tại.');
        }

        $data = $request->validated();

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path($category->image))) {
                @unlink(public_path($category->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $image->getClientOriginalName());
            $destination = public_path('images/categories');
            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $imagePath = 'images/categories/' . $filename;
        }

        $category->update([
            'catename' => $data['catename'],
            'slug' => Str::slug($data['slug']),
            'image' => $imagePath,
            'status' => $data['status'],
            'sort_order' => $data['sort_order'] ?? 0,
            'description' => $data['description'] ?? null,
        ]);

        return Redirect::route('admin.categories.index')
            ->with('success', 'Cập nhật danh mục thành công.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category) {
            if ($category->image && file_exists(public_path($category->image))) {
                @unlink(public_path($category->image));
            }
            $category->delete();
        }

        return Redirect::route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công.');
    }
}
