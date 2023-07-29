@extends('layouts.master')

@section('page_title')
My ad
@endsection

@section('metas')
<meta name="description" value="Start selling with Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Start selling with Electric Autos" />
<meta name="og:title" value="Start selling with Electric Autos" />
<meta name="twitter:description" value="Start selling with Electric Autos" />
<meta name="twitter:title" value="Start selling with Electric Autos" />
@endsection

@section('title')
My ad
@endsection

@section('content')

<section class="section-pad">

	<div class="container mx-auto">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<ul class="breadcrumb">
					<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="active">Ad</li>
				</ul>

				<h2 class="addon-header">Be as accurate as you can to help sell your car</h2>

				<form class="form form-horizontal" method="GET" action="{{ route('ad.create.details') }}">

					@include('partials.errors')

					<div class="form-group">

						<label for="reg" class="col-sm-3 control-label">Car registration</label>
						<div class="col-sm-6">
							<input type="text" name="reg" id="reg" class="form-control" required="required" value="{{ old('reg') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="mileage" class="col-sm-3 control-label">Mileage</label>
						<div class="col-sm-6">
							<input type="text" name="mileage" id="mileage" class="form-control" required="required" value="{{ old('mileage') }}">
						</div>

					</div>

					<div class="form-group">

						<label class="col-sm-3 control-label">Distance measure</label>
						<div class="col-sm-6">
							<div class="radio">
								<label for="distance_miles" class="radio-inline">
									<input type="radio" id="distance_miles" name="distance" value="Miles"> Miles
								</label>
								<label for="distance_km" class="radio-inline">
									<input type="radio" id="distance_km" name="distance" value="KM"> Kilometers
								</label>
							</div>
						</div>

					</div>

					<div class="form-group">

						<div class="col-sm-12">

							<button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition pull-right">Next</button>

						</div>

					</div>

				</form>

			</div>

			<div class="col-md-4 col-sm-12">

				<h4>Selling tips</h4>

				<p>We ask for your car registration to help populate some of the vehicle data, we will not display the vehicle registration on the finished advert.</p>

				<p>Please be accurate with your car mileage.</p>

			</div>

		</div>

	</div>

</section>

@endsection