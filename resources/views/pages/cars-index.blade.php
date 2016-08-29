@extends('layouts.master')

@section('page_title')
Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars
@endsection

@section('metas')
<meta name="description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="og:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
<meta name="twitter:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="twitter:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
@endsection

@section('content')

@include('partials.section-title', ['title' => 'Electric car classifieds'])

<section class="">

<div class="container">

	<div class="row">

		<div class="col-sm-3">

			<h3>Filters</h3>

			@include('partials.search-form')

		</div>

		<div class="col-sm-9">

			<div class="col-sm-12 col-md-12">

				<h3>{{ count($vars['cars']) }} Used electric cars</h3>

			</div>

			@foreach($vars['cars'] as $car)

				<div class="col-sm-6 col-md-4">

					@include('partials.card', ['car' => $car])

				</div>

			@endforeach

			<div class="col-sm-12 col-md-12 text-center">

				@include('partials.advert')

			</div>

			@foreach($vars['cars'] as $car)

				<div class="col-sm-6 col-md-4">

					@include('partials.card', ['car' => $car])

				</div>

			@endforeach

			<div class="col-sm-12 col-md-12">

			</div>

			<div class="col-sm-12 col-md-12 text-center">

				@include('partials.advert')

			</div>

		</div>

	</div>

</div>

</section>

@endsection