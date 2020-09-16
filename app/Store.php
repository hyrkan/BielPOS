<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
use App\Cart;
use App\Invoice;

class Store extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->hasMany(User::class);
    }
    
    public function product(){
        return $this->hasMany(Product::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    
}
