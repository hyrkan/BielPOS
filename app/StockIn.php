<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;


class StockIn extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(StockIn::class);
    }

    
}
