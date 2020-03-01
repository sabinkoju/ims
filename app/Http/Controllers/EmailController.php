<?php

namespace App\Http\Controllers;

use App\Email;
use Mail;
use App\User;
use App\Mail\SendMailable;
use App\Student;
use App\Teacher;
use App\Enquiry;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function addEmailTemplate(Request $request){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        if($request->isMethod('post')){
        $data=$request->all();
        $emailtemplate= new Email; 
        $emailtemplate->name=$data['name'];
        if(empty($data['message'])){
            $emailtemplate->message = "";
        } else {
            $emailtemplate->message = $data['message'];
        }

        $emailtemplate->save();
            return redirect()->route('viewEmailTemplate')->with('flash_message', 'New Template Has Been Added');

    }

    return view('admin.emailtemplate.add');
}

    public function viewEmailTemplate()
    {
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $emailtemplates= Email::latest()->get();
        
        return view ('admin.emailtemplate.view', compact('emailtemplates'));
    }

    public function editEmailTemplate (Request $request,$id){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
            $emailtemplate= Email::findOrFail($id);
        if($request->isMethod('post')){
            $data = $request->all();
            $emailtemplate->name=$data['name'];
            if(empty($data['message'])){
                $emailtemplate->message = "";
            } else {
                $emailtemplate->message = $data['message'];
            }
    
            $emailtemplate->save();
                return redirect()->route('viewEmailTemplate')->with('flash_message', 'Template Has Been Updated');
        }

        return view ('admin.emailtemplate.edit', compact('emailtemplate'));
    }

     // Delete Email Template
     public function deleteEmailTemplate($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $emailtemplate = Email::findOrFail($id);
        $emailtemplate->delete();


        return redirect()->route('viewEmailTemplate')->with('flash_message', 'Email Template Has Been Deleted');
    }

    public  function s_emailview(){
        $email=Email::latest()->get();

        $student=Student::latest()->get();
        return view('admin.emailtemplate.Student.s_emailview',compact('student','email'));
   }

   public  function st_emailview(){
    $email=Email::latest()->get();

    $staff=User::where('role_id','2')->get();

    return view('admin.emailtemplate.Staff.st_emailview',compact('staff','email'));
}

   public  function t_emailview(){
    $email=Email::latest()->get();

    $teacher=Teacher::latest()->get();
    return view('admin.emailtemplate.Teacher.t_emailview',compact('teacher','email'));
}

public  function e_emailview(){
    $email=Email::latest()->get();
    $enquiry=Enquiry::latest()->get();
    return view('admin.emailtemplate.Enquiry.e_emailview',compact('enquiry','email'));
}

    public  function sendemail(Request $request){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        // dd($request);
        $data=$request->all();
        // dd($data);
        // dd($data['email_message'])
          if (empty($data['email'])){
            return redirect()->back()->with('flash_error', 'Please Select Receiver');

        }
         $email = $data['email'];
        
     
      
    

        foreach ($email as $emails) {
            // dd($emails);
             Mail::to($emails)->send(new SendMailable($data));
        }
    

       
        
        // Mail::queue('emails.custom', $messageData, function ($message) use ($email){
        //     $message->to($email)->subject('NEW MAIL FROM IMS');
        // });

    

    return redirect()->back()->with('flash_message', 'Email Sent successfully');
}


    
}

