<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'productname' => [
                'required',
                'string',
                'min:3',
                'max:150',
                Rule::unique('products', 'productname')->ignore($product),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:200',
                Rule::unique('products', 'slug')->ignore($product),
                'regex:/^[a-z0-9\-]+$/',
            ],
            'price' => 'required|numeric|min:0',
            'pricesdiscount' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
            'cateid' => 'required|exists:categories,cateid',
            'brandid' => 'nullable|exists:brands,id',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute không được để trống.',
            'min' => ':attribute phải từ :min ký tự trở lên.',
            'max' => ':attribute không vượt quá :max ký tự.',
            'unique' => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in' => ':attribute không hợp lệ.',
            'cateid.exists' => 'Loại sản phẩm không hợp lệ.',
            'brandid.exists' => 'Thương hiệu không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug' => 'Đường dẫn (Slug)',
            'price' => 'Giá',
            'pricesdiscount' => 'Giá khuyến mãi',
            'image' => 'Ảnh',
            'status' => 'Trạng thái',
            'cateid' => 'Loại sản phẩm',
            'brandid' => 'Thương hiệu',
            'description' => 'Mô tả',
        ];
    }
}
