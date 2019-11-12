<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'first_name', 'last_name', 'phone', 'address', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function assessment(){
        return $this->hasMany('App\Assessment');
    }
    public function course(){
        return $this->hasMany('App\Course');
    }
    public function reg(){
        return $this->hasMany('App\Registration');
    }
    public function report(){
        return $this->hasMany('App\Report');
    }
    public function submission(){
        return $this->hasMany('App\Submission');
    }
}
