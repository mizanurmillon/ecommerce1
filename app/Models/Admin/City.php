<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Country;
use App\Models\Admin\State;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'state_id',
        'name',
        'status',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
