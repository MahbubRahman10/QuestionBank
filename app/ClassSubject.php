<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $table = 'classsubject';

    public function classes() {
        return $this->belongsTo('App\Class');
    }

    public function subjects() {
        return $this->belongsTo('App\Subject');
    }

    public function sections() {
        return $this->hasMany('App\Section');
    }

    public function CreativeQuestions() {
        return $this->hasMany('CreativeQuestion');
    }
}
