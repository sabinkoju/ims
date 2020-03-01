<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Student;
use App\Teacher;
use App\Course;
use App\Batch;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard(){
        $students = Student::all();
        $teachers = Teacher::all();
        $courses = Course::all();
        $batch = Batch::all();
        return view ('admin.dashboard', compact('students','teachers','courses','batch'));
    }

    // Profile
    public function profile(){
        $user = Auth::user();
        return view ('admin.profile', compact('user'));
    }

    // Update profile
    public function updateProfile(Request $request, $id){
         ini_set('memory_limit','256M');
        $data = $request->all();
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->address = $data['address'];
        $user->phone = $data['phone'];


        $random = str_random(20);
        if($request->hasFile('image')){
            $image_tmp = Input::file('image');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random.'.'.$extension;
                $image_path = 'public/uploads/profile/'. $filename;
                // Resize Image Code
                Image::make($image_tmp)->save($image_path);
                // Store image name in products table
                $user->image = $filename;
            }
        }
        $user->save();

        $email = strtolower($data['email']);
        $messageData = [
            'email' => strtolower($data['email']),
            'name' => $data['name'],
            'address' => $data['address'],
            'phone' => $data['phone']
        ];
        Mail::send('emails.update_profile', $messageData, function ($message) use ($email){
             $message->to($email)->subject('IMS Sysyem Profile Update');
        });


        $image_path = 'public/uploads/profile/';
        if (file_exists($image_path.$data['current_image'])){
        if(!empty($data['image'])){
            if (file_exists($image_path.$user->image)){
                unlink($image_path.$data['current_image']);
            }
        }
        }


        return redirect()->back()->with('flash_message', 'Your Profile Has Been Successfully Updated');
    }


    // Change Password
    public function changePassword(){
        return view ('admin.change_password');
    }

    // Checking User Current Password
    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_password'];
        $user_id = Auth::guard('web')->user()->id;
        $check_password = User::where('id', $user_id)->first();
        if (Hash::check($current_password, $check_password->password)){
            return "true"; die;
        }else{
            return "false"; die;
        }
    }

    // Update Password
    public function updatePassword(Request $request, $id){
        $data = $request->all();
        $old_password = User::where('id', auth()->id())->first();
        $current_password = $data['current_password'];
        if(Hash::check($current_password, $old_password->password)){
            $new_pwd = bcrypt($data['pass_confirmation']);

            User::where('id', Auth::user()->id)->update(['password' => $new_pwd]);


            $email = auth()->user()->email;
            $messageData = [
                'email' => $email,
                'name' => auth()->user()->name,
                'updated_password' => $data['pass_confirmation'],
            ];
            Mail::send('emails.update_pass', $messageData, function ($message) use ($email){
                $message->to($email)->subject('IMS System Password Update');
            });

            return redirect()->back()->with('flash_message', 'Password Has Been Updated Successfully');


        } else {
            return redirect()->back()->with('flash_error', 'Old Password does not match with our database');
        }
    }

}
