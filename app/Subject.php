<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function classes()
    {
    	return $this->hasMany('App\ClassSubject')->with('App\Class');
    }
}
