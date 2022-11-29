<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
    use SoftDeletes;
    protected $table='expenses';
    protected $fillable = [
        'to_user_id','expense_type_id','amount','from_user_id','transactions_id'
    ];
    public function to_user_list()
    {
        return $this->hasOne('App\Models\User','id','to_user_id');
    }
    public function form_user_list()
    {
        return $this->hasOne('App\Models\User','id','from_user_id');
    }

    public function expense_type()
    {
        return $this->hasOne('App\Models\ExpenseType','id','expense_type_id');
    }
}
