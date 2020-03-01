<?php

namespace App\Http\Controllers;

use App\ExpenseCategory;
use App\Expense;
use Illuminate\Http\Request;
use PDF;

class ExpenseController extends Controller
{
    public function addExpense(Request $request){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $expensecategories=ExpenseCategory::all();
        if($request->isMethod('post')){
            $data = $request->all();
            $expense = new Expense;
            $expense->expense_category= $data['cat_id'];
            $expense->received_by= $data['received_by'];
            $expense->amount= $data['amount'];
            

            $expense->save();
            return redirect()->route('viewExpense')->with('flash_message', 'New Expense Has Been Added');

        }
        
    
    	return view ('admin.expense.expenses.add', compact('expensecategories'));

    	}


    // View Expense
    public function viewExpense(){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }

        $expenses= Expense::latest()->with('expensecategory')->get();
        // dd($expenses);
        
        return view ('admin.expense.expenses.view', compact('expenses'));
    }

    // Edit ExpenseCategory
		public function editExpense(Request $request, $id){
            if(\Gate::denies('admin_staff')){
                abort(403, 'Access Denied');
            }
            $expensecategories=ExpenseCategory::all();
            $expense= Expense::findOrFail($id);
            if($request->isMethod('post')){
                $data = $request->all();
                $expense->expense_category= $data['cat_id'];
                $expense->received_by= $data['received_by'];
                $expense->amount= $data['amount'];
               
    
               
                $expense->save();
    
                
                
    
                return redirect()->route('viewExpense')->with('flash_message', 'Expense Has Been Updated');
    
            }
    
            return view ('admin.expense.expenses.edit', compact('expense','expensecategories'));
        }

         // Delete ExpenseCategory
     public function deleteExpense($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $expense = Expense::findOrFail($id);
        $expense->delete();


        return redirect()->route('viewExpense')->with('flash_message', 'Expense  Has Been Deleted');
    }
    //generatePDF
     public function generatePDF() {
        
        $data['expense'] = Expense::all();

        $pdf = PDF::loadView('admin.expense.expenses.pdf', $data);
        
         $pdf->save(storage_path().'_filename.pdf');
  
        return $pdf->download('expenses.pdf');
    }
    }

