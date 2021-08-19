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
        'quantity',
        'type_id',
        'prio',
        'price'
    ];

    protected $casts = [
//        'quantity' => 'float'
        'prio' => 'boolean'
    ];

    public function type() {
        return $this->hasOne(ProductType::class, 'id', 'type_id');
    }

}
