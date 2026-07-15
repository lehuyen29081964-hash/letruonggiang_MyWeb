<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\ProductImage;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $primaryKey = 'id';

    protected $fillable = [
        'productname',
        'cateid',
        'brandid',
        'slug',
        'price',
        'pricesdiscount',
        'image',
        'status',
        'description',
    ];

    // Quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    // Quan hệ với Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandid', 'id');
    }

    // Quan hệ với ảnh phụ
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
