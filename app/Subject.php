<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
