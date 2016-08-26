@extends('layouts.master')

@section('page_title')
About Electric Autos
@endsection

@section('metas')
<meta name="description" value="" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="" />
<meta name="og:title" value="" />
<meta name="twitter:description" value="" />
<meta name="twitter:title" value="" />
@endsection

@section('content')

@include('partials.section-title', ['title' => '&pound; 75 Car For Sale'])

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<a href="" class="">Back to results</a>

			</div>

		</div>

		<div class="row">

			<div class="col-md-8">

				<figure>
					<img src="/images/holder.png" alt="">
				</figure>

				<ul>
					<li>Mileage</li>
				</ul>

				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			</div>

			<div class="col-md-4">

				<h2>Price</h2>

				<h3>Contact seller</h3>

				<div class="col-sm-12 col-md-12 text-center">

					@include('partials.advert')

				</div>

			</div>

		</div>

	</div>

</section>

@endsection