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
							<div class="progress-bar" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%;">
								Step 2
							</div>
						</div>

					</div>

				</div>

				<form class="form form-horizontal" method="GET" action="{{ route('start-selling.user-details') }}">
					{!! csrf_field() !!}

					@include('partials.errors')

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Asking price</label>
						<div class="col-sm-9  col-md-4">
							<input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="currency" class="col-sm-3 control-label">Currency</label>
						<div class="col-sm-9 col-md-4">
							<select name="currency" id="" class="form-control">
								<option value="Pound">Pounds</option>
								<option value="Euro">Euros</option>
							</select>
						</div>

					</div>

					<div class="form-group">

						<label for="name" class="col-sm-3 control-label">Ad headline</label>
						<div class="col-sm-9">
							<input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
							<p class="help-block">Something like: {{ $vars['vehicle']['title'] or '' }}</p>
						</div>

					</div>

					<div class="form-group">

						<label for="content" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<textarea name="content" id="content" rows="8" class="form-control">{{ old('content') }}</textarea>
						</div>

					</div>

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="form-group">
								<label for="make_id" class="col-sm-6 control-label">Make</label>
								<div class="col-sm-6">
									<select name="make_id" id="make_id" class="form-control">
										<option value="">All</option>
										@foreach($vars['makes'] as $make)
											@if ($vars['vehicle']['make_id'] == $make->id || $make->id == old('make_id'))
												<option selected value="{{ $make->id }}">{{ $make->name }}</option>
											@else
												<option value="{{ $make->id }}">{{ $make->name }}</option>
											@endif
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="model_id" class="col-sm-6 control-label">Model</label>
								<div class="col-sm-6">
									<select name="model_id" id="model_id" class="form-control">
										<option value="">All</option>
										@if(!empty($vars['models']))
										@foreach($vars['models'] as $item)
											@if ($vars['vehicle']['model_id'] == $item->id || $item->id == old('model_id'))
												<option selected value="{{ $item->id }}">{{ $item->name }}</option>
											@else
												<option value="{{ $item->id }}">{{ $item->name }}</option>
											@endif
										@endforeach
										@endif
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="fuel" class="col-sm-6 control-label">Fuel</label>
								<div class="col-sm-6">
									<select name="fuel" id="fuel" class="form-control">
										<option value="Electric" {{ old('fuel') == 'Electric' ? 'selected' : '' }}>Electric</option>
										<option value="Hybrid" {{ old('fuel') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-md-6 col-sm-12">

							<div class="form-group">

								<label for="gearbox" class="col-sm-6 control-label">Gearbox</label>
								<div class="col-sm-6">
									<select name="gearbox" id="gearbox" class="form-control">
										<option value="automatic" {{ old('gearbox') == 'automatic' ? 'selected' : '' }}>Automatic</option>
										<option value="manual" {{ old('gearbox') == 'manual' ? 'selected' : '' }}>Manual</option>
									</select>
								</div>

							</div>

							<div class="form-group">

								<label for="year" class="col-sm-6 control-label">Year</label>
								<div class="col-sm-6">
									<select name="year" id="year" class="form-control">
										<option value="">Year</option>
										@for ($i = date('Y'); $i > (date('Y')-10); $i--)
										@if(isset($vars['vehicle']['year']) && $vars['vehicle']['year'] == $i || $i == old('year'))
										<option value="{{ $i }}" selected>{{ $i }}</option>
										@else
										<option value="{{ $i }}">{{ $i }}</option>
										@endif
										@endfor
									</select>
								</div>

							</div>

							<div class="form-group">

								<label for="colour" class="col-sm-6 control-label">Colour</label>
								<div class="col-sm-6">
									<input type="text" name="colour" id="colour" value="{{ $vars['vehicle']['colour'] or old('colour') }}" class="form-control">
								</div>

							</div>

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

				<p>Writing a good description really helps a potential buyer choose their next car so make sure you include as much detail as possible. Too short a description might not get the attention your car deserves.</p>

				<p>Being accurate with the vehicle details helps prospective buyers find the exact car their looking for.</p>

			</div>

		</div>

	</div>

</section>

@endsection