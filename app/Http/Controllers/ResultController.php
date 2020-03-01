<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\Result;
use Illuminate\Http\Request;
use DB;

class ResultController extends Controller
{
    public function changeresult(Request $request)
    {
        $examid = Result::where('exam_id', $request->examid)->count();

        if($examid > 0){

            return redirect()->route('viewAllExams')->with('toast_error', 'Result Has Been Already Submitted');
        }

        if($request->isMethod('post'))
        {
            $data=$request->all();
            if(isset($data['student_id'])){
            for ($i = 0 ; $i < count($data['student_id']); $i++){

                $result  = new Result;
                $result->student_id = $data['student_id'][$i];
                $result->exam_id = $data['examid'];
                $result->result = $data['result'][$i];
                $result->save();
            }
            }
            return redirect()->back()->with('flash_message', 'Result Has Been Submitted');

        }
        else
         {
                return redirect()->route(viewAllExams);
         }


    }

    public function viewResult(Request $request){


        if($request->isMethod('post')) {
            $course = Course::findOrFail($request->courseid);

            $result = Result::where('exam_id', $request->examid)->get();
            $examname = Exam::findOrFail($request->examid);


            return view('admin.exams.reportexam', compact('course', 'result', 'examname'));
        }
        else{
            return redirect()->route('viewAllExams');
        }
    }


    public function editresult(Request $request) {

        if ($request->isMethod('post')) {
//            dd($request);

            $result = Result::where('student_id', $request->student_id)->where('exam_id', $request->exam_id)->first();
            $result->result = $request->result;
            $result->save();
            return redirect()->route('viewResult');
        }

            return redirect()->route('viewAllExams');

        $result = Result::where('exam_id',$request->examid)->get();
//        dd($result);
        $students = $result->student()->get();

    }

}
