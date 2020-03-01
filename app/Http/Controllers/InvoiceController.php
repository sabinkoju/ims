<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use PDF;

use App\Course;
use App\Student;


class InvoiceController extends Controller
{

    protected $invoice=null;
    protected $student=null;
    protected $course=null;

    public function __construct(Invoice $invoice,Course $course,Student $student)
    {
        $this->invoice=$invoice;
        $this->course=$course;
        $this->student=$student;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->invoice->orderBy('student_name','ASC')->get();
        return view('admin.invoices.view')->with('invoices',$data);
    }


    public function singleinvoice()
    {
        return view('admin.invoices.singleview');
    }


    /**;
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
       // $courses = Course::where('status', 1)->orderBy('name', 'ASC')->get();
        $course=$this->course->where('status',1)->get();
        $student=$this->student->orderBy('fname','ASC')->get();   
        return view('admin.invoices.form')->with('courses',$course)->with('students',$student);
      //  if ($request->isMethod('post')) {
            // $data = $request->all();
            // dd($data);
            // $invoices = new Invoice;
            // $invoice->student_name = $data['student_name'];
            // $invoices->course = $data['course_id'];
            // $batch->course_fee = $data['mcourse_fee'];
            // $invoices->date = $data['date'];
            // $invoices->save();


            // $course_id = $data['course_id'];
        
            // $invoices->courses()->attach($course_id);
          //  $

        // }
       
        // return view('admin.invoices.form',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules=$this->invoice->getValidationRules();
        $request->validate($rules);
        $data=$request->all();
        //dd($request->request);
        $this->invoice->fill($data);
        dd($this->invoice);
        $success=$this->invoice->save();
        if($success){
            return redirect()->route('invoice.index')->with('flash_message', 'New Invoice Has Been Added');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showinvoice($id)
    {
        return view('admin.invoices.sampleview');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=$this->invoice->find($id);
        $course=$this->course->where('status',1)->orderBy('name','ASC')->get();
        $student=$this->student->orderBy('fname','ASC')->get();
       return view('admin.invoices.form')->with('courses',$course)->with('students',$student)->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=$this->invoice->getValidationRules();
        $request->validate($rules);
        $data=$request->all();
        $this->invoice=$this->invoice->find($id);
        $this->invoice->fill($data);
        $success=$this->invoice->save();
        if($success){
            return redirect()->route('invoice.index')->with('flash_message', 'Invoice Has Been Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->invoice=$this->invoice->find($id);
        $success=$this->invoice->delete();
        if($success){
            return redirect()->route('invoice.index')->with('flash_message', 'Invoice Has Been Deleted');
        }
    }
 
     //print part
     public function printInvoice(){
        $data['invoices']=invoice::all();
         return view('admin.invoices.print',$data);
    }
    

    
}
