<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function users(){
        return $this->belongsToMany(User::class)->withPivot('exam_status');
    }
    public function results(){
        return $this->hasMany(Result::class);
    }
}
