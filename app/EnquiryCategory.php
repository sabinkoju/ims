<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryCategory extends Model
{
    protected $fillable=['cat_name','status','slug'];


    public function getValidationRules(){
        return [
            'cat_name'=>'required|string',
            'status'=>'nullable|in:1',
        ];
    }

    public function enquiries(){
        return $this->belongsToMany(Enquiry::class, 'enquiries_enquiry_categories');
    }
}
