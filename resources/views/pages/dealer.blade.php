@extends('layouts.master')

@section('page_title')
Electric cars for sale from {{ $vars['dealer']->name }}
@endsection

@section('metas')
<meta name="description" value="Electric cars for sale from {{ $vars['dealer']->name }}" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Electric cars for sale from {{ $vars['dealer']->name }}" />
<meta name="og:title" value="Electric cars for sale from {{ $vars['dealer']->name }}" />
<meta name="twitter:description" value="Electric cars for sale from {{ $vars['dealer']->name }}" />
<meta name="twitter:title" value="Electric cars for sale from {{ $vars['dealer']->name }}" />
@endsection

@section('title')
Electric cars for sale from {{ $vars['dealer']->name }}
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-9">

				<div class="col-sm-12 col-md-12">

					<h3>{{ $vars['dealer']->name }}</h3>
					<p>{{ $vars['dealer']->location }}</p>

				</div>

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

				<p id="results" class="sc-only"></p>

				@if(count($vars['cars']))

					@foreach($vars['cars'] as $collection)

						@foreach($collection as $car)

							<div class="col-sm-6 col-md-4">

								@include('partials.card', ['car' => $car])

							</div>

						@endforeach

						<div class="col-sm-12 col-md-12 text-center">

							@include('partials.advert')

						</div>

					@endforeach

				@else

					<div class="col-sm-12">

						<h3>No cars found</h3>

					</div>

				@endif

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

			</div>

			<div class="col-sm-">

				<h3>{{ $vars['dealer']->name }}</h3>
				@if ($vars['dealer']->location)
				<p>{{ $vars['dealer']->location }}</p>
				@endif
				@if ($vars['dealer']->phone)
				<p><strong>Phone:</strong><br /> {{ $vars['dealer']->phone }}</p>
				@endif
				@if ($vars['dealer']->mobile)
				<p><strong>Mobile:</strong><br /> {{ $vars['dealer']->mobile }}</p>
				@endif
				@if ($vars['dealer']->website)
				<p><strong>Website:</strong><br /><a target="_blank" rel="nofollow" href="{{ $vars['dealer']->website }}">{{ $vars['dealer']->website }}</a></p>
				@endif
			</div>

		</div>

	</div>

</section>

@endsection