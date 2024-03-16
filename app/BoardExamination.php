<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardExamination extends Model
{
    public function boards() {
        return $this->belongsTo('App\Board');
    }

    public function examinations() {
        return $this->belongsTo('App\Examination');
    }

    public function boardQuestions() {
        return $this->hasMany('App\BoardQuestion');
    }

     public function testQuestions() {
        return $this->hasMany('App\TestQuestion');
    }
}
