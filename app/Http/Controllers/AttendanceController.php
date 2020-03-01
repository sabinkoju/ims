<?php

namespace App\Http\Controllers;

use App\Course;
use App\Role;
use App\StaffAttendance;
use App\Student;
use App\StudentAttendance;
use App\Teacher;
use App\TeacherAttendance;
use App\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function teacherAttendance(Request $request)
    {
        $teachers = Teacher::latest()->orderBy('name', 'DESC')->get();
        $roles = Role::all();



        if ($request->isMethod('post')) {
            $dateCount = TeacherAttendance::where('date', $request->date)->count();

//            dd($dateCount);
            if($dateCount > 1){
                return redirect()->back()->with('flash_error', 'Attendance Has Been Already Submitted');
            }

            $data = $request->all();
            for ($i = 0 ; $i < count($data['teacher_id']); $i++){
                $t_attendance  = new TeacherAttendance;
                $t_attendance->teacher_id = $data['teacher_id'][$i];
                $t_attendance->remarks = $data['remarks'][$i];
                $t_attendance->attendance = $data['attendance'][$i];
                $t_attendance->date = $data['date'];
                $t_attendance->save();
            }
            return redirect()->back()->with('flash_message', 'Attendance Has Been Submitted');
        }

        return view('admin.attendance.attendance', compact('roles', 'teachers'));

    }

    public function viewReport(Request $request){
        $roles = Role::where('id', '!=', 1)->get();

        $date = '';
        $role_id = '';
        $staff='';
        $teacher = '';
        $student = '';
        if($request->isMethod('post')){
            $date = $request->date;
            $role_id = $request->role_id;
            if($request->role_id == 2){
                $staff = StaffAttendance::where('date', $date)->get();
            } else if ($request->role_id == 3) {
                $teacher = TeacherAttendance::where('date', $date)->get();
            } else if ($request->role_id == 4){
                $student  = StudentAttendance::where('date', $date)->get();
            }
        }
        return view ('admin.attendance.view_attendance', compact('roles', 'staff', 'teacher', 'student'));
    }

    public function staffAttendance(Request $request){
        $users = User::where('role_id', 2)->orderBy('name', 'ASC')->get();

        $dateCount = StaffAttendance::where('date', $request->date)->count();

        if($dateCount > 1){
            return redirect()->back()->with('flash_message_alert', 'Attendance Has Been Already Submitted');
        }

        if($request->isMethod('post')){
            $data = $request->all();
            for($i = 0; $i < count($data['staff_id']); $i++){
                $s_attendance = new StaffAttendance;
                $s_attendance->user_id = $data['staff_id'][$i];
                $s_attendance->remarks = $data['remarks'][$i];
                $s_attendance->attendance = $data['attendance'][$i];
                $s_attendance->date = $data['date'];
                $s_attendance->save();
            }
            return redirect()->back()->with('flash_message', 'Attendance Has Been Submitted');

        }
        return view ('admin.attendance.staff_attendance', compact('users'));
    }


    public function studentAttendance(Request $request){
        $courses = Course::latest()->where('status', 1)->get();

        return view ('admin.attendance.student_attendance', compact('courses'));
    }

    public function courseStudent(Request $request){

       if($request->isMethod('post')){

           $course = Course::findOrFail($request->course_id);
           $students = $course->students()->get();
           $stucount = $students->count();
        //   dd($stucount);
        if($stucount==0){
            return redirect()->back()->with('flash_error', 'No Student in this Course');
        }
           return view ('admin.attendance.student', compact('students', 'course'));

       } else {
           return redirect()->route('studentAttendance');

       }
    }

    public function storeAttendanceStudent(Request $request){

        $count = StudentAttendance::where('date', $request['date'])->where('course_id', $request['course_id'])->count();
        if($count > 1){
            return redirect()->route('studentAttendance')->with('toast_error', 'Attendance Has Been Submitted');
        }


        if ($request->isMethod('post')) {
            $data = $request->all();



            for ($i = 0 ; $i < count($data['student_id']); $i++){
                $t_attendance  = new StudentAttendance();
                $t_attendance->student_id = $data['student_id'][$i];
                $t_attendance->remarks = $data['remarks'][$i];
                $t_attendance->attendance = $data['attendance'][$i];
                $t_attendance->date = $data['date'];
                $t_attendance->course_id = $data['course_id'];
                $t_attendance->save();
            }
            return redirect()->route('studentAttendance')->with('flash_message', 'Attendance Has Been Submitted');
        }
    }


    public function reportAttendance(Request $request){

    }
}
