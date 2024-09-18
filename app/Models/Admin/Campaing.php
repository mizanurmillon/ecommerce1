<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaing extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaing_title',
        'discount_amount',
        'type',
        'status',
        'image',
        'starts_at',
        'ends_at',
    ];
}
