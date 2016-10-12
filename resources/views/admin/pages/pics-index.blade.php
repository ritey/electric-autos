@extends('layouts.admin')

@section('page_title')
Images
@endsection

@section('metas')
<meta name="description" value="Images" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
@endsection

@section('content')

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-sm-8">

				<ul class="breadcrumb">
					<li><a href="{{ route('admin.home') }}">Admin home</a></li>
					<li class="active">Pics</li>
				</ul>

				<div class="row">

					@if ($vars['pics']->count())

					@foreach($vars['pics'] as $pic)

						@include('partials.pic', ['img_filename' => $pic->maskname . '.' . $pic->extension,'img_url' => route('image') . '?user_id='.$pic->user_id.'&folder='.$pic->folder.'&filename='.urlencode($pic->maskname . '.' . $pic->extension).'&width=200&height=150','img_alt' 		=> $pic->filename,'delete_url' 	=> route('admin.pic.ad.delete', ['id' => $pic->id])])

					@endforeach

					@else

					<p>No images have been uploaded yet.</p>

					@endif

				</div>

				{!! $vars['pics']->links() !!}

			</div>

			<div class="col-sm-4">

				@include('partials.upload', ['url' => route('admin.pic.save') ])

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