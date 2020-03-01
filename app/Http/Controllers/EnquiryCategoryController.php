<?php

namespace App\Http\Controllers;

use App\EnquiryCategory;
use Illuminate\Http\Request;

class EnquiryCategoryController extends Controller
{
    protected $enquiry_category=null;


    public function __construct(EnquiryCategory $enquiry_category)
    {
       $this->enquiry_category=$enquiry_category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=$this->enquiry_category->orderBy('id','DESC')->get();
        return view('admin.enquiry.category.view')->with('categories',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.enquiry.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=$this->enquiry_category->getValidationRules();
        $request->validate($rules);
       
        $data = $request->all();
        // $category = new EnquiryCategory;
        // $category->cat_name = $data['cat_name'];
        // $category->slug = str_slug($data['cat_name']);

        // $category->save();
        if(isset($request->status)){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $data['slug']=str_slug($data['cat_name']);
        $this->enquiry_category->fill($data);
        $success=$this->enquiry_category->save();
        if($success){
            return redirect()->route('category.index')->with('flash_message', 'New Category Has Been Added');
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
      //  dd($id);
        $data=$this->enquiry_category->find($id);
        return view('admin.enquiry.category.form')->with('data',$data);
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
       // dd($request->request);
       $rules=$this->enquiry_category->getValidationRules();
       $request->validate($rules);
       $data=$request->all();
       $this->enquiry_category=$this->enquiry_category->find($id);
       $data['slug']=str_slug($data['cat_name']);
       if(isset($request->status)){
        $data['status']=1;
    }else{
        $data['status']=0;
    }
       $this->enquiry_category->fill($data);
       $success=$this->enquiry_category->save();
       if($success){
        return redirect()->route('category.index')->with('flash_message', 'Category Has Been Updated');
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory($id)
    {
        $this->enquiry_category=$this->enquiry_category->find($id);
        $success=$this->enquiry_category->delete();
        if($success){
            return redirect()->route('category.index')->with('flash_message', 'Category Has Been Deleted');
        }
         
    }
}
