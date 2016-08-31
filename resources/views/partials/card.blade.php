<div class="item">
	<figure>
		<a href="{{ route('cars.brand.car', ['brand' => strtolower($car->make()->first()->name), 'model' => strtolower($car->model()->first()->name), 'slug' => $car->slug]) }}">
		@if (is_object($car) && $car->images())
		<img src="{{ route('image') }}?folder={{ $car->id }}&filename={{ urlencode($car->images()->first()->maskname . '.' . $car->images()->first()->extension) }}&width=370&height=300" alt="">
		@else
		<img src="/images/holder.png" alt="">
		@endif
		</a>
	</figure>
	<div class="item-header">
		<h3><a href="{{ route('cars.brand.car', ['brand' => strtolower($car->make()->first()->name), 'model' => strtolower($car->model()->first()->name),  'slug' => $car->slug]) }}">{{ $car->name or 'Car' }}</a></h3>
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
				<span class="badge">{{ $car->price or 'Price' }}</span>
				Price
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->mileage or 'Mileage' }}</span>
				Mileage
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car->private == 1 ? 'Private' : 'Trade' }}</span>
				Seller type
			</li>
		</ul>
	</div>
	<div class="item-meta clearfix">
		<a href="#">Report this advert</a>
	</div>

</div>