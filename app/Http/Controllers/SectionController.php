<?php

namespace App\Http\Controllers;
use App\Section;
use App\Student;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\sectionExport;

use Illuminate\Http\Request;

class SectionController extends Controller
{
    // Add Section
    public function addSection(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $section = new Section;
            $section->section_name = $data['name'];
            $section->no_of_students=$data['no_of_students'];
            

            $section->save();
            return redirect()->route('viewSections')->with('flash_message', 'New Section Has Been Added');

        }
        return view ('admin.section.add');
    }

     // View Sections
    public function viewSections(){
        $sections = Section::latest()->get();
        return view ('admin.section.view', compact('sections'));
    }

     // Edit Section
		public function editSection(Request $request, $id){
        $section = Section::findOrFail($id);
        if($request->isMethod('post')){
            $data = $request->all();
            $section->section_name = $data['name'];
            $section->no_of_students=$data['no_of_students'];
           

           
            $section->save();

            
            

            return redirect()->route('viewSections')->with('flash_message', 'Section Has Been Updated');

        }

        return view ('admin.section.edit', compact('section'));
    }

     // Delete Section
     public function deleteSection($id){
        $section = Section::findOrFail($id);
        $section->delete();

        $image_path = 'public/uploads/section/';

      

        return redirect()->route('viewSections')->with('flash_message', 'Section Has Been Deleted');
    }
    // Export to Excel
      public function exportSection(){
        return Excel::download(new sectionExport, 'sections-data.xlsx');
    }

        public function studentView($id){
            $section=Section::findorFail($id);
                    // dd($section->id);
                $student=Student::where('section_id',$section->id)->get();

                return view ('admin.section.studentview', compact('student'));
                // dd($student);
                    // dd($section->no_of_students);
        }
   //print part
   public function printSection(){
       $data['sections']=Section::all();
        return view('admin.section.print',$data);
   }
}
