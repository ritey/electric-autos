@extends('layouts.master')

@section('page_title')
Images
@endsection

@section('metas')
<meta name="description" value="Your images" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
@endsection

@section('title')
{{ 'Hello ' . $vars['user']->name }}
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-8">

						<ul class="breadcrumb">
							<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
							<li class="active">Pic gallery</li>
						</ul>

					</div>

					<div class="col-sm-4">

						@include('partials.upgrade', ['user' => $vars['user']])

						@include('partials.upload')

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection