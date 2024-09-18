<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_slug',
        'type',
        'status',
        'banner',
        'icon',
        'cover_image',
        'meta_title',
        'meta_description',
    ];
}
