<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function examinations()
    {
    	return $this->hasMany('App\BoardExamination')->with('App\Examination');
    }
}
