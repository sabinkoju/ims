<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exports\courseExport;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    // Add Course
    public function addCourse(Request $request){


        ini_set('memory_limit','256M');
        if($request->isMethod('post')){
            $request->validate([
                'name'=>'required|string',
                'duration'=>'required',
                'fees'=>'required',

            ]);
            $data = $request->all();
            $course = new Course;
            $course->name = $data['name'];
            $course->code = $course->getLatestCourseNumber();
            $course->slug = str_slug($data['name']);
            $course->fees = $data['fees'];
            $course->duration = $data['duration'];

            if(empty($data['description'])){
                $course->description = "";
            } else {
                $course->description = $data['description'];
            }

            if (empty($data['status'])){
                $course->status = 0;
            } else {
                $course->status = 1;
            }


            $random = str_random(20);
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random.'.'.$extension;
                    $image_path = 'public/uploads/course/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $course->image = $filename;
                }
            }

            $course->save();
            return redirect()->route('viewCourses')->with('flash_message', 'New Course Has Been Added');

        }
        return view ('admin.course.add');
    }

    // View Courses
    public function viewCourses(){
        // $courses = Course::with('teachers')->latest()->get();

    //    


        $user = User::findOrFail(Auth::user()->id);
        $user_email = $user->email;
        // $teacher_email=Teacher::pluck('email');
        $teacher_email = Session::get('adminSession');
        
        
        
        
        if($user_email == $teacher_email ){
            // dd('$user_email');
            $teacher_id = Teacher::with('courses')->where('email', $teacher_email)->first();
            $student_id = Student::where('email', $teacher_email)->first();
            $countS=Student::where('email', $teacher_email)->count();
            $count=Teacher::with('courses')->where('email', $teacher_email)->count();
            // dd($count);
            if($count!=0){
                $courses= $teacher_id->courses->sortBy('name');
                // dd($courses);
                return view ('admin.course.view', compact('courses','user', 'teacher_email','teacher_id'));
           }

           if($countS!=0){
               $courses=$student_id->courses->sortBy('name');
               // return view ('admin.course.view', compact('courses'));
            return view ('admin.course.view', compact('courses'));
           }
            // dd($courses);

            $courses = Course::with('teachers')->latest()->get();
            
            // return view ('admin.course.view', compact('courses'));
            return view ('admin.course.view', compact('courses'));

        }

        

        return view ('admin.course.view', compact('courses'));
    }

    // Edit Course
    public function editCourse(Request $request, $id){
        ini_set('memory_limit','256M');
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
         


        $course = Course::findOrFail($id);
        if($request->isMethod('post')){
            $request->validate([
                'name'=>'required|string',
                'duration'=>'required',
                'fees'=>'required',
            ]);
            $data = $request->all();
            $course->name = $data['name'];
            $course->code = $course->getLatestCourseNumber();
            $course->slug = str_slug($data['name']);
            $course->fees = $data['fees'];
            $course->duration = $data['duration'];

            if(empty($data['description'])){
                $course->description = "";
            } else {
                $course->description = $data['description'];
            }

            if (empty($data['status'])){
                $course->status = 0;
            } else {
                $course->status = 1;
            }


            $random = str_random(20);
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random.'.'.$extension;
                    $image_path = 'public/uploads/course/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $course->image = $filename;
                }
            }

            $course->save();

            $image_path = 'public/uploads/course/';

            if (file_exists($image_path.$data['current_image'])){
                if(!empty($data['current_image'])){
                    if (file_exists($image_path.$course->image)){
                        unlink($image_path.$data['current_image']);
                    }
                }
            }

            return redirect()->route('viewCourses')->with('flash_message', 'Course Has Been Updated');

        }
        return view ('admin.course.edit', compact('course'));
    }

    // Delete Course
    public function deleteCourse($id){
        $course = Course::findOrFail($id);
        $course->delete();

        $image_path = 'public/uploads/course/';

        if(!empty($course->image)){
            if(file_exists($image_path.$course->image)){
                unlink($image_path.$course->image);
            }
        }

        return redirect()->route('viewCourses')->with('flash_message', 'Course Has Been Deleted');
    }

    // Export to Excel
    public function exportCourse(){
        return Excel::download(new courseExport, 'courses-data.xlsx');
    }


//generatePDF
     public function generatePDF() {
        $data['courses'] = Course::all();

        $pdf = PDF::loadView('admin.course.pdf', $data);

         $pdf->save(storage_path().'_filename.pdf');

        return $pdf->download('course.pdf');
    }

    //print part
    public function printCourse(){
        $data['courses']=Course::all();
         return view('admin.course.print',$data);
    }
}


