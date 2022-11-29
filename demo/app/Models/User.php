<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Uuid;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'users';
    protected $fillable = [
        'created_by','user_type_id','name','code','username','original_password','address','city','phone_number','sender_commission','receiving_commission','limit','current_balance','image','api_token','status','is_head_office','device_type','is_verified','device_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    // 'id'=>'int',
    // 'username' => 'string',
    // 'contact_number' => 'string',
    // 'email' => 'string',
    // 'user_type' => 'string',
    // 'status' => 'string',
    // 'avatar' => 'string',
    // 'device_token' => 'string',
    // 'device_type' => 'string',
    // 'otp_number' => 'string',
    // 'otp_expire' => 'string',
    // ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getTableName(){
        return ((new self)->getTable());
    }

    // protected function castAttribute($key, $value)
    // {
    //     if (! is_null($value)) {
    //         return parent::castAttribute($key, $value);
    //     }
    //     switch ($this->getCastType($key)) {
    //         case 'int':
    //         case 'integer':
    //         return (int) 0;
    //         case 'real':
    //         case 'float':
    //         case 'double':
    //         return (float) 0;
    //         case 'enum':
    //         return '';
    //         case 'string':
    //         return '';
    //         case 'bool':
    //         case 'boolean':
    //         return false;
    //         case 'object':
    //         case 'array':
    //         case 'json':
    //         return [];
    //         case 'collection':
    //         return new BaseCollection();
    //         case 'date':
    //         return $this->asDate('0000-00-00');
    //         case 'datetime':
    //         return $this->asDateTime('0000-00-00');
    //         case 'timestamp':
    //         return '';
    //         default:
    //         return $value;
    //     }
    // }
}