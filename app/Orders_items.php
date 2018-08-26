<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Orders_items extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_code', 'item_no', 'item_name', 'count','item_price','item_option','state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
