<?php

namespace App\Http\Controllers;

use App\EnquirySource;
use Illuminate\Http\Request;

class EnquirySourceController extends Controller
{
    protected $source=null;

    public function __construct(EnquirySource $source)
    {
        $this->source=$source;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->source->orderBy('id','DESC')->get();
        return view('admin.enquiry.source.view')->with('sources',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.enquiry.source.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=$this->source->getValidationRules();
        $request->validate($rules);
        //dd($request->request);
        $data=$request->all();
        if(isset($request->status)){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $this->source->fill($data);
        $success=$this->source->save();
        if($success){
            return redirect()->route('source.index')->with('flash_message', 'New Source Has Been Added');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=$this->source->find($id);
        return view('admin.enquiry.source.form')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=$this->source->getValidationRules();
        $request->validate($rules);
        $this->source=$this->source->find($id);
        //dd($request->request);
        $data=$request->all();
        if(isset($request->status)){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $this->source->fill($data);
        $success=$this->source->save();
        if($success){
            return redirect()->route('source.index')->with('flash_message', 'Source Has Been Updated');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->source=$this->source->find($id);
        $success=$this->source->delete();
        if($success){
            return redirect()->route('source.index')->with('flash_message', 'Source Has Been Deleted');
        }
    }
}
