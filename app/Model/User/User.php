<?php

namespace App\Model\User;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'member_username', 'member_email', 'memberid', 'member_password','api_token'
    ];
    
    /**
     * @var string table cmp_member
     */
    protected $table = 'cmp_member';
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'member_password','api_token'
    ];
    
    /**
     * @var bool timestamps
     */
    public $timestamps = false;
    
    public function merchant()
    {
        return $this->belongsTo('Merchant');
    }
    
}
