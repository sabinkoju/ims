<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    public function courses(){
        return $this->belongsToMany(Course::class, 'batch_course');
    }

     public function shifts(){
        return $this->belongsToMany(Shift::class, 'batch_shift');
    }


    public function sections(){
        return $this->belongsTo(Section::class, 'section');
    }
}
