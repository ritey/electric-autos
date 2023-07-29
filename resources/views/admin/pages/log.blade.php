@extends('layouts.admin')

@section('page_title')
Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')

@endsection

@section('content')

<section class="">

	<div class="container mx-auto">

		<div class="row">

			<div class="col-sm-12">

				<ul class="breadcrumb">
					<li><a href="{{ route('admin.home') }}">Admin home</a></li>
					<li class="active">Log</li>
				</ul>

				<p class="text-right"><a class="btn btn-sm btn-default" href="{{ route('admin.clear-log') }}">Clear log</a></p>

				<textarea class="form-control" rows="20">{{ $vars['log'] }}</textarea>

				<p>&nbsp;</p>

			</div>

		</div>

	</div>

</section>

@endsection

@section('footer')

@endsection