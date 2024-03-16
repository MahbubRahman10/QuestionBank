<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    public function boards()
    {
    	return $this->hasMany('App\BoardExamination')->with('App\Board');
    }
}
