<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=['student_id'];

    public function getValidationRules()
    {
        return [
            'student_id'=>'required|string'
        ];
    }
}
