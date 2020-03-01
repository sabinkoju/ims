<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    // Adding new users
    public function addUser(Request $request){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $roles = Role::all();






        if($request->isMethod('post')){

            $emailCount = User::where('email', $request->email)->count();

            if($emailCount >= 1){
                return redirect()->back()->with('toast_error', 'Email Has Been Already Taken Solti');
            }


            $request->validate([
                'name'=>'required|string|max:50',
                'email'=>'required|unique:users',
                'address'=>'required',
                'phone'=>'required|Integer',
            ]);

            $data = $request->all();
            $user = new User;
            $user->name = $data['name'];
            $user->email = strtolower($data['email']);
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->role_id = $data['role_id'];
            $user->password = Hash::make('password@123');

            $random = str_random(20);
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random.'.'.$extension;
                    $image_path = 'uploads/profile/'. $filename;
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
                'phone' => $data['phone'],
                'password' => 'password@123'
            ];
            Mail::send('emails.account_created', $messageData, function ($message) use ($email){
                $message->to($email)->subject('Welcome to Institute Management System');
            });

            return redirect()->route('viewAllUsers')->with('flash_message', 'New User Has Been Added');

        }

        return view ('admin.users.add', compact('roles'));
    }

    // View All users
    public function viewAllUsers(){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }

        
        $users = User::latest()->get();
        return view ('admin.users.view_all', compact('users'));
    }

    // Edit & Update User
    public function editUser(Request $request, $id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $user = User::findOrFail($id);
        $roles = Role::all();

        if($request->isMethod('post')){
            $request->validate([
                'name'=>'required|string|max:50',
                'email'=>'required',
                'address'=>'required',
                'phone'=>'required|Integer',
            ]);
            $data = $request->all();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            $user->role_id = $data['role_id'];

            $random = str_random(20);
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = $random.'.'.$extension;
                    $image_path = 'uploads/profile/'. $filename;
                    // Resize Image Code
                    Image::make($image_tmp)->save($image_path);
                    // Store image name in products table
                    $user->image = $filename;
                }
            }

            $user->save();


            $image_path = 'uploads/profile/';
            
                if(!empty($data['current_image'])){
                    if (file_exists($image_path.$user->image)){
                       
                        
                        unlink($image_path.$data['current_image']);
                        

                    }
                }
            

            return redirect()->route('viewAllUsers')->with('flash_message', 'User Has Been Updated');
        }

        return view ('admin.users.edit', compact('user', 'roles'));
    }


    // Trash user
    public function trashUser($id){
        if(\Gate::denies('admin_staff')){
            abort(403, 'Access Denied');
        }
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('viewAllUsers')->with('flash_message', 'User Has Been Deactivated');
    }


    // View Trashed Users
    public function viewTrashedUser(){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        
        $users = User::onlyTrashed()->latest()->get();
        return view ('admin.users.trashed', compact('users'));
    }

    // Restore User
    public function restoreUser($id){
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();
        return redirect()->route('viewAllUsers')->with('flash_message', 'User Has Been Restored');
    }

    // Delete User
    public function deleteUser($id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $user = User::onlyTrashed()->where('id', $id)->first();

        $user->forceDelete();
        $image_path = 'uploads/profile/';

        if(!empty($user->image)){
            if(file_exists($image_path.$user->image)){
                unlink($image_path.$user->image);
            }
        }


        return redirect()->back()->with('flash_message', 'User Has Been Deleted');
    }


    // Checking Users Email
    public function checkUserEmail(Request $request){
        if ($request->ajax()){
             $data = $request->all();
             $emailCount = User::where('email', $data['email'])->count();
             if($emailCount > 0){
                 echo "exists";
             }
        }
    }

        //generatePDF
        public function generatePDF() {
            if(\Gate::denies('admin_staff')){
                abort(403, 'Access Denied');
            }
            $data['users'] = User::all();

            $pdf = PDF::loadView('admin.users.pdf', $data);

            $pdf->save(storage_path().'_filename.pdf');

            return $pdf->download('users.pdf');
        }


        //print User
        public function printUser(){
            $data['$users']=User::all();
            return view('admin.users.print',$data);    }
}
