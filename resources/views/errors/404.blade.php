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
<section class="p-[70px] my-10">
	<div class="container mx-auto">
		<div class="w-full text-center">
			<h3 class="text-xl font-semibold my-4">Oops, this isn't what we wanted to show you.</h3>
			<p>The page you were looking for couldn't be found.</p>
		</div>
	</div>
</section>
@endsection