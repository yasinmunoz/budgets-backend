<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Budget extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
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
        return $this->hasMany(BudgetLine::class);
    }


}
