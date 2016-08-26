@extends('layouts.master')

@section('page_title')
Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars
@endsection

@section('metas')
<meta name="description" value="" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="" />
<meta name="og:title" value="" />
<meta name="twitter:description" value="" />
<meta name="twitter:title" value="" />
@endsection

@section('content')

@include('partials.section-title', ['title' => 'Electric car classifieds'])

<section class="">

<div class="container">

	<div class="row">

		<div class="col-sm-4">

			<h3>Filters</h3>

			@include('partials.search-form')

		</div>

		<div class="col-sm-8">

			<div class="col-sm-12 col-md-12">

				<h3>{{ count($vars['cars']) }} Used electric cars</h3>

			</div>

			@foreach($vars['cars'] as $car)

				<div class="col-sm-6 col-md-4">

					@include('partials.card', ['car' => $car])

				</div>

			@endforeach

			<div class="col-sm-12 col-md-12">

			</div>

		</div>

	</div>

</div>

</section>

@endsection