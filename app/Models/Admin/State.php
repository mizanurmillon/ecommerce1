<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Country;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
