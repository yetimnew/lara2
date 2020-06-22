<?php

namespace App;

use App\User;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'id','name', 'email', 'password','active'
    ];

 protected $hidden = [
        'password', 'remember_token',
    ];


   public function profile()
   {
       return $this->hasOne('App\Profile');
   }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	public function getNameAttribute($value)
    {
        return  ucwords($value);
    }
    public function isOnline()
    {
         $val = Cache::has('user-is-online-'. $this->id);
        //  dd( $val);
    }
}
