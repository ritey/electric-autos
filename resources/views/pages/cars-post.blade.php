@extends('layouts.master')

@section('page_title')
Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars
@endsection

@section('metas')
<meta name="description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="og:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
<meta name="twitter:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="twitter:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
@endsection

@section('content')

@include('partials.section-title', ['title' => $vars['car']->name])

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<p><a href="{{ $vars['back_url'] }}" class="btn btn-info"><i class="fa fa-angle-double-left"></i> Back to results</a></p>

			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<figure>
					@if (is_object($vars['car']) && $vars['car']->images())
					<img src="{{ route('image') }}?folder={{ $vars['car']->id }}&filename={{ urlencode($vars['car']->images()->first()->maskname . '.' . $vars['car']->images()->first()->extension) }}&width=470&height=400" alt="">
					@else
					<img src="/images/holder.png" alt="">
					@endif
				</figure>

				<div class="details">

					<ul class="list-unstyled">
						<li>
							<span>
								<i class="fa fa-eyedropper"></i>
								<span class="hidden-sm">Colour</span>
							</span>
							{{ $vars['car']->colour }}
						</li>
						<li>
							<span>
								<i class="fa fa-calendar"></i>
								<span class="hidden-sm">Year</span>
							</span>
							{{ $vars['car']->year }}
						</li>
						<li>
							<span>
								<i class="fa fa-tachometer"></i>
								<span class="hidden-sm">Mileage</span>
							</span>
							{{ $vars['car']->mileage }}
						</li>
						<li>
							<span>
								<i class="fa fa-battery-half"></i>
								<span class="hidden-sm">Fuel</span>
							</span>
							{{ $vars['car']->fuel }}
						</li>
						<li>
							<span>
								<i class="fa fa-car"></i>
								<span class="hidden-sm">Doors</span>
							</span>
							{{ $vars['car']->doors }}
						</li>
						<li>
							<span>
								<i class="fa fa-gear"></i>
								<span class="hidden-sm">Gearbox</span>
							</span>
							{{ $vars['car']->gearbox }}
						</li>
					</ul>

				</div>

				<p>{{ $vars['car']->content }}</p>

			</div>

			<div class="col-md-4">

				<h2>Price {{ $vars['car']->price }}</h2>

				<h3>Contact seller</h3>
				<p>Call: {{ $vars['car']->dealer->phone }}

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