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

@section('content')

@include('partials.section-title', ['title' => 'My ad'])

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<h2>Be as accurate as you can to help sell your car</h2>

				<form class="form form-horizontal" method="POST" action="{{ route('ad.save', ['slug' => $vars['vehicle']['slug']]) }}">

					@include('partials.errors')

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Asking price</label>
						<div class="col-sm-9">
							<input type="text" name="price" id="price" class="form-control" value="{{ $vars['vehicle']['price'] }}">
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
							<input type="text" name="name" id="name" class="form-control" value="{{ $vars['vehicle']['name'] }}">
						</div>

					</div>

					<div class="form-group">

						<label for="content" class="col-sm-3 control-label">Description</label>
						<div class="col-sm-9">
							<textarea name="content" id="content" rows="8" class="form-control">{{ $vars['vehicle']['content'] }}</textarea>
						</div>

					</div>

					<div class="row">

						<div class="col-md-6 col-sm-12">

							<div class="form-group">

								<label for="gearbox" class="col-sm-6 control-label">Gearbox</label>
								<div class="col-sm-6">
									<select name="gearbox" id="gearbox" class="form-control">
										<option value="automatic" {{ $vars['vehicle']['gearbox'] == 'automatic' ? 'selected' : '' }}>Automatic</option>
										<option value="manual" {{ $vars['vehicle']['gearbox'] == 'manual' ? 'selected' : '' }}>Manual</option>
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

							<div class="form-group">

								<div class="col-sm-offset-2 col-sm-10">
							    	<div class="checkbox">
										<label for="sold">
											<input id="sold" name="sold" value="1" type="checkbox" {{ $vars['vehicle']['sold'] == '1' ? 'checked' : '' }}> Sold
										</label>
									</div>
							    </div>

							</div>

							<div class="form-group">

								<div class="col-sm-offset-2 col-sm-10">
							    	<div class="checkbox">
										<label for="enabled">
											<input id="enabled" name="enabled" value="1" type="checkbox" {{ $vars['vehicle']['enabled'] == '1' ? 'checked' : '' }}> Enabled
										</label>
									</div>
							    </div>

							</div>

						</div>

					</div>

					<div class="form-group">

						<div class="col-sm-12">

							<button type="submit" class="btn btn-primary pull-right">Save</button>

						</div>

					</div>

				</form>

			</div>

			<div class="col-md-4 col-sm-12">

			</div>

		</div>

	</div>

</section>

@endsection