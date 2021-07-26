<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'title',
        'task',
        'state',
        'description',
        'total'
    ];

    public function state() {
        return $this->hasOne(BudgetState::class,  'id','state_id');
    }

    public function Lines() {
        return $this->hasMany(BudgetLine::class,  'budget_id');
    }
}
