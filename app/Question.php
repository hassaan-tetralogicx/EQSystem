<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function mcqs(){
        return $this->hasMany(Mcq::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
