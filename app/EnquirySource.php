<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquirySource extends Model
{
    protected $fillable=['name','status'];

    public function getValidationRules(){
        return [
            'name'=>'required|string',
            'status'=>'nullable|in:1'
        ];
    }
    public function enquiries(){
        return $this->belongsToMany(Enquiry::class, 'enquiries_source');
    }
}
