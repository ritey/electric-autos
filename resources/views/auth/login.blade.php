@extends('layouts.master')

@section('page_title')
About Electric Autos
@endsection

@section('metas')
<meta name="description" value="About Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="About Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="og:title" value="About Electric Autos" />
<meta name="twitter:description" value="About Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="twitter:title" value="About Electric Autos" />
@endsection

@section('content')

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-sm-12 col-md-12">

				<div class="">

					<div class="row">

						<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">

							<div class="">

								<div class="login-description text-center">
									Welcome Back
									<p>You can sign in with your email.</p>
								</div>
								<form action="" method="post" class="form">
									<input type="hidden" name="" value="" />

									<div class="form-group">

										<div class="group-control">

											<input type="text" name="username" id="username" value="" class="form-control" placeholder="Username" required="" aria-required="true" autofocus="">
										</div>
									</div>

									<div class="form-group">

										<div class="group-control">

											<input type="password" name="password" id="password" value="" placeholder="Password" class="form-control" required="" aria-required="true">
										</div>

									</div>

									<div class="checkbox">

										<label>
											<input id="remember" type="checkbox" name="remember" class="form-control" value="yes">
											Remember me </label>
									</div>

									<div class="form-group text-right">

										<button type="submit" class="btn btn-success btn-lg btn-block btn-login">Log in </button>

									</div>

								</form>

							</div>

							<div class="form-links">
								<ul>
									<li>
										<a href="/profile/edit?view=reset">Forgot your password?</a>
									</li>
									<li>
										<a href="/profile/edit?view=remind">Forgot your username?</a>
									</li>
									<li>
										<a href="/create-an-account">Don't have an account?</a>
									</li>
								</ul>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection