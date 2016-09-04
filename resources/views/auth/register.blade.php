@extends('layouts.master')

@section('page_title')
Register an account on Electric Autos
@endsection

@section('metas')
<meta name="description" value="Register an account on Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Register an account on Electric Autos" />
<meta name="og:title" value="Register an account on Electric Autos" />
<meta name="twitter:description" value="Register an account on Electric Autos" />
<meta name="twitter:title" value="Register an account on Electric Autos" />
@endsection

@section('content')

<section class="main">

	<div class="container">

		<div class="row">

			<div class="col-sm-12 col-md-12">

				<div class="row">

					<div class="col-sm-10 col-md-8 col-md-offset-2 col-sm-offset-1">

						<div class="registration">

							<div class="form-heading text-center">

								<h3>Create Your Account</h3>
								<p>Complete the following fields to register<br>a new Electric Autos account.</p>

							</div>

							@include('partials.errors')

							<form action="{{ route('register-post') }}" method="POST" class="form">
								{!! csrf_field() !!}

								<div class="row">

									<div class="col-sm-12">

										<div class="form-group">

											<label for="name" class="">Name<span class="star">&nbsp;*</span></label>

											<div class="group-control">
												<input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" aria-required="true">
											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group">

											<label for="password" class="">Password<span class="star">&nbsp;*</span></label>

											<div class="group-control">

												<input type="password" name="password" id="password" value="" class="form-control" required="required" aria-required="true">

											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group">

											<label for="password_confirmation" class="">Confirm Password<span class="star">&nbsp;*</span></label>

											<div class="group-control">

												<input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control" required="required" aria-required="true">

											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group">

											<label for="email" class="">Email Address<span class="star">&nbsp;*</span></label>

											<div class="group-control">

												<input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required="required" aria-required="true">

											</div>

										</div>

									</div>

									<div class="col-sm-6">

										<div class="form-group">

											<label for="email_confirmation" class="">Confirm email Address<span class="star">&nbsp;*</span></label>

											<div class="group-control">

												<input type="email" name="email_confirmation" class="form-control" id="email_confirmation" value="{{ old('name') }}" required="required" aria-required="true">

											</div>

										</div>

									</div>

								</div>

								<div class="row register-buttons">

									<div class="col-sm-6 col-xs-12">

										<p class="sign-in-text">Already have an account? <a href="{{ route('login') }}">Login</a></p>

									</div>

									<div class="col-sm-6 col-xs-12">

										<div class="form-group text-right">

											<a class="btn btn-default" href="{{ route('home') }}" title="Cancel">Cancel</a>
											<button type="submit" class="btn btn-success">Registration</button>

										</div>

									</div>

								</div>

							</form>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection