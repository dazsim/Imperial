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

		SELECT cars.id, cars.number_plate, makes.make, models.model, cars.mileage FROM CARS 
		JOIN carfeatures ON cars.id=carfeatures.carID
        INNER JOIN makes on cars.make=makes.id
		INNER JOIN models on cars.model=models.id
		WHERE
		(carfeatures.featureID=1) OR (carfeatures.featureID=2)  AND (makes.make="BMW")
		GROUP BY (cars.id)                       
		HAVING COUNT(carfeatures.featureID)=2 
		ORDER BY cars.mileage
		*/
		$SQL_Select = "SELECT cars.id, cars.number_plate, makes.make, models.model, cars.mileage FROM CARS ";
		$SQL_Joins = "
		JOIN carfeatures ON cars.id=carfeatures.carID
        INNER JOIN makes on cars.make=makes.id
		INNER JOIN models on cars.model=models.id 
		";
		$SQL_Where = "";
		$SQL_Group = "GROUP BY (cars.id)
		";
		$SQL_Having = "";
		$SQL_Order = "";


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
        		//This could be abused.
        		$SQL_Where = " WHERE cars.make='".$formMake."'";//This only filters the results if there has been a form selection
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
			
			
			
			
			if (sizeof($featureList)>0)
			{
				if ($SQL_Where=="")
				{
					$SQL_Where = "WHERE ";
				}
				else 
				{
					$SQL_Where .=" AND ";
				}
				
				$count =0;
				foreach ($featureList as $featureElement)
				{
					if ($count>0)
					{
						$SQL_Where .= " OR ";
					}
					$SQL_Where .= "(carfeatures.featureID=".$featureElement.")";
					$count++;
				}

			}	
			
			
			if (sizeof($featureList)>0)
			{
				$SQL_Having .= " HAVING COUNT(carfeatures.featureID)=".sizeof($featureList);
			}
			
			
			
        	if ($formSort!="none")
        	{
        		switch($formSort)
        		{
        			case "make":
        				$SQL_Order .= " ORDER BY makes.make";
        				break;
        			case "model":
        				$SQL_Order .= " ORDER BY models.model";
        				break;
        			case "mileage":
        				$SQL_Order .= " ORDER BY cars.mileage ASC";
        				break;
        		}


        	}

        }


		
		$query = $SQL_Select.$SQL_Joins.$SQL_Where.$SQL_Group.$SQL_Having.$SQL_Order;
		$cars = \DB::select($query);
		
		//print_r($query);
		
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
