<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
	public function classsubjects()
	{
		return $this->hasMany('App\ClassSubject');
	}
}
