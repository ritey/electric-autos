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

@section('title')
Electric car classifieds
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-9">

				<div class="col-sm-12 col-md-12">

					<h3>Title</h3>
					<p>Intro</p>

				</div>

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

				<p id="results" class="sc-only"></p>

				@if(count($vars['cars']))

					@foreach($vars['cars'] as $collection)

						@foreach($collection as $car)

							<div class="col-sm-6 col-md-4">

								@include('partials.card', ['car' => $car])

							</div>

						@endforeach

						<div class="col-sm-12 col-md-12 text-center">

							@include('partials.advert')

						</div>

					@endforeach

				@else

					<div class="col-sm-12">

						<h3>No cars found</h3>

					</div>

				@endif

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

			</div>

			<div class="col-sm-3">

				<h3>Dealer</h3>

			</div>

		</div>

	</div>

</section>

@endsection