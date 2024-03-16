<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreativeQuestion extends Model
{
	protected $table = 'creative_questions';
	
    public function classSubject()
    {
        return $this->belongsTo('App\ClassSubject');
    }
}
