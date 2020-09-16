<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Store;
use App\User;
use App\Product;

class Cart extends Model
{
    protected $guarded = [];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}