@extends('layouts.master')

@section('page_title')
Start selling with Electric Autos
@endsection

@section('metas')
<meta name="description" value="Start selling with Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Start selling with Electric Autos" />
<meta name="og:title" value="Start selling with Electric Autos" />
<meta name="twitter:description" value="Start selling with Electric Autos" />
<meta name="twitter:title" value="Start selling with Electric Autos" />
@endsection

@section('content')

@include('partials.section-title', ['title' => 'Start selling your car'])

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-md-4 col-sm-12 text-center">

				<h3><i class="fa fa-users"></i> Reach more buyers</h3>

			</div>

			<div class="col-md-4 col-sm-12 text-center">

				<h3><i class="fa fa-trophy"></i> No 1 Electric car site</h3>

			</div>

			<div class="col-md-4 col-sm-12 text-center">

				<h3><i class="fa fa-clock-o"></i> Sell your car faster</h3>

			</div>

		</div>

	</div>

</section>

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<h4>Sell my car in 3 simple steps</h4>

				<div class="row">

					<div class="col-sm-12">

						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;">
								Step 1
							</div>
						</div>

					</div>

				</div>

				<form class="form form-horizontal" method="GET" action="{{ route('start-selling.details') }}">

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

						<div class="col-sm-12">

							<button type="submit" class="btn btn-primary pull-right">Next</button>

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