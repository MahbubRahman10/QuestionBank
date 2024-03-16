<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardQuestion extends Model
{
    public function boardExamination()
    {
        return $this->belongsTo('App\BoardExamination');
    }
}

