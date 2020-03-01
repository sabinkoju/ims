<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
     public function batches(){
        return $this->belongsToMany(Batch::class, 'batch_shift');
    }

   
}
