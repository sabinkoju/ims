<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function siteSettings(){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $site = SiteSetting::first();
        return view ('admin.site.settings', compact('site'));
    }

    public function updateSiteSettings(Request $request, $id){
        if(\Gate::denies('admin')){
            abort(403, 'Access Denied');
        }
        $data = $request->all();
        $site = SiteSetting::findOrFail($id);
        $site->company_name = $data['company_name'];
        $site->tagline = $data['tagline'];
        $site->short_name = $data['short_name'];
        $site->phone = $data['phone'];
        $site->email = $data['email'];
        $site->address = $data['address'];

        $random = str_random(10);
        if($request->hasFile('logo')){
            $image_tmp = Input::file('logo');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random.'.'.$extension;
                $image_path = 'public/uploads/site/'. $filename;
                // Resize Image Code
                Image::make($image_tmp)->save($image_path);
                // Store image name in products table
                $site->logo = $filename;
            }
        }

        $random2 = "favicon".rand(999,9999999);
        if($request->hasFile('favicon')){
            $image_tmp = Input::file('favicon');
            if($image_tmp->isValid()){
                $extension = $image_tmp->getClientOriginalExtension();
                $filename = $random2.'.'.$extension;
                $image_path = 'public/uploads/site/'. $filename;
                // Resize Image Code
                Image::make($image_tmp)->save($image_path);
                // Store image name in products table
                $site->favicon = $filename;
            }
        }

        $site->save();

        $image_path = 'public/uploads/site/';

            
            if (!empty($data['current_image'])) {
                if (file_exists($image_path . $site->logo)) {
                    unlink($image_path . $data['current_image']);
                }
            
        }
        
            if(!empty($data['current_image2'])){
                if (file_exists($image_path.$site->favicon)){
                    unlink($image_path.$data['current_image2']);
                }
        
        }

        return redirect()->back()->with('flash_message', 'Site Settings Has Been Updated');

    }
    
}
