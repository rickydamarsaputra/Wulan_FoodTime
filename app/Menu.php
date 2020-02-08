<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_name', 'menu_price', 'time_ready', 'menu_image', 'menu_description'
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
