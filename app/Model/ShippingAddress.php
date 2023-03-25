<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $casts = [
        'customer_id' => 'integer',
    ];


    public function city()
    {
        return $this->belongsTo(City::class,'city');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country');
    }

}
