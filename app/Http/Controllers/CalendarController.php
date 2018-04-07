<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Calendar;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
         
    	$holidays = Calendar::orderBy('holiday_name');
        $holiday_name = $request->input('holiday_name');
        if (!empty($holiday_name)) {
            $holidays->Where('holiday_name','Like','%'.$holiday_name.'%');
        }
        $holidays=$holidays->paginate(3);


    	// $holidays = Calendar::paginate(3);
	    return view('layouts.app',compact('holidays'));
    }
    public function create(){
    	return view('layouts.create');
    }
    public function store(Request $request)
    {
    	// return $request->all();
    	$this->validate($request,[
    		'holiday_name'=>'required',
    		'holiday_details'=>'required'
    	]);

    	$holiday= new Calendar;
    	$holiday->holiday_name = $request->holiday_name;
    	$holiday->holiday_details = $request->holiday_details;
    	$holiday->save();

    	return redirect(route('home'))->with('successMsg','Holiday Added Successfully');
    }

    public function edit($id){
    	$holiday = Calendar::find($id);
    	return view('layouts.edit' , compact('holiday'));
    }

    public function update(Request $request,$id){

    	$this->validate($request,[
    		'holiday_name'=>'required',
    		'holiday_details'=>'required'
    	]);

    	$holiday= Calendar::find($id);
    	$holiday->holiday_name = $request->holiday_name;
    	$holiday->holiday_details = $request->holiday_details;
    	$holiday->save();

    	return redirect(route('home'))->with('successMsg','Holiday Updated Successfully');
    }

    public function delete($id)
    {
    	Calendar::find($id)->delete();
    	return redirect(route('home'))->with('successMsg','Holiday Deleted Successfully');
    }

    
}
