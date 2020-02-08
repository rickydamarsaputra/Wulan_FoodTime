<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['menu_id', 'order_id', 'order_amount', 'payment_amount_detail'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
