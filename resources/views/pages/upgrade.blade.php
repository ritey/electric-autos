@extends('layouts.master')

@section('page_title')
Upgrade your account on Electric Autos
@endsection

@section('metas')
<meta name="description" value="Upgrade your account on Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Upgrade your account on Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="og:title" value="Upgrade your account on Electric Autos" />
<meta name="twitter:description" value="Upgrade your account on Electric Autos, the electric used car directory with thousands of cars for sale." />
<meta name="twitter:title" value="Upgrade your account on Electric Autos" />
<meta name="twitter:creator" value="@electricautosuk" />

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

@endsection

@section('content')

	<section class="hero">

		<div class="container">

			<div class="row text-center">

				<div class="heading">
					<h1>Upgrade your account</h1>
				</div>

				<div class="intro">

					<p>Get a dealer account and extra functionality</p>

				</div>

			</div>

		</div>

	</section>

	<section class="section-pad">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="addon-header text-center">
						<h2>All the regular features plus...</h2>
					</div>

					<div class="row">

						<div class="col-sm-4">

							<h3><i class="fa fa-trophy"></i> Featured adverts</h4>
							<p>Choose adverts to be featured in search results and on the homepage.</p>

						</div>

						<div class="col-sm-4">

							<h3><i class="fa fa-trophy"></i> Dealer details page</h4>
							<p>Have a dedicated page with all your cars for sale listed alongside your information.</p>

						</div>

						<div class="col-sm-4">

							<h3><i class="fa fa-trophy"></i> Site Stats</h4>
							<p>See how well your adverts are doing with analytics including views and trends.</p>

						</div>

					</div>

				</h2>

			</div>

		</div>

	</section>

	<section class="section-pad alternative">

		<div class="container">

			<div class="row">

				<div class="col-sm-12 text-center">

					<form action="{{ route('upgrade.process') }}" method="POST">
						{!! csrf_field() !!}
					  <script
					    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
					    data-key="pk_test_vucuHZVV4qtZEtjusMRN6c0R"
					    data-amount="999"
					    data-name="Electric Autos"
					    data-description="Monthly Dealer Subscription"
					    data-image="https://www.electric-autos.co.uk/images/bolt-logo-64x64.png"
					    data-locale="auto"
					    data-zip-code="true"
					    data-label="Upgrade my account"
					    data-currency="gbp">
					  </script>
					</form>

				</div>

			</div>

		</div>

	</section>

	<section class="section-pad">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="addon-header text-center">
						<h2>FAQ's</h2>
					</div>

					<div class="row">

						<div class="col-sm-4">

							<h3><i class="fa fa-chevron-right"></i> What does it cost?</h4>
							<p>A premium account is only &pound;9.99.</p>

						</div>

						<div class="col-sm-4">

							<h3><i class="fa fa-chevron-right"></i> How long am I tied in for?</h4>
							<p>You can downgrade at any time from your dashboard to a free account.</p>

						</div>

						<div class="col-sm-4">

							<h3><i class="fa fa-chevron-right"></i> More questions?</h4>
							<p>If you have any more questions <a href="{{ route('contact') }}">contact us</a>.</p>

						</div>

					</div>

				</h2>

			</div>

		</div>

	</section>

@endsection