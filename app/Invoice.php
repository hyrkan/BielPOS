<?php

namespace App;
use App\Cart;
use App\Store;
use App\Order;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function order(){
        return $this->belongsTo(Invoice::class);
    }

        


}
          