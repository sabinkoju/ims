<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Fee;
use App\Course;
use App\Student;
use PDF;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\AuthManage;
use DB;
class FeesController extends Controller
{
public function addFees(Request $request)
{      if(\Gate::denies('admin_staff')){
    abort(403, 'Access Denied');
}
     $courses = Course::where('status', 1)->orderBy('name', 'ASC')->get();
     $student= Student::all();
    //  dd($student);

	 if($request->isMethod('post')){



            $data = $request->all();
            $fees  = new Fee;
            $fees->student_id = $data['student_id'];
            $fees->title = $data['title'];
            $fees->amount = $data['amount'];



            $fees->save();


             $student = Student::findOrFail($data['student_id']);
             $student->due=$student->due+$data['amount'];
             $student->save();

            return redirect()->route('viewFees')->with('flash_message', 'New Fee Has Been Added');

        }

return view('admin.fee.add',compact('courses','student'));

}


public function viewFees(Request $request){
    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }

    $students=Student::latest()->get();

    $totalamountpaid = 0;

     if($request->isMethod('post')){

        // dd($request->student);
        if($request->student==null){return redirect()->back();}
        $fees=Fee::where('student_id',$request->student)->get();
        $student_name=Student::where('id',$request->student)->first();


         $paidsum=Payment::where('student_id',$request->student)->get();


         $total=0;

         foreach ($paidsum as $key => $value) {
            $paidsum=$value->sum('amount_paid');
             $totalamountpaid=$total+$paidsum;

         }
        // dd($fees);
          return view ('admin.fee.view', compact('fees','students','student_name','totalamountpaid'));
        }


        return view ('admin.fee.view', compact('students'));
    }

 public function editpayment(Request $request,$id){

    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
     $payment=Payment::findOrFail($id);
    $lastamount=$payment->amount_paid;
//    dd($payment);


     if($request->isMethod('post')){
         $data=$request->all();

         $payment->amount_paid=$data['amount'];
         $payment->received_by=$data['received_by'];
         $payment->payment_title=$data['title'];
         $payment->mode_of_payment=$data['mode_of_payment'];
         $payment->document_number=$data['document_number'];

         $random = str_random(20);
         if ($request->hasFile('doc_image')) {
             $image_tmp = Input::file('doc_image');
             if ($image_tmp->isValid()) {
                 $extension = $image_tmp->getClientOriginalExtension();
                 $filename = $random . '.' . $extension;
                 $image_path = 'public/uploads/feedocuments/' . $filename;
                 // Resize Image Code
                 Image::make($image_tmp)->save($image_path);
                 // Store image name in products table
                 $payment->doc_image = $filename;
             }
         }

         $payment->save();

         if($payment->save()) {

             $student = Student::findOrFail($payment->student_id);
             $student->due = $student->due + $lastamount;
              $student->due=$student->due-$data['amount'];
             $student->save();

         }
        return redirect()->route('viewFees');

     }









    return view('admin.fee.edit',compact('payment'));

    }
 public function deletepayment($id){
    if(\Gate::denies('admin')){
        abort(403, 'Access Denied');
    }
    $payment = Payment::findOrFail($id);
    $paidamount=$payment->amount_paid;
    $std=$payment->student_id;
     $student = Student::where('id',$std)->first();
     $std_due=$student->due;
     $student->due=$std_due+$paidamount;
     $student->save();


     $image_path = 'public/uploads/feedocuments/';

     if(!empty($payment->doc_image)){
         if(file_exists($image_path.$payment->doc_image)){
             unlink($image_path.$payment->doc_image);
         }
     }
     $payment->delete();


     return redirect()->route('viewFees');

}



    public function deletefee($id){

        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $fee = Fee::findOrFail($id);

        $lastfee=$fee->amount;
        $std=$fee->student_id;
        $student = Student::where('id',$std)->first();
        $student->due=$student->due-$lastfee;

        $student->save();
        $fee->delete();


        return redirect()->route('viewFees');


    }

    public function viewpaymentreport($id){

        $lastpayment =Payment::findOrFail($id);
        $student=Student::where('id',$lastpayment->student_id)->first();
        $totalamountpaid=Payment::where('student_id',$lastpayment->student_id)->sum('amount_paid');

        // echo $totalpayment;
      return view('admin.invoices.sampleview',compact('lastpayment','student','totalamountpaid'));
    }
 //generatePDF
     public function generatePDF() {

        $data['fees'] = Fee::all();

        $pdf = PDF::loadView('admin.fee.pdf', $data);

         $pdf->save(storage_path().'_filename.pdf');

        return $pdf->download('fees.pdf');
    }

    //print part
    public function printFees(){
        $data['fees']=Fee::all();
         return view('admin.fee.print',$data);


    }


    // Get Student Course
    public function getStudentCourse(Request $request){
       $data = $request->all();
       $student = Student::findOrFail($data['studentId']);
       $name = $student->fname;
       echo $name;
    }

    public function makepayment(Request $request){


        if($request->isMethod('post')){
            $data=$request->all();

            $payment=new Payment;
            $payment->student_id=$data['student_id'];
            $payment->amount_paid=$data['amount'];
            $payment->payment_code=$payment->getpaymentcode();
            $payment->received_by=$data['received_by'];
            $payment->payment_title=$data['title'];
            $payment->mode_of_payment=$data['mode_of_payment'];
            $payment->document_number=$data['document_number'];

            $random = str_random(20);
            if ($request->hasFile('doc_image')) {
                $image_tmp = Input::file('doc_image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;
                    $image_path = 'public/uploads/feedocuments/' . $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $payment->doc_image = $filename;
                }
            }

            $payment->save();
            if($payment->save()) {

                $payment_id= DB::getPdo()->lastInsertId();
                $student = Student::findOrFail($data['student_id']);
                $student->due = $student->due - $data['amount'];
                $student->save();
            }

            return redirect()->route('viewpaymentreport',$payment_id);
        }

        return redirect()->route('viewFees');

        }

        public function viewfeedetails($id){
        $payments=Payment::where('student_id',$id)->get();

        return view('admin.invoices.viewfeedetails',compact('payments'));

    }

}
