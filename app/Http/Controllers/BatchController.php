<?php
namespace App\Http\Controllers;

use App\Batch;
use App\Shift;
use App\Course;
use App\Section;

use Illuminate\Http\Request;

class BatchController extends Controller
{
    //Add Batch
    public function addBatch(Request $request)
    {
        $courses = Course::where('status', 1)->orderBy('name', 'ASC')->get();
        $shifts = Shift::orderBy('shift_available', 'ASC')->get();

        $sections= Section::all();
        if ($request->isMethod('post')) {
               
            $data = $request->all();
            $batch = new Batch;
            $batch->batch_name = $data['name'];
            $batch->year = $data['year'];
            $batch->month = $data['month'];
            $batch->section = $data['section'];
            $batch->save();


            $course_id = $data['course_id'];
            $shift_id = $data['shift_id'];
            $batch->courses()->attach($course_id);
            $batch->shifts()->attach($shift_id);


            return redirect()->route('viewBatches')->with('flash_message', 'New Batch Has Been Added');

        }

        return view('admin.batch.add', compact('courses','shifts','sections'));
    }

    //View Batches

    public function viewBatches()
    {
         $batch = Batch::latest()->with('sections')->get();
        //   dd($batch);
        return view('admin.batch.view', compact('batch'));
    }

    //Delete Batches

    public function deleteBatch($id)
    {

        $batch = Batch::findOrFail($id);
        $batch->delete();
        return redirect()->route('viewBatches')->with('flash_message', ' Batch Has Been Deleted');
    }

    //Edit Batch
    public function editBatch(Request $request, $id)
    {

        $batch = Batch::findOrFail($id);


        $courses = Course::where('status',1)->orderBy('name')->get();
        $shifts = Shift::orderBy('shift_available')->get();
        $batch_course = $batch->courses()->pluck('course_id')->toArray();
        $batch_shift = $batch->shifts()->pluck('shift_id')->toArray();
         $sections= Section::all();

        if ($request->isMethod('post')) {
           
            $data = $request->all();
            $batch->batch_name = $data['name'];
            $batch->year = $data['year'];
            $batch->month = $data['month'];

            $batch->section = $data['section'];
            $batch->save();


            $course_id = $data['course_id'];
            $shift_id =$data['shift_id'];

            $batch->courses()->sync($course_id);
             $batch->shifts()->sync($shift_id);
            return redirect()->route('viewBatches')->with('flash_message', 'Batch Has Been Updated');

        }

        return view('admin.batch.edit', compact('batch', 'courses', 'batch_course','shifts' ,'batch_shift','sections'));
    }
    
     //print part
     public function printBatch(){
        $data['batch']=batch::all();
         return view('admin.batch.print',$data);
    }

}
