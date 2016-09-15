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

@section('footer')
<script type="text/javascript">
$('document').ready(function() {
    Dropzone.options.myAwesomeDropzone = {
    	paramName: "file", // The name that will be used to transfer the file
    	maxFilesize: 2000, // MB
    	uploadMultiple: true,
    	success:function(result, response) {
    		document.location = response.path;
    	},
    	complete:function(result) {
    		console.log('done');
    	},
    	error:function(result, result2, result3) {
    		console.log(result);
    		console.log(result2);
    		console.log(result3);
    	}
    };
});
</script>
@endsection