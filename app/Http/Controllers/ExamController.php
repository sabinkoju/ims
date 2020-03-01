<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\Result;
use App\Student;
use Illuminate\Http\Request;

class ExamController extends Controller

{
    // Adding new users
    public function addExams(Request $request){
        $exams = Exam::all();
        $course=Course::all();


        if($request->isMethod('post')){
            $data = $request->all();
            $exam = new Exam;
            $exam->exam_name=$data['exam_name'];
            $exam->course_id=$data['course_id'];
            $exam->exam_date=$data['exam_date'];
            $exam->save();
            return redirect()->route('viewAllExams')->with('flash_message', 'New Exam Has Been Scheduled');

        }

        return view ('admin.exams.add', compact('exams','course'));
    }

    // View All users
    public function viewAllExams(){
        $exams = Exam::latest()->get();
        return view ('admin.exams.view_all', compact('exams'));
    }

    // Edit & Update User
    public function editexam(Request $request, $id) {
        $exam = Exam::findOrFail($id);
        $course = Course::all();

        if ($request->isMethod('post')) {
            $data = $request->all();

            $exam->exam_name = $data['exam_name'];
            $exam->course_id = $data['course_id'];
            $exam->exam_date = $data['exam_date'];
            $exam->save();

            return redirect()->route('viewAllExams')->with('flash_message', 'New Exam Has Been Scheduled');
        }

        return view ('admin.exams.edit', compact('exam','course'));
    }


    // Delete User
    public function deleteExam($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('viewAllExams')->with('flash_message','Exam Has Been Deleted');
    }

    // View Exam Course

    public function viewCourseStudent(Request $request)
    {

        if ($request->isMethod('post')) {
            $course = Course::findOrFail($request->courseid);
            $examid = Exam::findOrFail($request->examid);
            $student_courses = $course->students()->get();

//        dd($student_courses);

            return view('admin.exams.viewCourseStudent', compact('student_courses', 'course', 'examid'));
        }
        else{
            $exams = Exam::latest()->get();
            return view ('admin.exams.view_all', compact('exams'));
        }

    }



}
