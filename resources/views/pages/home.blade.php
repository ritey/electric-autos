@extends('layouts.master')

@section('page_title')
Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')
<meta name="description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="og:title" value="Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars" />
<meta name="twitter:description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="twitter:title" value="Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars" />
@endsection

@section('content')

	<section class="hero">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="container">

						<div class="row text-center">

							<div class="heading">
								<h1>Electric and hybrid cars for sale</h1>
							</div>

							<div class="intro">
								<p>Browse the current electric and hybrid autos for sale using the filters below. Sell your hybrid/electric car for FREE.</p>

								<p><strong>{{ $vars['total_cars'] or '0' }} used electric cars</strong> for sale</p>

								<p><a href="{{ route('cars.index') }}" class="btn btn-success" title="Browse all hybrid and electric cars for sale">Browse All Cars</a> Or <a href="{{ route('start-selling') }}" class="btn btn-primary" title="Sell your hybrid or electric car">Sell Your Car</a></p>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<section class="brands-section section-pad">

		<div class="container">

			<div class="row">

				<div class="col-sm-12 col-md-12 text-center">

					<div class="row">

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'tesla']) }}" title="Electric Tesla for sale">Tesla</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'toyota']) }}" title="Electric Toyota for sale">Toyota</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'bmw']) }}" title="Electric BMW for sale">BMW</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'volkswagen']) }}" title="Electric Volkswagen for sale">Volkswagen</a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	@if(isset($vars['featured']))

	<section class="section-pad">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="addon-header">
						<h2>Featured electric and hybrid cars for sale</h2>
					</div>

					<div class="row">

						@foreach($vars['featured'] as $car)

							<div class="col-sm-6 col-md-4">

								@include('partials.card', ['car' => $car])

							</div>

						@endforeach

					</div>

				</div>

			</div>

		</div>

	</section>

	@endif

	@if(isset($vars['latest']))

	<section class="section-pad alternative">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="addon-header">
						<h2>Latest electric and hybrid autos for sale</h2>
					</div>

					<div class="row">

						@foreach($vars['latest'] as $car)

							<div class="col-sm-6 col-md-4">

								@include('partials.card', ['car' => $car])

							</div>

						@endforeach

					</div>

				</div>

			</div>

		</div>

	</section>

	@endif

	<section class="section-pad">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="addon-header">
						<h2>Buying electric cars and selling electric cars</h2>
					</div>

					<div class="row">

						<div class="col-sm-12">

							<p>The <strong>UK electric car</strong> scene is growing quickly with a range of <strong>hybrid electric cars</strong> and full <strong>electric cars</strong> now available.</p>

							<p>Hybrid and plugin electric cars use batteries to help reduce CO2 emissions, hybrid cars also use the common combustion engine.</p>

							<p>If you're looking for <strong>used electric cars</strong> you've come to the right website, browse our directory of <a href="{{ route('cars.index') }}" title="Used electric cars for sale">used electric cars</a>.</p>

							<p>Electric cars or electric vehicles also known as EV (electric vehicles) can be found in a range of sizes, city EV's and full size EV's. City EV's would be cars like the <a href="{{ route('cars.search.index', ['brand' => 'Nissan', 'version' => 'Lead']) }}">Nissan Leaf</a> and a full size EV would be something like a <a href="{{ route('cars.search.index', ['brand' => 'Tesla', 'version' => 'Model S']) }}">Tesla Model S</a></p>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>
@endsection

@section('footer')

@endsection