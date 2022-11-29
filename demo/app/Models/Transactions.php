<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transactions extends Model
{
    use SoftDeletes;
    protected $table='transactions';
    protected $fillable = [
        'created_by','accepted_by','from_user_id','to_user_id','from_name','from_commission_amount','from_commission','from_current_balance','from_total_balance','from_closing_balance','amount','to_name','to_commission_amount','to_commission','to_current_balance','to_total_balance','to_closing_balance','profit','transaction_profit','remarks','sender_name','sender_contact','receiver_name','receiver_contact','transaction_type','status'
    ];
    public static function getTableName(){
        return ((new self)->getTable());
    }
    public function from_user_list()
    {
        return $this->hasOne('App\Models\User','id','from_user_id');
    }

    public function to_user_list()
    {
        return $this->hasOne('App\Models\User','id','to_user_id');
    }

    public function fromBranch(){
        return $this->belongsTo(User::class,'from_user_id');
    }
    public function toBranch(){
        return $this->belongsTo(User::class,'to_user_id');
    }
}
