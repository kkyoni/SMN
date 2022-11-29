<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Balance extends Model
{
    use SoftDeletes;
    protected $table='balances';
    protected $fillable = [
        'transaction_id','user_id','opening_balance','closing_balance','commission'
    ];
}
