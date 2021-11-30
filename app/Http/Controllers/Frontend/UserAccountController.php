<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserAccountController extends Controller
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
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        return view('frontend.user.account', compact('user'));
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
    public function editProfile()
    {
        $user = User::findOrFail(Auth::guard('web')->user()->id);
        return view('frontend.user.edit-profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('frontend.user.edit-password');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request)
    {
        $imageLocation = 'images/frontend/user/';
        $user = User::findOrFail(Auth::guard('web')->user()->id);

        $validated = $request->validate([
            'image' => 'required|min:1|max:3072|mimes:png,jpg,jpeg',
        ],
        [
            'image.max' => 'The image size should not be larger than 3 Megabytes',
        ]);

        if($request->hasFile('image')){
            $imageFile     = $request->file('image');
            $newImageName  = rand(100000, 999999).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
        }

        $old_image   = $user->image;
        $user->image = $imageLocation.$newImageName;

        if($user->save()){
            if(file_exists($old_image)){
                unlink($old_image);
            }
            Image::make($imageFile)->resize(100, 100)->save($imageLocation.$newImageName);
        }

        return redirect()->route('account.show')->with($this->alert());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateInformation(Request $request)
    {
        $user = User::findOrFail(Auth::guard('web')->user()->id);

        $validated = $request->validate([
            'name' => 'required|min:3|max:150',
            'email' => 'email|unique:users,email,'.$user->id,
            'phone' => 'nullable|unique:users,phone,'.$user->id,
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        $user->save();

        return redirect()->route('account.show')->with($this->alert());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::guard('web')->user()->id);

        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|max:32|confirmed',
        ]);

        $curr_pass = $user->password;
        if(!Hash::check($request->current_password, $curr_pass)){
            return back()->with('alertMsg', 'Your current password was incorrect!');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('account.show')->with($this->alert());
    }
    
}
