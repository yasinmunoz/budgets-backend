<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'cuantity',
        'type',
        'prio',
        'price'
    ];

    protected $casts = [
//        'cuantity' => 'float'
        'prio' => 'boolean'
    ];

}
