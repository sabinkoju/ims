<?php

namespace App\Http\Controllers;

use App\SmsTemplate;
use App\Student;
use App\User;
use App\Teacher;
use App\Enquiry;
use Illuminate\Http\Request;

use GuzzleHttp\Client; 
use Guzzle\Http\Exception\ClientErrorResponseException;
class SmsTemplateController extends Controller
{
    public function addSmsTemplate(Request $request){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        if($request->isMethod('post')){
        $data=$request->all();
        $smstemplate= new SmsTemplate;
        $smstemplate->name=$data['name'];
        if(empty($data['message'])){
            $smstemplate->message = "";
        } else {
            $smstemplate->message = $data['message'];
        }

        $smstemplate->save();
            return redirect()->route('viewSmsTemplate')->with('flash_message', 'New Template Has Been Added');

    }

    return view('admin.smstemplate.add');
}

    public function viewSmsTemplate()
    {    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
        $smstemplates= SmsTemplate::latest()->get();

        return view ('admin.smstemplate.view', compact('smstemplates'));
    }

    public function editSmsTemplate (Request $request,$id){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
            $smstemplate= SmsTemplate::findOrFail($id);
        if($request->isMethod('post')){
            $data = $request->all();
            $smstemplate->name=$data['name'];
            if(empty($data['message'])){
                $smstemplate->message = "";
            } else {
                $smstemplate->message = $data['message'];
            }

            $smstemplate->save();
                return redirect()->route('viewSmsTemplate')->with('flash_message', 'Template Has Been Updated');
        }

        return view ('admin.smstemplate.edit', compact('smstemplate'));
    }

     // Delete SMS Template
     public function deleteSmsTemplate($id){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $smstemplate = SmsTemplate::findOrFail($id);
        $smstemplate->delete();


        return redirect()->route('viewSmsTemplate')->with('flash_message', 'Expense Category Has Been Deleted');
    }

    public  function s_smsview(){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $sms=SmsTemplate::latest()->get();

        $student=Student::latest()->get();
        return view('admin.smstemplate.Student.s_smsview',compact('student','sms'));
   }

   public  function st_smsview(){
    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
    $sms=SmsTemplate::latest()->get();
    $staff=User::where('role_id','2')->get();
    // dd($staff);
    return view('admin.smstemplate.Staff.st_smsview',compact('staff','sms'));
}

   public  function t_smsview(){
    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
    $sms=SmsTemplate::latest()->get();

    $teacher=Teacher::latest()->get();
    return view('admin.smstemplate.Teacher.t_smsview',compact('teacher','sms'));
}

public  function e_smsview(){
    if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
    $sms=SmsTemplate::latest()->get();
    $enquiry=Enquiry::latest()->with('sources','category')->get();
//        dd($enquiry);

    return view('admin.smstemplate.Enquiry.e_smsview',compact('enquiry','sms'));
}

    public  function sendsms(Request $request){
//  

//    return $request;
       // API integration
       if(\Gate::denies('admin_staff')){
        abort(403, 'Access Denied');
    }
      if (empty($request->phone)){
            return redirect()->back()->with('flash_error', 'Please Select Receiver');

        }
           $token = getenv('sms_token');

            $from  = 'InfoSMS';
            $number=array();
            foreach ($request->phone as $phone){

                $value=(int) $phone+0;
                array_push($number,$value);

            }
            $phnumber=implode(',',$number);


            $to    = $phnumber;
            $text  = $request->sms;

           $api_url = "http://api.sparrowsms.com/v2/sms/?".http_build_query(array(
                   'token' => $token,
                   'from'  => $from,
                   'to'    => $to,
                   'text'  => $text

               ));

               $client = new \GuzzleHttp\Client();
               try{
               $request = $client->get($api_url);}
               
               catch (\Exception $e) {
    $responseBody = $e->getResponse();
    
    return redirect()->back()->with('flash_error', 'Please make sure all recipents are valid or you have enough credits');
  
}
               $response = $request->getBody();
            

               return redirect()->back()->with('flash_message','SMS SENT SUCCESSFULLY');


    }
}
