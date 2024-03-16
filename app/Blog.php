<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{	
	use \Conner\Tagging\Taggable;
	
	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
	public function admin()
	{
		return $this->belongsTo('App\Admin');
	}
}
