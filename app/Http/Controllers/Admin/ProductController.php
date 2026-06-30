<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index($limit = 10)
    {
        $list = Product::with([
            'category:cateid,catename',
            'brand:id,brandname'
        ])
        ->select(
            'id',
            'productname',
            'price',
            'image',
            'status',
            'cateid',
            'brandid'
        )
        ->orderBy('productname')
        ->paginate($limit);

        return view('admin.products.index', compact('list'));
    }

    public function create()
    {
        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'productname' => 'required|string|max:150|unique:products,productname',
            'slug' => 'required|string|max:200|unique:products,slug',
            'price' => 'required|numeric|min:0',
            'pricesdiscount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
            'cateid' => 'required|exists:categories,cateid',
            'brandid' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_\.]/', '_', $image->getClientOriginalName());
            $destination = public_path('images/products');
            if (! file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $image->move($destination, $filename);
            $data['image'] = 'images/products/' . $filename;
        }

        $data['slug'] = Str::slug($data['slug']);
        $data['pricesdiscount'] = $data['pricesdiscount'] ?? 0;
        $data['brandid'] = $data['brandid'] ?? null;

        try {
            Product::create($data);

            return Redirect::route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = Product::with(['category', 'brand'])->find($id);

        if (! $product) {
            return Redirect::route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::find($id);

        if (! $product) {
            return Redirect::route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
        }

        $categories = Category::select('cateid', 'catename')->get();
        $brands = Brand::select('id', 'brandname')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        try {
            if (empty($request->cateid)) {
                return back()
                    ->withInput()
                    ->with('error', 'Vui lòng chọn loại sản phẩm');
            }

            $product = Product::find($id);

            if (! $product) {
                return Redirect::route('admin.products.index')->with('error', 'Sản phẩm không tồn tại.');
            }

            $data = $request->validate([
                'productname' => 'required|string|max:150|unique:products,productname,' . $id,
                'slug' => 'required|string|max:200|unique:products,slug,' . $id,
                'price' => 'required|numeric|min:0',
                'pricesdiscount' => 'nullable|numeric|min:0',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'status' => 'required|in:0,1',
                'cateid' => 'required|exists:categories,cateid',
                'brandid' => 'nullable|exists:brands,id',
                'description' => 'nullable|string',
            ]);

            if ($request->hasFile('image')) {
                if ($product->image && file_exists(public_path($product->image))) {
                    @unlink(public_path($product->image));
                }

                $image = $request->file('image');
                $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\\-_\\.]/', '_', $image->getClientOriginalName());
                $destination = public_path('images/products');
                if (! file_exists($destination)) {
                    mkdir($destination, 0755, true);
                }
                $image->move($destination, $filename);
                $data['image'] = 'images/products/' . $filename;
            }

            $data['slug'] = Str::slug($data['slug']);
            $data['pricesdiscount'] = $data['pricesdiscount'] ?? 0;
            $data['brandid'] = $data['brandid'] ?? null;

            $product->update($data);

            return Redirect::route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
            $product->delete();
        }

        return Redirect::route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công.');
    }
}