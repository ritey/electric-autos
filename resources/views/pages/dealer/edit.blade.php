@extends('layouts.master')

@section('page_title')
Your info
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
Your info
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<ul class="breadcrumb">
					<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="active">Dealer info</li>
				</ul>

				<h2 class="addon-header">Be as accurate as you can to help sell your car</h2>

				<form class="form form-horizontal" method="POST" action="{{ route('dealer.save') }}">
					{!! csrf_field() !!}

					@include('partials.errors')

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Dealer name</label>
						<div class="col-sm-9">
							<input type="text" name="name" id="name" class="form-control" value="{{ $vars['dealer']['name'] or old('name') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Public email</label>
						<div class="col-sm-9">
							<input type="text" name="email" id="email" class="form-control" value="{{ $vars['dealer']['email'] or old('email') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Public phone</label>
						<div class="col-sm-9">
							<input type="text" name="phone" id="phone" class="form-control" value="{{ $vars['dealer']['phone'] or old('phone') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Public mobile</label>
						<div class="col-sm-9">
							<input type="text" name="mobile" id="mobile" class="form-control" value="{{ $vars['dealer']['mobile'] or old('mobile') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Post code</label>
						<div class="col-sm-9">
							<input type="text" name="location" id="location" class="form-control" value="{{ $vars['dealer']['location'] or old('location') }}">
						</div>

					</div>

					<div class="form-group">

						<label for="price" class="col-sm-3 control-label">Website</label>
						<div class="col-sm-9">
							<input type="text" name="website" id="website" class="form-control" value="{{ $vars['dealer']['website'] or old('website') }}">
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