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

						<div class="row">

						@if ($vars['pics']->count())

						@foreach($vars['pics'] as $pic)

							@include('partials.pic', ['pic' => $pic, 'ad' => $vars['ad']])

						@endforeach

						@else

						<p>No images have been uploaded yet.</p>

						@endif

						</div>

						{!! $vars['pics']->links() !!}

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

@section('footer')
<script type="text/javascript">
    Dropzone.options.myAwesomeDropzone = {
    	paramName: "file", // The name that will be used to transfer the file
    	maxFilesize: 2000, // MB
    	uploadMultiple: true,
    	acceptedFiles: "image/jpeg,image/png,image/gif",
    	success:function(result, response) {
			document.location = response.path;
    	},
    };
    $('document').ready(function(){

    	$('.confirm').on('click', function(){
    		return confirm('Are you sure you want to delete this image?');
    	});

    });
</script>
@endsection