<section class="promo">

	<h4>Quick info</h4>

	<ul>
		<li><strong>Ads:</strong> {{ $ads->count() }}</li>
		<li><strong>Ads enabled:</strong> {{ $ads->where('enabled',1)->count() }}</strong></li>
		<li><strong>Vehicles sold:</strong> {{ $ads->where('sold',1)->count() }}</strong></li>
	</ul>

</section>