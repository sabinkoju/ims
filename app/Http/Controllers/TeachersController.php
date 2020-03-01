<?php

namespace App\Http\Controllers;


use App\Course;
use App\Teacher;
use App\Student;
use App\Batch;
use Illuminate\Support\Facades\Session;
use App\User;
use App\TeacherCategory;
use Hamcrest\Core\HasToString;
use PDF;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;



class TeachersController extends Controller {
    // Adding new Teacher
    public function addTeacher(Request $request) {
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
 ini_set('memory_limit','256M');



        $courses=Course::latest()->get();
        $batches=Batch::latest()->get();
        $category=TeacherCategory::latest()->get();

        if ($request->isMethod('post')) {
            
            
              
            $data = $request->all();
            
            

            
        
           
           
           
            
            $request->validate([
                'name'=>'required|string|max:50',
                'email'=>'required|unique:teachers',
                'address'=>'required',
                'phone'=>'required',
            ]);
            // dd($request->email);
            
            
          
           
            
          

            $teacher = new Teacher;
            $teacher->name = $data['name'];
            $teacher->email = strtolower($data['email']);
            $teacher->address = $data['address'];
            $teacher->phone = $data['phone'];

            $teacher->teacher_category_id=$data['category'];
            $teacher->timing=$data['timing'];

            $teacher->password = Hash::make('password@123');

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
                    $teacher->image = $filename;
                }
            }
            if(isset($data['usercheck'])){
                
                 $ucount=User::where('email',$data['email'])->count();
                
                if($ucount>0){ return redirect()->back()->with('flash_error','User already exist in database');}

                $teacher->ifuser="1";
                $user = new User;
                $user->name = $data['name'];

                $user->email = strtolower($data['email']);
                $user->address = $data['address'];
                $user->phone = $data['phone'];
                $user->role_id = 3;
                $user->password = Hash::make('password@123');
                if(!empty($userfilename)) {
                    $user->image = $filename;
                };
                $user->save();
            }
            else{
                $teacher->ifuser="0";
                $tchrreml=$teacher->email;
                $user = User::where('email',$tchrreml);
                $user->forcedelete();
            }
            $teacher->save();

            $course_id=$data['course_id'];
            $batch_id=$data['batch_id'];
            $teacher->courses()->attach($course_id);
            $teacher->batches()->attach($batch_id);


            $email = strtolower($data['email']);
            $messageData = [
                'email' => strtolower($data['email']),
                'name' => $data['name'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'password' => 'password@123'
            ];
            Mail::send('emails.account_created', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Welcome to Institute Management System');
            });

