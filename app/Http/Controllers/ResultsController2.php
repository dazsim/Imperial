<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Illuminate\Http\Result;
//use Illuminate\Http\Input;

class ResultsController2 extends Controller
{
	/*
		Display results for search query on cars table.
	*/

	public function show_all()
	{
		//This will query the database for our cars
		//$cars = DB::connection('mysql')->select("select * from cars");

		$cars = \DB::select('SELECT * FROM `cars` INNER JOIN makes on cars.make=makes.id INNER JOIN models on cars.model=models.id');
		$makes = \DB::select('SELECT * FROM `makes`');

		return view('results2',['cars'=>$cars,'makes'=>$makes]);
	}

	public function show_all_filtered(Request $request)
	{
		$QueryAppend = "";
		$formMake = $request->input('make');
		$formSort = $request->input('sort');
		$filterFeatureElectricWindows = $request->input('electricwindows');
		$filterFeatureBlueTooth = $request->input('bluetooth');
		$filterFeatureSatNav = $request->input('satnav');
		$filterFeatureSlidingSideDoor = $request->input('slidingdoor');
		$filterFeatureAllWheelDrive = $request->input('allwheeldrive');
		if ($request->isMethod('post'))
		{
        	if ($formMake!="none")
        	{
        		$QueryAppend = " WHERE cars.make='".$formMake."'";//This only filters the results if there has been a form selection
        	}
					//TODO: I will check how the logic for this actually works when I get home
					// This will almost certainly crash if i were to try running it
					// This will also need modifying so that the feature text is compared in the CarFeatures Table
					if ($filterFeatureElectricWindows)
					{
						$QueryAppend .= " WHERE features.carID=cars.id AND features.feature=`Electric Windows`";
					}
					if ($filterFeatureBlueTooth)
					{
						$QueryAppend .= " WHERE features.carID=cars.id AND features.feature=`BlueTooth`";
					}
					if ($filterFeatureSatNav)
					{
						$QueryAppend .= " WHERE features.carID=cars.id AND features.feature=`Sat Nav`";
					}
					if ($filterFeatureSlidingSideDoor)
					{
						$QueryAppend .= " WHERE features.carID=cars.id AND features.feature=`Sliding Side Door`";
					}
					if ($filterFeatureAllWheelDrive)
					{
						$QueryAppend .= " WHERE features.carID=cars.id AND features.feature=`All Wheel Drive`";
					}
        	if ($formSort!="none")
        	{
        		switch($formSort)
        		{
        			case "make":
        				$QueryAppend .= " ORDER BY makes.make";
        				break;
        			case "model":
        				$QueryAppend .= " ORDER BY models.model";
        				break;
        			case "mileage":
        				$QueryAppend .= " ORDER BY cars.mileage ASC";
        				break;
        		}


        	}

        }


		//This will query the database for our cars
		//$cars = DB::connection('mysql')->select("select * from cars");
        $query = 'SELECT * FROM `cars`
			INNER JOIN makes on cars.make=makes.id
			INNER JOIN models on cars.model=models.id';
		$cars = \DB::select($query.$QueryAppend);
		print_r($query.$QueryAppend);
		$makes = \DB::select('SELECT * FROM `makes`');



		return view('results2',['cars'=>$cars, 'makes'=>$makes]);
	}
}
