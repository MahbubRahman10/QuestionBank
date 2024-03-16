<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	public function forum()
	{
		return $this->belongsTo('App\Forum');
	}
	
	public function likes()
	{
		return $this->hasMany('App\Like');
	}

	public function dislikes()
	{
		return $this->hasMany('App\Dislike');
	}
}
