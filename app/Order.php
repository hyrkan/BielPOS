<?php

namespace App;
use App\Order;
use App\Invoice;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function invoices(){
        return $this->hasMany(Order::class);
    }
   


    
}
