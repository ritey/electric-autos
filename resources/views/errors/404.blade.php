@extends('layouts.master')

@section('page_title')
404 Not Found | Electric Autos
@endsection

@section('metas')
<meta name="description" value="404 Not Found | Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="404 Not Found | Electric Autos" />
<meta name="og:title" value="404 Not Found | Electric Autos" />
<meta name="twitter:description" value="404 Not Found | Electric Autos" />
<meta name="twitter:title" value="404 Not Found | Electric Autos" />
@endsection

@section('title')
Not found
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<h3>Oops, this isn't what we wanted to show you.</h3>
				<p>The page you were looking for couldn't be found, please try one of the links below.</p>

				<ul class="list-unstyled">
					@foreach($makes as $brand)
					<li><a href="{{ route('cars.brand.index', ['brand' => strtolower($brand->name) ]) }}">{{ $brand->name }} electric cars</a></li>
					@endforeach
				</ul>
			</div>

		</div>

	</div>

</section>

@endsection