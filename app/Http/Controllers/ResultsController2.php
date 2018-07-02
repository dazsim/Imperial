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
		$query = 'SELECT * FROM `cars` INNER JOIN makes on cars.make=makes.id INNER JOIN models on cars.model=models.id';
		$cars = \DB::select($query);
		$makes = \DB::select('SELECT * FROM `makes`');

		return view('results2',['cars'=>$cars,'makes'=>$makes]);
	}

	/*public function convert_features_to_sql($featureArray)
	{
		$result = "(";
		$count=0;
		foreach ($featureArray as $featureElement)
		{
			if ($count>0)
			{
				$result .=",";
			}
			$result.=$featureElement;
			$count++;
		}
		return $result;
	}*/ //Work out why this doesn't work as intended

	public function show_all_filtered(Request $request)
	{
		$QueryAppend = "";
		$formMake = $request->input('make');
		$formSort = $request->input('sort');
		

		/*

		This Function needs rewriting to make use of the follow query layout

		SELECT * FROM carfeatures
		JOIN cars ON cars.id=carfeatures.carID
		WHERE
			
		(carfeatures.featureID=1) OR (carfeatures.featureID=2)
		GROUP BY (carfeatures.carID)
		HAVING COUNT(carfeatures.featureID)=2
		*/

		$filterFeatureElectricWindows = $request->input('electricwindows');
		$filterFeatureBlueTooth = $request->input('bluetooth');
		$filterFeatureSatNav = $request->input('satnav');
		$filterFeatureSlidingSideDoor = $request->input('slidingdoor');
		$filterFeatureAllWheelDrive = $request->input('allwheeldrive');
		$whereTriggered= false; //This flag is set if any query is true.  This allows for multiple checkboxes to be ticked.
		$featureList = [];

		if ($request->isMethod('post'))
		{
        	if ($formMake!="none")
        	{
        		$QueryAppend = " WHERE cars.make='".$formMake."'";//This only filters the results if there has been a form selection
        	}
					
			if ($filterFeatureElectricWindows)
			{
				array_push($featureList,1);
			}
			if ($filterFeatureBlueTooth)
			{
				array_push($featureList,2);
				
			}
			if ($filterFeatureSatNav)
			{
				array_push($featureList,3);
			}
			if ($filterFeatureSlidingSideDoor)
			{
				array_push($featureList,5);
			}
			if ($filterFeatureAllWheelDrive)
			{
				array_push($featureList,4);
				
			}
			$result = "(";
			$count=0;
			foreach ($featureList as $featureElement)
			{
				if ($count>0)
				{
					$result .=",";
				}
				$result.=$featureElement;
				$count++;
			}
			$result.=")";
			
			if (sizeof($featureList)>0)
			{
				$QueryAppend .= " WHERE carfeatures.carID=cars.id AND features.id IN ".$result;
				
			}
			$QueryAppend .= " GROUP BY cars.id";
			if (sizeof($featureList)>0)
			{
				$QueryAppend .= ", carfeatures.id";
			}
			//$QueryAppend .= " HAVING COUNT(DISTINCT carfeatures.featureID) = ".sizeof($featureList);
			
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
		if (($filterFeatureElectricWindows!="") || ($filterFeatureSatNav!="") || ($filterFeatureBlueTooth!="") || ($filterFeatureAllWheelDrive!="") || ($filterFeatureSlidingSideDoor!=""))
		{
			$query .= ' LEFT JOIN carfeatures on cars.id=carfeatures.carID
			LEFT JOIN features on features.id=carfeatures.featureID
			';
		}
			
		$cars = \DB::select($query.$QueryAppend);
		print_r($query.$QueryAppend);
		
		//echo "\r\n";
		$makes = \DB::select('SELECT * FROM `makes`');

		$carsResult = [];
		$workingCar = false;
		foreach ($cars as $car)
		{
			if (!$workingCar)
			{
				$workingCar=$car;
			}


		}

		return view('results2',['cars'=>$cars, 'makes'=>$makes]);
	}
}
