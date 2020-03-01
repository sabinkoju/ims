<?php

namespace App\Http\Controllers;

use App\StudentCategory;
use Illuminate\Http\Request;

class StudentCategoryController extends Controller
{
    //

//    private $StudentRepository;
//    public function __construct(StudentRepository $StudentRepository) {
//
//        $this->StudentRepository=$StudentRepository;
//    }



    public function viewStudentCategory(){

//        $Student_category=$this->StudentRepository->student_category_all();

        $Student_category=StudentCategory::latest()->get();


        return view('admin.student.category.view',compact('Student_category'));
    }

    public  function addCategory(Request $request){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
            if($request->isMethod('post')){

                $data = $request->all();

                $studentcategory=new StudentCategory;
                $studentcategory->name=$data['name'];

                if (empty($data['status'])){
                    $studentcategory->status = 0;
                } else {
                    $studentcategory->status = 1;
                }

                $studentcategory->save();

                return redirect()->route('viewStudentCategory')->with('flash_message', 'Student Category Has Been Updated');
            }

            return view ('admin.student.category.add');
        }



    public  function editStudentCategory(Request $request,$id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $std_cat=StudentCategory::findOrfail($id);

        if($request->isMethod('post')){

            $data = $request->all();
          
            $std_cat->name=$data['name'];

            if (empty($data['status'])){
                $std_cat->status = 0;
            } else {
                $std_cat->status = 1;
            }

            $std_cat->save();

            return redirect()->route('viewStudentCategory')->with('flash_message', 'Student Category Has Been Updated');
        }

        return view ('admin.student.category.edit',compact('std_cat'));
    }

    public function deleteStudentCategory($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }


        $std_cat=StudentCategory::findOrfail($id);
        $std_cat->delete();
        return redirect()->route('viewStudentCategory')->with('flash_message', 'Student Category Has Been Deleted');

    }


}
