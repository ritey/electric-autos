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
<meta name="twitter:creator" value="@electricautosuk" />
@endsection

@section('title')
Start selling your car
@endsection

@section('content')

<section class="section-pad">

	<div class="container mx-auto">

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

	<div class="container mx-auto">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<h4>Sell my car in 3 simple steps</h4>

				<div class="row">

					<div class="col-sm-12">

						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width: 99%;">
								Step 3
							</div>
						</div>

					</div>

				</div>

				<form class="form form-horizontal" method="post" action="{{ route('start-selling.complete') }}">
					{!! csrf_field() !!}

					@include('partials.errors')

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Asking price</label>
						<div class="col-sm-9">
							<input type="text" name="price" id="price" class="form-control">
						</div>

					</div>

					<div class="form-group">

						<label for="currency" class="col-sm-3 control-label">Currency</label>
						<div class="col-sm-9">
							<select name="currency" id="" class="form-control">
								<option value="Pound">Pounds</option>
								<option value="Euro">Euros</option>
							</select>
						</div>

					</div>

					<div class="form-group">

						<label for="name" class="col-sm-3 control-label">Ad headline</label>
						<div class="col-sm-9">
							<input type="text" name="name" id="name" class="form-control" value="">
							<p class="help-block">{{ $vars['vehicle']['title'] }}</p>
						</div>

					</div>

					<div class="form-group">

						<label for="content" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<textarea name="content" id="content" rows="8" class="form-control"></textarea>
						</div>

					</div>

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="form-group">

								<label for="gearbox" class="col-sm-6 control-label">Gearbox</label>
								<div class="col-sm-6">
									<select name="gearbox" id="gearbox" class="form-control">
										<option value="automatic">Automatic</option>
										<option value="manual">Manual</option>
									</select>
								</div>

							</div>

							<div class="form-group">

								<label for="year" class="col-sm-6 control-label">Year</label>
								<div class="col-sm-6">
									<select name="year" id="year" class="form-control">
										<option value="">Year (from)</option>
										@for ($i = date('Y'); $i > (date('Y')-10); $i--)
										@if(isset($vars['vehicle']['year']) && $vars['vehicle']['year'] == $i)
										<option value="{{ $i }}" selected>{{ $i }}</option>
										@else
										<option value="{{ $i }}">{{ $i }}</option>
										@endif
										@endfor
									</select>
								</div>

							</div>

						</div>

						<div class="col-md-6 col-sm-12">

							<div class="form-group">

								<label for="colour" class="col-sm-6 control-label">Colour</label>
								<div class="col-sm-6">
									<input type="text" name="colour" id="colour" value="{{ $vars['vehicle']['colour'] or '' }}" class="form-control">
								</div>

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

				<p>Be accurate with your car mileage.</p>

			</div>

		</div>

	</div>

</section>

@endsection