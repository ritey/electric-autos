@extends('layouts.admin')

@section('page_title')
Posts - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')

@endsection

@section('content')

<section class="">

	<div class="container">

		<div class="row">

			<ul class="breadcrumb">
				<li><a href="{{ route('admin.home') }}">Admin home</a></li>
				<li><a href="{{ route('admin.posts') }}">Posts</a></li>
				<li class="active">{{ $vars['post']['name'] }}</li>
			</ul>

		</div>

		<div class="row">

			<div class="col-sm-8">

				@include('partials.errors')

				<form action="{{ $vars['action_url'] }}" method="POST" class="form" role="form">
					{!! csrf_field() !!}

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Name<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="name" id="name" value="{{ $vars['post']['name'] or old('name') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Slug<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="slug" id="slug" value="{{ $vars['post']['slug'] or old('slug') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Position<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="sort_order" id="sort_order" value="{{ $vars['post']['sort_order'] or old('sort_order') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Live date<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="live_at" id="live_at" value="{{ $vars['post']['live_at'] or old('live_at') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Meta date<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="meta_date" id="meta_date" value="{{ $vars['post']['meta_date'] or old('meta_date') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Author<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="meta_author" id="meta_author" value="{{ $vars['post']['meta_author'] or old('meta_author') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Meta Title<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="meta_title" id="meta_title" value="{{ $vars['post']['meta_title'] or old('meta_title') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Meta description<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="meta_description" id="meta_description" value="{{ $vars['post']['meta_description'] or old('meta_description') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Summary<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<input type="text" name="summary" id="summary" value="{{ $vars['post']['summary'] or old('summary') }}" required="required" class="form-control" aria-required="true">
								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

								<label for="name" class="">Content<span class="star">&nbsp;*</span></label>

								<div class="group-control">
									<textarea name="body" id="body" required="required" rows="6" class="form-control" aria-required="true">{{ $vars['post']['body'] or old('body') }}</textarea>
								</div>

							</div>

						</div>

					</div>


					<div class="row">

						<div class="col-sm-12">

							<div class="form-group">

							    	<div class="checkbox">
										<label for="enabled">
											<input id="enabled" name="enabled" value="1" type="checkbox" {{ $vars['post']['enabled'] == '1' ? 'checked' : '' }}> Enabled
										</label>
									</div>

							</div>

						</div>

					</div>


					<div class="row register-buttons">

						<div class="col-sm-6 col-xs-12">

						</div>

						<div class="col-sm-6 col-xs-12">

							<div class="form-group text-right">

								<a class="btn btn-default" href="{{ route('admin.posts') }}" title="Cancel">Cancel</a>
								<button type="submit" class="btn btn-success">Save</button>

							</div>

						</div>

					</div>

				</form>

			</div>

			<div class="col-sm-4">

				<p class="text-right"><strong>Created at:</strong> {{ $vars['post']['created_at'] != '' ? $vars['post']['created_at']->format('d-m-Y H:i') : '' }}</p>
				<p class="text-right"><strong>Updated at:</strong> {{ $vars['post']['updated_at'] or '' }}</p>

			</div>

		</div>

	</div>

</section>

@endsection