            return redirect()->route('viewAllTeachers')->with('flash_message', 'New Teacher Has Been Added');

        }
        return view('admin.teachers.add',compact('courses','category','batches'));



    }

    public  function viewAllTeachers(){

        $teachers  =Teacher::latest()->get();
        $user = User::findOrFail(Auth::user()->id);
        $user_email = $user->email;
        $student_email = Session::get('adminSession');

        if($user_email == $student_email ){

        $student_id = Student::where('email', $student_email)->first();
        $count=Student::where('email', $student_email)->count();
        if($count!=0){
        $batch_id=$student_id->batch_id;


    $dataTeacher = DB::table('teacher_batch')->select('teacher_id')->where('batch_id', $batch_id)->get();
    $test = $dataTeacher;
    $dcount=$test->count();

// dd($test);
return view('admin.teachers.view',compact('test','teachers')); 
  

}
        }

// dd($teacher);
return view('admin.teachers.view',compact('teachers'));          
// return($test[0]->teacher_id);
            
    
        }

        // return view('admin.teachers.view',compact('teachers'));

    public  function trashTeacher($id){

        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $teachers=Teacher::findOrfail($id);

        $studentmail=$teachers->email;
        $useremail=User::where('email',$studentmail)->first();
         $useremail=User::where('email',$studentmail)->first();
         $usercount=User::where('email',$studentmail)->count();
        $teachers->delete();
        if (($usercount)>0) {
            $useremail->forceDelete();
        }
        
        return redirect()->route('viewAllTeachers')->with('flash_message', 'Teacher Has Been Deactivated');

    }

    public  function viewTrashedTeacher(){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }

        $teachers=Teacher::onlyTrashed()->latest()->get();
        return view('admin.teachers.viewTrashedTeacher',compact('teachers'));

    }

    // Restore Teacher
    public function restoreTeacher($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $teachers = Teacher::onlyTrashed()->where('id', $id)->first();
        $teachers->restore();
        return redirect()->route('viewAllTeachers')->with('flash_message', 'Teacher Has Been Restored');
    }

    // Delete Teacher
    public function deleteTeacher($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $teachers = Teacher::onlyTrashed()->where('id', $id)->first();

        $teachers->forceDelete();
        $image_path = 'uploads/profile/';

        if(!empty($teachers->image)){
            if(file_exists($image_path.$teachers->image)){
                unlink($image_path.$teachers->image);
            }
        }


        return redirect()->back()->with('flash_message', 'Teacher Has Been Deleted');
    }

    // Edit & Update Teacher
    public function editTeacher(Request $request, $id){

        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
         ini_set('memory_limit','256M');

        $category=TeacherCategory::latest()->get();
        $batches=Batch::latest()->get();
        $courses=Course::latest()->get();
        $teachers = Teacher::findOrFail($id);
        $course_teacher = $teachers->courses()->pluck('course_id')->toArray();
        $teacher_batch = $teachers->batches()->pluck('batch_id')->toArray();

        if($request->isMethod('post')){

            $request->validate([
                'name'=>'required|string|max:50',
                'email'=>'required',
                'address'=>'required',
                'phone'=>'required',
            ]);
            $data = $request->all();

            $teachers->name = $data['name'];

            $teachermail=strtolower($data['email']);

            $teachers->email = $data['email'];
            $teachers->address = $data['address'];
            $teachers->phone = $data['phone'];

            $teachers->teacher_category_id=$data['category'];
            $teachers->timing=$data['timing'];

            $random = str_random(20);
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random.'.'.$extension;
                    $image_path = 'uploads/profile/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $teachers->image = $filename;
                }
            }



            if(isset($data['usercheck'])){


                $teachers->ifuser="1";
                $userlist=User::where('email',$teachermail)->count();

                if($userlist<1) {

                    $user = new User;
                    $user->name = $data['name'];
                    $user->email = strtolower($data['email']);
                    $user->address = $data['address'];
                    $user->phone = $data['phone'];
                    $user->role_id = 3;
                    $user->password = Hash::make('password@123');
                    if(!empty($userfilename)) {
                        $user->image = $filename;
                    };

                    $user->save();
                }
                else{
                    $useredit=User::where('email',$teachermail)->first();
                    $useredit->name = $data['name'];
                    $useredit->email = strtolower($data['email']);
                    $useredit->address = $data['address'];
                    $useredit->phone = $data['phone'];

                    if(!empty($userfilename)) {
                        $useredit->image = $filename;
                    };
                    $useredit->save();

                }
            }
            else{
                $teachers->ifuser="0";
            }
            $teachers->save();

            $course_id=$data['course_id'];
            $batch_id=$data['batch_id'];
            $teachers->courses()->sync($course_id);
            $teachers->batches()->sync($batch_id);


            $image_path = 'uploads/profile/';

            if (file_exists($image_path.$data['current_image'])){

                if(!empty($data['current_image'])){
                    if (file_exists($image_path.$teachers->image)){
                        unlink($image_path.$data['current_image']);
                    }
                }
            }

            return redirect()->route('viewAllTeachers')->with('flash_message', 'Teachers Details Has Been Updated');
        }

        return view ('admin.teachers.edit', compact('teachers','courses','course_teacher','category','batches','teacher_batch'));
    }


    //generatePDF
     public function generatePDF() {
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $data['teachers'] = Teacher::all();

        $pdf = PDF::loadView('admin.teachers.pdf', $data);

         $pdf->save(storage_path().'_filename.pdf');

        return $pdf->download('teachers.pdf');
    }


    public function profile($id){

        $teachers = Teacher::findOrFail($id);
        $batch=$teachers->batches;
        $course_teacher= $teachers->courses->sortBy('name')->pluck('id');
        // dd($course_teacher);
        return view('admin.teachers.profile',compact('teachers','course_teacher','batch'));
    }

    public function myprofile(){
        if(\Gate::denies('teacher')){
            abort(403, 'Access Denied');
        }
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);
        $teacher_email = Session::get('adminSession');
        // dd($teacher_email);
        $user_email = $user->email;
        // dd($user_email);
        if($user_email == $teacher_email ){
            $teacher_id = Teacher::where('email', $teacher_email)->first();
            // dd($teacher_id->id);
            
            // dd($te_id);
           $teachers=Teacher::findorFail($teacher_id->id);
           $batch=$teachers->batches;
        //    dd($batch->shifts);
            
        
        //    dd($teachers);
           $course_teacher= $teachers->courses->sortBy('name')->pluck('id');

           return view('admin.teachers.profile',compact('teachers','course_teacher','batch'));
        }

    }

    //print User
    public function printTeacher(){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $data['teachers']=Teacher::all();
       return view('admin.teachers.print',$data);
    }

}

