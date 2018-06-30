<!== This should be the template for the results for the database query -->


@extends('layouts.app')

@section('title', 'Question 2')

@section('content')
	<p>Results</p>
	<div class="grid">
		<div class="col100">Make</div><div class="col100">Model</div><div class="col100">Reg</div><div class="col100">Mileage</div>
	</div>
	<div class="clear"></div>
	@foreach ($cars as $car)
		<div class="grid">
			
				<div class="col100">
				{{ $car->make }}		
				</div>
				<div class="col100">
				{{ $car->model }}		
				</div>
				<div class="col100">
				{{ $car->number_plate }}		
				</div>
				<div class="col100">
				{{ $car->mileage }}		
				</div>
			
		</div>
		<div class="clear"></div>
	@endforeach
	<div class="clear"></div>
@endsection