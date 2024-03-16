<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NormalExamQuestion extends Model
{
    //
	public function users()
	{
		return $this->belongsToMany('App\User')->withPivot('exam_token','answer','result');
	}
}
