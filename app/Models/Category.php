<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $primaryKey = 'cateid';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'catename',
        'slug',
        'image',
        'status',
        'sort_order',
        'description'
    ];
}