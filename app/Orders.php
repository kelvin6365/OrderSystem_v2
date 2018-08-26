<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Orders extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_code', 'c_name', 'email','phone_no','adress','c_option','order_paystate','order_state','order_handle','type_total'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
