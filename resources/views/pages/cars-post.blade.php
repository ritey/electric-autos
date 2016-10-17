@extends('layouts.master')

@section('page_title')
{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }}
@endsection

@section('metas')
<meta name="description" value="{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }} for sale on Elecric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }} for sale on Elecric Autos" />
<meta name="og:title" value="{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }} for sale on Elecric Autos" />
<meta name="twitter:description" value="{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }} for sale on Elecric Autos" />
<meta name="twitter:title" value="{{ $vars['car']['make'] }} > {{ $vars['car']['model'] }} > | {{ $vars['car']['name'] }} for sale on Elecric Autos" />
<meta name="twitter:creator" value="@electricautosuk" />
@endsection

@section('title')
{{ $vars['car']['name'] }}
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<p><a href="{{ $vars['back_url'] }}" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Back to results</a></p>

				<h2 class="hidden-md hidden-lg">
					@if($vars['car']['sold'])
					NOW SOLD
					@else
					Price {{ $vars['car']['currency'] == 'Pound' ? '&pound;' : '' }}{{ $vars['car']['currency'] == 'Euro' ? '&euro;' : '' }}{{ $vars['car']['price'] }}
					@endif
				</h2>

			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<figure>
					@if ($vars['car']['image_count'])
					<img src="{{ $vars['car']['img_url'] }}" alt="{{ $vars['car']['make'] }} {{ $vars['car']['model'] }} image">
					@else
					<img src="/images/holder.png" alt="">
					@endif
				</figure>

				<div class="thumbs">
					@if ($vars['car']['image_count'])
					@foreach($vars['car']['images'] as $image)
						<img src="{{ $image['thumb_src'] }}" alt="{{ $image['alt'] }}">
					@endforeach
				@endif
				</div>

				<div class="details">

					<ul class="list-unstyled">
						@if($vars['car']['colour'])
						<li>
							<span>
								<i class="fa fa-eyedropper"></i>
								<span class="hidden-sm">Colour</span>
							</span>
							{{ $vars['car']['colour'] }}
						</li>
						@endif
						@if($vars['car']['year'])
						<li>
							<span>
								<i class="fa fa-calendar"></i>
								<span class="hidden-sm">Year</span>
							</span>
							{{ $vars['car']['year'] }}
						</li>
						@endif
						@if($vars['car']['mileage'])
						<li>
							<span>
								<i class="fa fa-tachometer"></i>
								<span class="hidden-sm">Mileage</span>
							</span>
							{{ $vars['car']['mileage'] }}
						</li>
						@endif
						@if($vars['car']['fuel'])
						<li>
							<span>
								<i class="fa fa-battery-half"></i>
								<span class="hidden-sm">Fuel</span>
							</span>
							{{ $vars['car']['fuel'] }}
						</li>
						@endif
						@if($vars['car']['doors'])
						<li>
							<span>
								<i class="fa fa-car"></i>
								<span class="hidden-sm">Doors</span>
							</span>
							{{ $vars['car']['doors'] }}
						</li>
						@endif
						@if($vars['car']['gearbox'])
						<li>
							<span>
								<i class="fa fa-gear"></i>
								<span class="hidden-sm">Gearbox</span>
							</span>
							{{ $vars['car']['gearbox'] }}
						</li>
						@endif
					</ul>

				</div>

				<h4>{{ $vars['car']['make'] }} {{ $vars['car']['model'] }} description</h4>

				{!! str_replace('incl.</p><p>','incl.',"<p>" . str_replace( ".", '.</p><p>', $vars['car']['content']) . "</p>") !!}

			</div>

			<div class="col-md-4">

				<h2 class="hidden-sm hidden-xs">
					@if($vars['car']['sold'])
					NOW SOLD
					@else
					Price {{ $vars['car']['currency'] == 'Pound' ? '&pound;' : '' }}{{ $vars['car']['currency'] == 'Euro' ? '&euro;' : '' }}{{ $vars['car']['price'] }}
					@endif
				</h2>
				<h3>Contact seller</h3>
				@if(!$vars['car']['private'])
				<h3>{{ $vars['car']['dealer_name'] }}</h3>
				<p>Call: {{ $vars['car']['dealer_phone'] }}</p>
				<p><a href="{{ $vars['car']['dealer_url'] }}">View more from this dealer</a>
				@else
				<p></p>
				@endif

				<div class="col-sm-12 col-md-12 text-center">

					@include('partials.advert')

				</div>

			</div>

		</div>

		<div class="row">

			<div class="col-sm-12">

			</div>

		</div>

	</div>

</section>

@endsection

@section('footer')
<script type="text/javascript">
	$('.thumbs > img').on('click', function() {
		$('figure > img').attr('src',$(this).attr('src').replace('width=80','width=400').replace('height=80','height=300'));
	});
</script>
@endsection