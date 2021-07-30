<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'task_id',
        'state_id',
        'description',
        'total_in_hours',
        'total'
    ];

    public function state() {
        return $this->hasOne(BudgetState::class,  'id','state_id');
    }

    public function lines() {
        return $this->hasMany(BudgetLine::class,  'budget_id');
    }


}
