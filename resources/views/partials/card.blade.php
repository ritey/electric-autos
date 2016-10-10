<div class="item">
	<figure>
		<a href="{{ route('cars.brand.car', ['brand' => strtolower(str_replace(' ','+',$car->make()->first()->name)), 'version' => str_replace(' ','+',strtolower($car->model()->first()->name)), 'slug' => $car->slug]) }}">
		@if (is_object($car) && $car->images()->count())
		<img src="{{ route('image') }}?id={{ $car->images()->first()->user_id }}&folder={{ $car->id }}&filename={{ urlencode($car->images()->first()->maskname . '.' . $car->images()->first()->extension) }}&width=370&height=300" alt="">
		@else
		<img src="/images/holder.png" alt="">
		@endif
		</a>
	</figure>
	<div class="item-header">
		<h3><a href="{{ route('cars.brand.car', ['brand' => str_replace(' ','+',strtolower($car->make()->first()->name)), 'version' => str_replace(' ','+',strtolower($car->model()->first()->name)),  'slug' => $car->slug]) }}">{{ $car->name or 'Car' }}</a></h3>
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge">{{ $car->make()->first()->name or 'Make' }}</span>
				Make
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->model()->first()->name or 'Model' }}</span>
				Model
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->year or 'Year' }}</span>
				Year
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->currency == 'Pound' ? '&pound;' : '' }}{{ $car->currency == 'Euro' ? '&euro;' : '' }}{{ $car->price or 'Price' }}</span>
				Price
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->mileage or 'Mileage' }} {{ strtolower($car->length_measure) }}</span>
				Mileage
			</li>
			<li class="list-group-item">
				<span class="badge">
					@if(!$car->dealer)
						Private
					@else
						<a href="{{ route('dealers.dealer', $car->dealer->slug) }}">Trade</a>
					@endif
				</span>
				Seller type
			</li>
		</ul>
	</div>
	<div class="item-meta clearfix">
		<a href="#">Report this advert</a>
	</div>

</div>