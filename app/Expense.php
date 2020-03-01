<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function expensecategory(){
        return $this->belongsTo(ExpenseCategory::class, 'expense_category');
    }
}
