<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShippingController extends Controller
{
    public function viewDivision(){
        $divisions = ShippingDivision::all();
        return view('backend.shipping.division', compact('divisions'));
    }

    public function addDivision(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:3|max:150|unique:shipping_divisions'
        ]);

        $division = new ShippingDivision();
        $division->name = Str::title($request->name);
        $division->save();

        $alert = array('alertType'=>'success', 'alertMsg'=>'Division added successfully!');

        return redirect()->route('shipping.division.view')->with($alert);
    }

    public function deleteDivision($id){
        $division = ShippingDivision::findOrFail($id);
        $division->delete();

        $alert = array('alertType'=>'success', 'alertMsg'=>'Division deleted successfully!');

        return back()->with($alert);
    }
}
