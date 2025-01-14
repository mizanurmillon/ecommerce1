<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'slug',
        'content',
        'page_position',
        'status',
    ];
}
