<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Brand extends Model
{
    use SoftDeletes;
    protected $table = 'brands';

    protected $fillable = [
        'brandname',
        'slug',
        'image',
        'status',
        'sort_order',
        'description',
    ];

    public function getImageUrlAttribute()
    {
        if (! $this->image) {
            return null;
        }

        $image = trim($this->image);
        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        $image = ltrim($image, '/');

        if (file_exists(public_path($image))) {
            return asset($image);
        }

        if (file_exists(public_path('images/brands/' . $image))) {
            return asset('images/brands/' . $image);
        }

        if (file_exists(public_path('images/' . $image))) {
            return asset('images/' . $image);
        }

        $brandFiles = glob(public_path('images/brands/*.{jpg,jpeg,png,gif,svg}'), GLOB_BRACE);
        if (count($brandFiles) === 1) {
            return asset('images/brands/' . basename($brandFiles[0]));
        }

        return null;
    }

    // Quan hệ với Product
    public function products()
    {
        return $this->hasMany(Product::class, 'brandid', 'id');
    }
}
