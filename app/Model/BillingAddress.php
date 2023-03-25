<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    public function city()
    {
        return $this->belongsTo(City::class,'city');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country');
    }

}
