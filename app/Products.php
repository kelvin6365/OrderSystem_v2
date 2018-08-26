<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Products extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_no', 'item_name', 'count','item_price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
}
