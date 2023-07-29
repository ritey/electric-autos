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
<meta name="twitter:creator" value="@electricautosuk" />
@endsection

@section('content')
	<section class="w-full bg-gray-600 p-20 text-white">
		<div class="mx-auto container">
			<div class="w-full text-center">
				<div class="my-10">
					<h1 class="text-4xl font-bold">Electric and hybrid cars for sale</h1>
					<h2 class="text-2xl font-semibold">Electric Autos, the best used electric cars in the UK</h2>
				</div>
				<div class="">
					<p class="mb-4">Browse the current electric and hybrid autos for sale using the filters below. Sell your hybrid/electric car for FREE.</p>
					<p class="mb-4"><strong>{{ $vars['total_cars'] or '0' }} used electric cars</strong> for sale</p>
					<p class="mb-4"><a href="{{ route('cars.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition" title="Browse all hybrid and electric cars for sale">Browse All Cars</a> Or <a href="{{ route('start-selling') }}" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition" title="Sell your hybrid or electric car">Sell Your Car</a></p>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-[#66ad44] text-white p-[70px] my-10">
		<div class="container mx-auto">
			<div class="w-full text-center flex">
				<div class="w-1/2 lg:w-1/4">
					<a class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition btn-lg mb-10" href="{{ route('cars.brand.index' , ['brand' => 'tesla']) }}" title="Electric Tesla for sale">Tesla</a>
				</div>
				<div class="w-1/2 lg:w-1/4">
					<a class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition btn-lg mb-10" href="{{ route('cars.brand.index' , ['brand' => 'toyota']) }}" title="Electric Toyota for sale">Toyota</a>
				</div>
				<div class="w-1/2 lg:w-1/4">
					<a class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition btn-lg mb-10" href="{{ route('cars.brand.index' , ['brand' => 'bmw']) }}" title="Electric BMW for sale">BMW</a>
				</div>
				<div class="w-1/2 lg:w-1/4">
					<a class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition btn-lg mb-10" href="{{ route('cars.brand.index' , ['brand' => 'volkswagen']) }}" title="Electric Volkswagen for sale">Volkswagen</a>
				</div>
			</div>
		</div>
	</section>

	@if(isset($vars['featured']))
		<section class="p-[70px]">
			<div class="container mx-auto">
				<div class="w-full">
					<div class="addon-header">
						<h3 class="text-xl font-semibold my-4">Featured electric and hybrid cars for sale</h3>
					</div>
					@foreach($vars['featured'] as $car)
						<div class="w-1/2 md:w-1/4">
							@include('partials.card', ['car' => $car])
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	@if(isset($vars['latest']))

	<section class="p-[70px] alternative my-10">
		<div class="container mx-auto">
			<div class="w-full">
				<div class="addon-header text-center">
					<h3 class="text-xl font-semibold my-4">Latest electric and hybrid autos for sale</h3>
				</div>
				@foreach($vars['latest'] as $car)
					<div class="w-1/2 md:w-1/4">
						@include('partials.card', ['car' => $car])
					</div>
				@endforeach
			</div>
		</div>
	</section>

	@endif

	<section class="bg-[#66ad44] text-white p-[70px] my-10">
		<div class="container mx-auto">
			<div class="w-full text-center">
				<h3 class="text-xl font-semibold my-4">Popular electric car (EV) searches</h3>
				<div class="flex my-8">
					<div class="w-1/2 lg:w-1/4">
						<a class="mb-10 underline" href="{{ route('cars.index' , ['sort' => 'last-24']) }}" title="Show cars added in the last 24 hours">Added recently</a>
					</div>
					<div class="w-1/2 lg:w-1/4">
						<a class="mb-10 underline" href="{{ route('cars.index' , ['max_mileage' => '2000', 'sort' => 'low-mileage']) }}" title="Show cars with less than 2,000 miles">Low mileage EVs</a>
					</div>
					<div class="w-1/2 lg:w-1/4">
						<a class="mb-10 underline" href="{{ route('cars.index' , ['sort' => 'best-range']) }}" title="Show cars with the best range">Best range EVs</a>
					</div>
					<div class="w-1/2 lg:w-1/4">
						<a class="mb-10 underline" href="{{ route('cars.index' , ['sort' => 'most-popular']) }}" title="Show the most viewed cars">Most popular EVs</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="p-[70px] my-10">
		<div class="container mx-auto">
			<div class="w-full">
				<div class="addon-header">
					<h3 class="text-xl font-semibold my-4">Buying electric cars and selling electric cars</h3>
				</div>
				<div class="w-full">
					<p class="mb-4">The <strong>UK electric car</strong> scene is growing quickly with a range of <strong>hybrid electric cars</strong> and full <strong>electric cars</strong> now available.</p>
					<p class="mb-4">Hybrid and plugin electric cars use batteries to help reduce CO2 emissions, hybrid cars also use the common combustion engine.</p>
					<p class="mb-4">If you're looking for <strong>used electric cars</strong> you've come to the right website, browse our directory of <a href="{{ route('cars.index') }}" title="Used electric cars for sale">used electric cars</a>.</p>
					<p class="mb-4">Electric cars or electric vehicles also known as EV (electric vehicles) can be found in a range of sizes, city EV's and full size EV's. City EV's would be cars like the <a href="{{ route('cars.search.index', ['brand' => 'Nissan', 'version' => 'Leaf']) }}">Nissan Leaf</a> and a full size EV would be something like a <a href="{{ route('cars.search.index', ['brand' => 'Tesla', 'version' => 'Model S']) }}">Tesla Model S</a>.</p>
				</div>
			</div>
		</div>
	</section>

@endsection