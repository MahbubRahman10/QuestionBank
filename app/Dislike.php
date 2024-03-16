<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
	public function reply()
	{
		return $this->belongsTo('App\Reply');
	}
}
