<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExpenseCategory;
use PDF;

class ExpenseCategoryController extends Controller
{
    public function addExpenseCategory(Request $request){

        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
    	 if($request->isMethod('post')){
            $data = $request->all();
            $expense_category = new ExpenseCategory;
            $expense_category->expense_category_name = $data['name'];
            

            $expense_category->save();
            return redirect()->route('viewExpenseCategory')->with('flash_message', 'New Expense Has Been Added');

        }
        
    
    	return view ('admin.expense.category.add');

    	}
    

     // View ExpenseCategory
    public function viewExpenseCategory(){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $expense_categories = ExpenseCategory::latest()->get();
        return view ('admin.expense.category.view', compact('expense_categories'));
    }

     // Edit ExpenseCategory
		public function editExpenseCategory(Request $request, $id){
            if(\Gate::denies('admin_staff')){
                abort(403, 'Access Denied');
            }
        $expense_category = ExpenseCategory::findOrFail($id);
        if($request->isMethod('post')){
            $data = $request->all();
            $expense_category->expense_category_name = $data['name'];
           

           
            $expense_category->save();

            
            

            return redirect()->route('viewExpenseCategory')->with('flash_message', 'Expense Has Been Updated');

        }

        return view ('admin.expense.category.edit', compact('expense_category'));
    }

     // Delete ExpenseCategory
     public function deleteExpenseCategory($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->delete();


        return redirect()->route('viewExpenseCategory')->with('flash_message', 'Expense Category Has Been Deleted');
    }
    //generatePDF
     public function generatePDF() {
        
        $data['expense_category'] = ExpenseCategory::all();

        $pdf = PDF::loadView('admin.expense.category.pdf', $data);
        
         $pdf->save(storage_path().'_filename.pdf');
  
        return $pdf->download('expense_category.pdf');
    }

}
