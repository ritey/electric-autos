@extends('layouts.master')

@section('page_title')
Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars
@endsection

@section('metas')
<meta name="description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="og:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
<meta name="twitter:description" value="Directory of used electric cars, filter for specific used electric cars by make, model, mileage etc" />
<meta name="twitter:title" value="Electric cars for sale on Electric Autos | Electric Classifieds | Used autos | Used cars" />
@endsection

@section('content')

@include('partials.section-title', ['title' => 'Electric car classifieds'])

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-3">

				<h3>Filters</h3>

				@include('partials.search-form')

			</div>

			<div class="col-sm-9">

				<div class="col-sm-12 col-md-12">

					<h3>{{ $vars['total_cars'] }} Used electric cars in total</h3>
					<p>Page {{ $vars['page'] }} displaying {{ $vars['total_page_total'] }} of {{ $vars['total_cars_found'] }} filtered.</p>

				</div>

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

				@foreach($vars['cars'] as $collection)

					@foreach($collection as $car)

						<div class="col-sm-6 col-md-4">

							@include('partials.card', ['car' => $car])

						</div>

					@endforeach

					<div class="col-sm-12 col-md-12 text-center">

						@include('partials.advert')

					</div>

				@endforeach

				<div class="row">

					<div class="col-sm-12 text-center">

						{!! $vars['cars_collection']->links() !!}

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection

@section('footer')
<script type="text/javascript">
$('document').ready(function(){
	$('#make').on('change', function() {

		var models = $.get({
			'url': '/makes/'+$(this).val()+'/models',
			'success': function(data) {
				$html = '<label for="model">Model</label><select name="model" id="model" class="form-control"><option value="">All</option>';
				for(var i=0;i<data.length;i++) {
					$html = $html + '<option value="'+data[i].id+'">'+data[i].name+'</option>'
				}
				$html = $html + '</select>';
				$('#model-container').html($html);
			},
		});
	});
});
</script>
@endsection