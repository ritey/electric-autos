@extends('layouts.master')

@section('page_title')
Login to Electric Autos
@endsection

@section('metas')
<meta name="description" value="Create an account and login to Electric Autos to manage your car adverts" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Create an account and login to Electric Autos to manage your car adverts." />
<meta name="og:title" value="Login to Electric Autos" />
<meta name="twitter:description" value="Create an account and login to Electric Autos to manage your car adverts" />
<meta name="twitter:title" value="Login to Electric Autos" />
@endsection

@section('content')

<section class="main">

	<div class="container">

		<div class="row">

			<div class="col-sm-12 col-md-12">

				<div class="row">

					<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

						<div class="box login">

							<div class="login-description text-center">
								Welcome Back
								<p>You can sign in with your email.</p>
							</div>

							@include('partials.errors')

							<form action="{{ route('login') }}" method="POST" class="form">
								{!! csrf_field() !!}

								<div class="form-group">

									<div class="group-control">

										<input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email" required="" aria-required="true" autofocus="">
									</div>
								</div>

								<div class="form-group">

									<div class="group-control">

										<input type="password" name="password" id="password" value="" placeholder="Password" class="form-control" required="" aria-required="true">
									</div>

								</div>

								<div class="checkbox">

									<label>
										<input id="remember" type="checkbox" name="remember" value="yes">
										Remember me </label>
								</div>

								<div class="form-group text-right">

									<button type="submit" class="btn btn-success">Log in </button>

								</div>

							</form>

						</div>

						<div class="form-links">

							<ul>
								<li><a href="{{ route('password-reset') }}">Forgot your password?</a></li>
								<li><a href="{{ route('register') }}">Don't have an account?</a></li>
							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection