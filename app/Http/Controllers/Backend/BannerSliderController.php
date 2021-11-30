<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BannerSlider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BannerSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannerSliders = BannerSlider::orderByDesc('id')->get();
        return view('backend.banner-slider.all', compact('bannerSliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banner-slider.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'normal_title' => 'required|max:100',
            'colored_title' => 'nullable|max:50',
            'short_note' => 'nullable|max:50',
            'short_description' => 'nullable|max:250',
            'image' => 'required|mimes:jpg,jpeg,png|min:1|max:5120',
        ]);

        $bannerSlider = new BannerSlider();
        $bannerSlider->normal_title      = Str::title($request->normal_title);
        $bannerSlider->colored_title     = !is_null($request->colored_title) || !empty($request->colored_title) ? Str::title($request->colored_title) : null;
        $bannerSlider->short_note        = $request->short_note;
        $bannerSlider->short_description = $request->short_description;
        $bannerSlider->image             = null;

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageNameGen = hexdec(uniqid()).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
            $imageLocation = 'images/backend/banner-slider/';
            Image::make($imageFile)->resize(870, 370)->save($imageLocation.$imageNameGen);
            $bannerSlider->image = $imageLocation.$imageNameGen;
        }

        $bannerSlider->save();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Slider created successfully!',
        );

        return redirect()->route('banner.slider.all')->with($alert);
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
        $bannerSlider = BannerSlider::findOrFail($id);
        return view('backend.banner-slider.edit', compact('bannerSlider'));
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
        $bannerSlider = BannerSlider::findOrFail($id);

        $validated = $request->validate([
            'normal_title'      => 'required|max:100',
            'colored_title'     => 'nullable|max:50',
            'short_note'        => 'nullable|max:50',
            'short_description' => 'nullable|max:250',
            'image'             => 'nullable|mimes:jpg,jpeg,png|min:1|max:5120',
            'status'            => 'required|integer',
        ]);

        $bannerSlider->normal_title      = Str::title($request->normal_title);
        $bannerSlider->colored_title     = !is_null($request->colored_title) || !empty($request->colored_title) ? Str::title($request->colored_title) : null;
        $bannerSlider->short_note        = $request->short_note;
        $bannerSlider->short_description = $request->short_description;
        $bannerSlider->status            = $request->status; 

        if($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageNameGen = hexdec(uniqid()).'_'.date('dmYHis').'.'.$imageFile->getClientOriginalExtension();
            $imageLocation = 'images/backend/banner-slider/';
            if(file_exists($bannerSlider->image)){
                unlink($bannerSlider->image);
            }
            Image::make($imageFile)->resize(870, 370)->save($imageLocation.$imageNameGen);
            $bannerSlider->image = $imageLocation.$imageNameGen;
        }

        $bannerSlider->save();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Slider updated successfully!',
        );

        return redirect()->route('banner.slider.all')->with($alert);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bannerSlider = BannerSlider::findOrFail($id);
        if(file_exists($bannerSlider->image)){
            unlink($bannerSlider->image);
        }
        $bannerSlider->delete();

        $alert = array(
            'alertType' => 'success',
            'alertMsg'  => 'Slider deleted successfully!',
        );

        return back()->with($alert);

    }
}
