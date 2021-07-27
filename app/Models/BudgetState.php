<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetState extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'description'
    ];
}
