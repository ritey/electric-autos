<div class="item">
	<figure>
		<a href="{{ $car['ad_slug'] }}">
		@if ($car['image_count'])
		<img src="{{ $car['img_url'] }}" alt="">
		@else
		<img src="/images/holder.png" alt="">
		@endif
		</a>
	</figure>
	<div class="item-header">
		<h3><a href="{{ $car['ad_slug'] }}">{{ $car['name'] or 'Car' }}</a></h3>
		<ul class="list-group">
			<li class="list-group-item">
				<span class="badge">{{ $car['make'] or 'Make' }}</span>
				Make
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car['model'] or 'Model' }}</span>
				Model
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car['year'] or 'Year' }}</span>
				Year
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car['currency'] == 'Pound' ? '&pound;' : '' }}{{ $car['currency'] == 'Euro' ? '&euro;' : '' }}{{ $car['price'] or 'Price' }}</span>
				Price
			</li>
			<li class="list-group-item">
				<span class="badge">{{ $car['mileage'] or 'Mileage' }} {{ $car['mileage_measure'] }}</span>
				Mileage
			</li>
			<li class="list-group-item">
				<span class="badge">
					@if($car['private'])
						Private
					@else
						<a href="{{ $car['dealer_url'] }}">Trade</a>
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