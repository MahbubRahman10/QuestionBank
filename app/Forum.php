<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
	use \Conner\Tagging\Taggable;

	protected $fillable = [ 'user_id','title', 'category', 'description' ];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	
	public function reply()
	{
		return $this->hasMany('App\Reply');
	}
}
