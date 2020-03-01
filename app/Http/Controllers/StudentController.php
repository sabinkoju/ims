<?php

namespace App\Http\Controllers;
use App\Batch;
use App\Repositories\StudentRepository;
use App\Student;
use App\Course;
use App\Section;
use App\Teacher;
use App\User;
use App\StudentCategory;

use App\Exam;
use App\Result;
use PDF;
use App\Fee;
use App\Payment;
use App\StudentAttendance;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{

    public function viewAllStudent(){

        $student=Student::latest()->get();

        return view('admin.student.view',compact('student'));

    }

    public function addStudent(Request $request){

        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
         ini_set('memory_limit','256M');
            $courses=Course::latest()->get();
            $category=StudentCategory::latest()->get();
            $section=Section::latest()->get();
            $batch=Batch::latest()->get();

            if ($request->isMethod('post')) {
                $request->validate([
                    'fname' => 'required|string|max:50',
                    'lname' => 'required|string|max:50',
                    'gender'=>'required',
                    'email'=>'required',
                    'dob'=>'required',
                    'phone' => 'required',
                    'image' => 'mimes:jpg,png,jpeg',
                ]);

                $data = $request->all();
                // dd($data);


                $course=$data['course_id'];

                $student = new Student;
                $student->fname = $data['fname'];
                $student->lname = $data['lname'];
                $student->gender = $data['gender'];
                $student->email = strtolower($data['email']);
                $student->address = $data['address'];
                $student->phone = $data['phone'];
                $student->section_id=$data['section_id'];
                $student->dob=$data['dob'];
                $student->student_category_id=$data['student_category_id'];
                $student->batch_id=$data['batch_id'];

                $student->password = Hash::make('password@123');



                $random = str_random(20);
                if ($request->hasFile('image')) {
                    $image_tmp = Input::file('image');
                    if ($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $filename = $random . '.' . $extension;
                        $image_path = 'uploads/profile/' . $filename;
                        // Resize Image Code
                        Image::make($image_tmp)->save($image_path);
                        // Store image name in products table
                        $student->image = $filename;
                    }
                }

                $section=Section::findorFail($data['section_id']);
                    // dd($section->id);
                $studentcount=Student::where('section_id',$section->id)->count();
                    // dd($section->no_of_students);

                if($studentcount>=$section->no_of_students){
                    // echo "error";
                    return redirect()->route('viewStudent')->with('flash_error', 'Section is full');
                }


                if(isset($data['usercheck'])){

                    $student->ifuser="1";
                    $user = new User;
                    $user->name = $data['fname'] . $data['lname'];
                    $user->email = strtolower($data['email']);
                    $user->address = $data['address'];
                    $user->phone = $data['phone'];
                    $user->role_id = 4;
                    $user->password = Hash::make('password@123');
                    if(!empty($userfilename)) {
                        $user->image = $filename;
                    };

                    $user->save();

                }
                else{
                $student->ifuser="0";
                }


                    $total=0;

                foreach ($course as $value) {
                    $coursefee=Course::where('id',$value)->first();
                        $total=$total+$coursefee->fees;

                }
                $student->due=$total;
                $student->save();

                if($student->save()){
                    $fees  = new Fee;
                $fees->student_id = DB::getPdo()->lastInsertId();
                $fees->title = "Admission Fee";
                $fees->amount= $total;
                $fees->save();

                }

                $section=Section::findorFail($data['section_id']);
                    // dd($section);
                $studentcount=Student::where('section_id',$section->id)->count();
                    // dd($studentcount);

                if($studentcount>=$section->no_of_students){
                    // echo error;
                    return redirect()->route('addStudent')->with('flash_message', 'Section is full');
                }


                


                $course_id=$data['course_id'];

                // dd($section_id);
                $student->courses()->attach($course_id);


                $email = strtolower($data['email']);
                $messageData = [
                    'email' => strtolower($data['email']),
                    'name' => $data['fname']. $data['lname'],
                    'address' => $data['address'],
                    'phone' => $data['phone'],
                    'password' => 'password@123'
                ];
                Mail::send('emails.account_created', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to Institute Management System');
                });

                return redirect()->route('viewStudent')->with('flash_message', 'New Student Has Been Added');

            }
            return view('admin.student.add',compact('courses','category','batch','section'));

        }

    public  function trashStudent($id){

        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }

        $student=Student::findOrfail($id);
        $studentmail=$student->email;
        $useremail=User::where('email',$studentmail)->first();
         $usercount=User::where('email',$studentmail)->count();
        $student->delete();
        if (($usercount)>0) {
            $useremail->forceDelete();
        }
       
        return redirect()->route('viewStudent')->with('flash_message', 'Student Has Been Deactivated');

    }

    public  function viewTrashedStudent(){

        $student=Student::onlyTrashed()->latest()->get();
        return view('admin.student.view',compact('student'))->with('trashed','true');

    }

    // Restore Teacher
    public function restoreStudent($id){
        $student = Student::onlyTrashed()->where('id', $id)->first();
        $student->restore();
        return redirect()->route('viewStudent')->with('flash_message', 'Student Has Been Restored');
    }

    // Delete Teacher
    public function deleteStudent($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $student = Student::onlyTrashed()->where('id', $id)->first();

        $student->forceDelete();
        $image_path = 'uploads/profile/';

        if(!empty($student->image)){
            if(file_exists($image_path.$student->image)){
                unlink($image_path.$student->image);
            }
        }
        return redirect()->back()->with('flash_message', 'Student Has Been Deleted');
    }

    // Edit & Update Teacher
    public function editStudent(Request $request, $id){
         ini_set('memory_limit','256M');


        $student = Student::findOrFail($id);
        $section=Section::latest()->get();
        $batch=Batch::latest()->get();
        $courses=Course::latest()->get();
        $category=StudentCategory::latest()->get();
        $course_student = $student->courses()->pluck('course_id')->toArray();

        if ($request->isMethod('post')) {
            $request->validate([
                'fname' => 'required|string|max:50',
                'lname' => 'required|string|max:50',
                'gender'=>'required',
                'email'=>'required',
                'dob'=>'required',

                'phone' => 'required',
                'image' => 'mimes:jpg,png,jpeg',
            ]);

            $data = $request->all();

                if($data['section_id']!=$student->section_id){

                    $section=Section::findorFail($data['section_id']);
                    // dd($section->id);
                $studentcount=Student::where('section_id',$section->id)->count();
                    // dd($section->no_of_students);

                if($studentcount>=$section->no_of_students){
                    // echo "error";
                    return redirect()->route('viewStudent')->with('flash_error', 'Section is full');
                }

                }
            // dd($data);

            $student->fname = $data['fname'];
            $student->lname = $data['lname'];
            $student->gender = $data['gender'];
            $studentemail=strtolower($data['email']);
            $student->email =  $studentemail;
            $student->address = $data['address'];
            $student->phone = $data['phone'];
            $student->dob=$data['dob'];
            $student->student_category_id=$data['student_category_id'];
            $student->batch_id=$data['batch_id'];
            $student->section_id=$data['section_id'];

            $student->password = Hash::make('password@123');

            $random = str_random(20);

            if ($request->hasFile('image')) {
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random . '.' . $extension;

                    $image_path = 'uploads/profile/' . $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $student->image = $filename;
                }

            }


            if(isset($data['usercheck'])){


                $student->ifuser="1";
                $userlist=User::where('email',$studentemail)->count();



               if($userlist<1) {


                   $user = new User;
                   $user->name = $data['fname'] . $data['lname'];
                   $user->email = strtolower($data['email']);
                   $user->address = $data['address'];
                   $user->phone = $data['phone'];
                   $user->role_id = 4;
                   $user->password = Hash::make('password@123');

                   if(!empty($filename)) {
                       $user->image=$filename;
                   };




                   $user->save();
               }
               else{


                   $useredit=User::where('email',$studentemail)->first();
                   $useredit->name = $data['fname'] . $data['lname'];
                   $useredit->email = strtolower($data['email']);
                   $useredit->address = $data['address'];
                   $useredit->phone = $data['phone'];
                   if(!empty($filename)) {
                       $useredit->image = $filename;
                   };
                   $useredit->save();

               }
            }
            else{
                $student->ifuser="0";           
                $stdeml=$student->email;
                $user = User::where('email',$stdeml);
                $user->forcedelete();

            }

            $lastcourse=$student->courses()->get();

            $lasttotal=0;


            foreach ($lastcourse as $value) {
                $coursefee=Course::where('id',$value->id)->first();

                $lasttotal=$lasttotal+$coursefee->fees;
            }
                $student->due=$student->due-$lasttotal;

            $total=0;

            $newcourse=$data['course_id'];

            foreach ($newcourse as $value) {
                $coursefee=Course::where('id',$value)->first();
                $total=$total+$coursefee->fees;
            }
            $student->due=$total;
            
            $student->save();

            $course_id=$data['course_id'];
            $student->courses()->sync($course_id);


            $image_path = 'uploads/profile/';

            if (file_exists($image_path.$data['current_image'])){

                if(!empty($data['current_image'])){
                    if (file_exists($image_path.$student->image)){
                        unlink($image_path.$data['current_image']);
                    }
                }
            }

            return redirect()->route('viewStudent')->with('flash_message', 'Student Details Has Been Updated');
        }

        return view ('admin.student.edit', compact('courses','category','student','course_student','batch','section'));
    }



    public function generatePDF(){

         $data['student'] = Student::all();

        $pdf = PDF::loadView('admin.student.pdf', $data);

         $pdf->save(storage_path().'_filename.pdf');

        return $pdf->download('student.pdf');


    }
    public function profile($id){
        $student = Student::findOrFail($id);
        $student_course=$student->courses;
         $scount=$student_course->count();
        // dd($student_course);
        if($scount==0){
            return redirect()->back()->with('flash_error', 'This Student is not enrolled in any course');
        }
        foreach($student_course as $course){
            // dd($course->id);
        $exam =Exam::where('course_id',$course->id)->get();
        $result=Result::where('student_id',$id)->get();
        $rcount=Result::where('student_id',$id)->count();
        // dd($result[0]);
        if($student->batches != null){
    $shift=$student->batches->shifts;}
    $payment=Payment::where('student_id',$id)->get();
    $fee=Fee::where('student_id',$id)->get();
    
    $attendance=StudentAttendance::where('student_id',$id)->get();
    //    dd($attendance);
// dd($payment);
        }
//        $student_courses = $student->courses->sortBy('name')->pluck('id');
//         dd($student_courses->name);
        return view('admin.student.profile',compact('student','result','shift','payment','attendance'));
    }

    public function myprofile(){
        if(\Gate::denies('student')){
            abort(403, 'Access Denied');
        }
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);
        $student_email = Session::get('adminSession');
        // dd($teacher_email);
        $user_email = $user->email;
        // dd($user_email);
        if($user_email == $student_email ){
            $student_id = Student::where('email', $student_email)->first();
            // dd($teacher_id->id);

            // dd($te_id);
           $student=Student::findorFail($student_id->id);

           $student_course=$student->courses;

        //    dd($teachers);
           $course_student= $student->courses->sortBy('name')->pluck('id');
           foreach($student_course as $course){
            // dd($course->id);
        $exam =Exam::where('course_id',$course->id)->get();
        $result=Result::where('student_id',$student->id)->get();
        $rcount=Result::where('student_id',$student->id)->count();
        $payment=Payment::where('student_id',$student_id)->get();
        $fee=Fee::where('student_id',$student_id)->get();
        $attendance=StudentAttendance::where('student_id',$student_id)->get();  
        // dd($result[0]);
        $shift=$student->batches->shifts;

           return view('admin.student.profile',compact('student','course_student','result','shift','payment','attendance'));
        }

    }
}

        //print Student
        public function printStudent(){
            $data['students']=Student::all();
           return view('admin.student.print',$data);
        }




}

