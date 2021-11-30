<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class AdminProfileController extends Controller
{

    protected function alert(){
        return array(
            'alertMsg' => 'Successfully Updated!',
            'alertType' => 'success',
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('backend.admin.profile-edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateGeneral(Request $request)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        $validated = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:admins,email,'.$admin->id,
            'phone' => 'nullable',
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;

        $admin->save();

        return redirect()->route('admin.profile.show')->with($this->alert());
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request)
    {
        $imageLocation = 'images/backend/admin/';
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);
        
        $validated = $request->validate([
            'image' => 'required|mimes:png,jpg,jpeg|min:1|max:3072',
        ],
        [
            'image.max' => 'The image size should not be larger than 3 Megabytes',
        ]);

        if($request->hasFile('image')){
            $imageFile     = $request->file('image');
            $newImageName  = rand(100000, 999999).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
        }

        $old_image = $admin->image;
        $admin->image = $imageLocation.$newImageName;

        if($admin->save()){
            if(file_exists($old_image)){
                unlink($old_image);
            }
            Image::make($imageFile)->resize(100, 100)->save($imageLocation.$newImageName);
        }

        return redirect()->route('admin.profile.show')->with($this->alert());
    }

        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        $validated = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|max:32|confirmed',
        ]);

        $curr_password = $admin->password;
        
        if(!Hash::check($request->old_password, $curr_password)){
            return back()->with('alertMsg', 'Current password was incorrect!');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.profile.show')->with($this->alert());
    }

}
