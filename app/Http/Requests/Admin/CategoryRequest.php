<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('category');

        return [
            'catename' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('categories', 'catename')->ignore($category),
            ],
            'slug' => [
                'required',
                'string',
                'min:5',
                'max:150',
                Rule::unique('categories', 'slug')->ignore($category),
                'regex:/^[a-z0-9\-]+$/',
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
            'sort_order' => 'nullable|integer',
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
        ];
    }

    public function attributes(): array
    {
        return [
            'catename' => 'Tên loại',
            'slug' => 'Đường dẫn (Slug)',
            'image' => 'Ảnh',
            'status' => 'Trạng thái',
            'sort_order' => 'Thứ tự',
            'description' => 'Mô tả',
        ];
    }
}
