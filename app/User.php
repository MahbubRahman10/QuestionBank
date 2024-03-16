<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password','remember_token','email_token','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function normalexams()
    {
        return $this->belongsToMany('App\NormalExamQuestion')->withPivot('exam_token','answer','result');
    }

    public function forum()
    {
        return $this->hasMany('App\Forum');
    }

    // Verified the user
    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }
    
    // Check Is User Admin 
    public function isAdmin()
    {
        return $this->isAdmin; // this looks for an admin column in your users table
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    

}
