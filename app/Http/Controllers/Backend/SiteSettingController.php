<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    
    public function index()
    {
        $settings = SiteSetting::first();

        return view('backend.admin.site-settings', compact('settings'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|min:3|max:20',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|min:3|max:200',
            'logo' => 'nullable|min:1|max:512|mimes:png,jpg,jpeg',
            'tab_icon' => 'nullable|min:1|max:128|mimes:png',
        ]);

        $settings = SiteSetting::firstOrFail();

        $settings->name = $request->name;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->address = $request->address;

        $location  = 'images/logo-icon/';

        if($request->hasFile('logo')){
            if(file_exists($settings->logo)){
                unlink($settings->logo);
            }
            $imageFile = $request->file('logo');
            $imageName = 'logo.'.$imageFile->getClientOriginalExtension();
            Image::make($imageFile)->resize(140, 36)->save($location.$imageName);
            $settings->logo = $location.$imageName;
        }

        if($request->hasFile('tab_icon')){
            if(file_exists($settings->tab_icon)){
                unlink($settings->tab_icon);
            }
            $imageFile = $request->file('tab_icon');
            $imageName = 'tab_icon.'.$imageFile->getClientOriginalExtension();
            Image::make($imageFile)->resize(36, 36)->save($location.$imageName);
            $settings->tab_icon = $location.$imageName;
        }

        $settings->save();

        $alert = ['alertMsg'=>'Settings updated!', 'alertType'=>'success'];

        return back()->with($alert);

    }

}
