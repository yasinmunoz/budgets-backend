<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetLineState extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'description'
    ];
}
