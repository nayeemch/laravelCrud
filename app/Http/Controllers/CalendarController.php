<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Holiday;
use DB;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
         
    	// $holidays = Holiday::orderBy('holiday_name');
     //    $holiday_name = $request->input('holiday_name');
     //    // $months_name = $request->input('months_name');
     //    if (!empty($holiday_name)) {
     //        $holidays->Where('holiday_name','Like','%'.$holiday_name.'%');
     //    }
     //    $holidays=$holidays->paginate(3);


    	// // $holidays = Holiday::paginate(3);
	    // return view('layouts.app',compact('holidays'));


        $showData = DB::table('holidays')
            ->join('months', 'holidays.months_id', '=', 'months.id')
            ->select('holidays.*', 'months.months_name')
            ->get();

        

        // $showData = Holiday::orderBy('holiday_name');
        // $holiday_name = $request->input('holiday_name');
        // // $months_name = $request->input('months_name');
        // if (!empty($holiday_name)) {
        //     $showData->Where('holiday_name','Like','%'.$holiday_name.'%');
        // }
        // $showData=$showData->paginate(3);

        
        return view('layouts.app',compact('showData'));

        // return $showData;

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

    	$holiday= new Holiday;
    	$holiday->holiday_name = $request->holiday_name;
        $holiday->holiday_details = $request->holiday_details;
        $holiday->holiday_img_url = $request->holiday_img_url;
        $holiday->holiday_date = $request->holiday_date;
        $holiday->holiday_year = $request->holiday_year;
    	$holiday->months_id= $request->id;
    	$holiday->save();

    	return redirect(route('home'))->with('successMsg','Holiday Added Successfully');




    }

    public function edit($id){
    	$holiday = Holiday::find($id);
    	return view('layouts.edit' , compact('holiday'));
    }

    public function update(Request $request,$id){

    	$this->validate($request,[
    		'holiday_name'=>'required',
    		'holiday_details'=>'required'
    	]);

    	$holiday= Holiday::find($id);
    	$holiday->holiday_name = $request->holiday_name;
        $holiday->holiday_details = $request->holiday_details;
    	$holiday->months_id = $request->months_id;
    	$holiday->save();

    	return redirect(route('home'))->with('successMsg','Holiday Updated Successfully');
    }

    public function delete($id)
    {
    	Holiday::find($id)->delete();
    	return redirect(route('home'))->with('successMsg','Holiday Deleted Successfully');
    }

    public function editProfile($id)
    {
      $surnames = DB::table('families')->lists('surname'); 
      return view('editprofile', ['surnames' => $surnames]);
    }

    
}
