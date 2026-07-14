<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index($limit = 10)
    {
        $list = Category::select('cateid', 'catename', 'slug', 'image', 'status')
            ->whereNull('deleted_at')
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
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = Str::slug($request->catename) . '.' . $file->extension();
            $file->storeAs('categories', $fileName, 'public');
            $imagePath = $fileName;
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
        if ($request->hasFile('img')) {
            if ($category->image && Storage::disk('public')->exists('categories/' . $category->image)) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }

            $file = $request->file('img');
            $fileName = Str::slug($request->catename) . '.' . $file->extension();
            $file->storeAs('categories', $fileName, 'public');
            $imagePath = $fileName;
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
            $category->delete();
        }

        return Redirect::route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công.');
    }

    public function trash($limit = 10)
    {
        $list = Category::onlyTrashed()
            ->orderBy('catename')
            ->paginate($limit);

        return view('admin.categories.trash', compact('list'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);

        if ($category) {
            $category->restore();
        }

        return Redirect::route('admin.categories.trash')
            ->with('success', 'Khôi phục thành công.');
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->find($id);

        if ($category) {
            if ($category->image && Storage::disk('public')->exists('categories/' . $category->image)) {
                Storage::disk('public')->delete('categories/' . $category->image);
            }
            $category->forceDelete();
        }

        return Redirect::route('admin.categories.trash')
            ->with('success', 'Xóa vĩnh viễn thành công.');
    }
}
