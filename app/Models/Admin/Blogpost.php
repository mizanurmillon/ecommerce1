<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Blogcategory;

class Blogpost extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogcategory_id',
        'blog_title',
        'blog_slug',
        'banner_image',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
        'meta_image',
        'meta_keywords',
        'status',
        'date'
    ];
    public function blogcategory()
    {
        return $this->belongsTo(Blogcategory::class, 'blogcategory_id');
    }
}
