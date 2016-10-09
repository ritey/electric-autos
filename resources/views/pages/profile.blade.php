@extends('layouts.master')

@section('page_title')
Profile
@endsection

@section('metas')
<meta name="description" value="Your profile" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
@endsection

@section('title')
{{ 'Hello ' . $vars['user']->name }}
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-8">

						<ul class="breadcrumb">
							<li>My account</li>
							<li class="active">Profile</li>
						</ul>

						@include('partials.errors')

						<form action="{{ route('profile-save') }}" method="POST" class="form">
							{!! csrf_field() !!}

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<label for="name" class="">Name<span class="star">&nbsp;*</span></label>

										<div class="group-control">
											<input type="text" name="name" id="name" value="{{ $vars['user']->name or old('name') }}" required="required" class="form-control" aria-required="true">
										</div>

									</div>

								</div>

								<div class="col-sm-6">

									<div class="form-group">

										<label for="email" class="">Email Address<span class="star">&nbsp;*</span></label>

										<div class="group-control">

											<input type="email" name="email" class="form-control" id="email" value="{{ $vars['user']->email or old('email') }}" required="required" aria-required="true">

										</div>

									</div>

								</div>

							</div>

							<div class="row register-buttons">

								<div class="col-sm-6 col-xs-12">

									<div class="form-group text-right">

										<button type="submit" class="btn btn-primary">Save</button>

									</div>

								</div>

							</div>

						</form>

					</div>

					<div class="col-sm-4">

						@if (!$vars['user']->subscribed('Dealer Plan'))

						@include('partials.upgrade', ['user' => $vars['user']])

						@else

						@include('partials.dealer-button')

						@endif

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection