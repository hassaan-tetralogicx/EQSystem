<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
