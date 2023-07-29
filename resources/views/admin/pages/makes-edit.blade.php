@extends('layouts.admin')

@section('page_title')
Makes - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')

@endsection

@section('content')

<section class="">

	<div class="container mx-auto">

		<div class="row">

			<ul class="breadcrumb">
				<li><a href="{{ route('admin.home') }}">Admin home</a></li>
				<li><a href="{{ route('admin.makes') }}">Makes</a></li>
				<li class="active">{{ $vars['make']['name'] }}</li>
			</ul>

		</div>

		<div class="row">

			<div class="col-sm-8">

				@include('partials.errors')

				<form action="{{ route('admin.makes.update', ['id' => $vars['make']['id']]) }}" method="POST" class="form" role="form">
					{!! csrf_field() !!}

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Name<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="name" id="name" value="{{ $vars['make']['name'] or old('name') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row register-buttons">

						<div class="col-sm-6 col-xs-12">

						</div>

						<div class="col-sm-6 col-xs-12">

							<div class="form-group text-right">

								<a class="btn btn-default" href="{{ route('admin.makes') }}" title="Cancel">Cancel</a>
								<button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Save</button>

							</div>

						</div>

					</div>

				</form>

			</div>

			<div class="col-sm-4">

				<p class="text-right"><strong>Created at:</strong> {{ $vars['make']['created_at']->format('d-m-Y H:i') }}</p>
				<p class="text-right"><strong>Updated at:</strong> {{ $vars['make']['updated_at']->format('d-m-Y H:i') }}</p>

			</div>

		</div>

	</div>

</section>

@endsection