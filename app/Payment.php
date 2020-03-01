<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
        public function getpaymentcode(){
            $payment_num = 1;
            $row = self::orderBy('id', 'DESC')->first();
            $payment_new = (is_null($row)) ? '#PAYMENT-'.$payment_num : '#PAYMENT-'.((int)(
                    str_replace("#PAYMENT-", "", $row->code)
                    ) + 1);
            return $payment_new;
        }
}
