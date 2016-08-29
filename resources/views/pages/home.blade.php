@extends('layouts.master')

@section('page_title')
Electric Autos | Used Electric Cars For Sale | Second hand electric cars
@endsection

@section('metas')
<meta name="description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="og:title" value="Electric Autos | Used Electric Cars For Sale | Second hand electric cars" />
<meta name="twitter:description" value="Electric and hybrid new and used cars for sale. Find the right used electric car for you at electric autos." />
<meta name="twitter:title" value="Electric Autos | Used Electric Cars For Sale | Second hand electric cars" />
@endsection

@section('content')

	<section class="hero">

		<div class="container">

			<div class="row">

				<div class="col-sm-12">

					<div class="container">

						<div class="row text-center">

							<div class="heading">
								<h1>Electric cars for sale</h1>
							</div>

							<div class="intro">
								<p>Browse the current electric autos for sale using the filters below. Sell your electric car for FREE.</p>

								<p>0 cars for sale</p>

								<p><a href="{{ route('cars.index') }}" class="btn btn-success">Browse All Cars</a> Or <a href="{{ route('start-selling') }}" class="btn btn-primary">Sell Your Car</a></p>
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

							<a href="{{ route('cars.brand.index' , ['brand' => 'tesla']) }}">Tesla</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'toyota']) }}">Toyota</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'bmw']) }}">BMW</a>

						</div>

						<div class="col-sm-3 col-md-3">

							<a href="{{ route('cars.brand.index' , ['brand' => 'volkswagen']) }}">Volkswagen</a>

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
						<h2>Featured electric cars</h2>
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
						<h2>Latest electric autos</h2>
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

@endsection

@section('footer')

@endsection