@extends('layouts.master')

@section('page_title')
Your info
@endsection

@section('metas')
<meta name="description" value="Start selling with Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Start selling with Electric Autos" />
<meta name="og:title" value="Start selling with Electric Autos" />
<meta name="twitter:description" value="Start selling with Electric Autos" />
<meta name="twitter:title" value="Start selling with Electric Autos" />
@endsection

@section('title')
Your info
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-md-8 col-sm-12">

				<ul class="breadcrumb">
					<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li class="active">Dealer info</li>
				</ul>

				<h2 class="addon-header">Be as accurate as you can to help sell your car</h2>

			</div>

			<div class="col-md-4 col-sm-12">

			</div>

		</div>

	</div>

</section>

@endsection