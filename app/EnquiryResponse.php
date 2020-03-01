<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryResponse extends Model
{
    protected $table = 'enquiries_responses';

    public function enquiries(){
        return $this->belongsToMany(Enquiry::class, 'enquiries_responses');
    }
}
