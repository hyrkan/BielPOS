<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\User;
use App\StockIn;

class Product extends Model
{
    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function stockin()
    {
        return $this->hasMany(StockIn::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }
    

}
