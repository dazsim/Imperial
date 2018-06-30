<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
	/*	
		Display results for search query on cars table.
	*/

	public function show_all()
	{
		//This will query the database for our cars
		//$cars = DB::connection('mysql')->select("select * from cars");
		$cars = \DB::select('SELECT * FROM `cars` INNER JOIN makes on cars.make=makes.id INNER JOIN models on cars.model=models.id');
		return view('results',['cars'=>$cars]);
	}
}