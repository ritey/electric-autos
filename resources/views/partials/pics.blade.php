<section class="promo">

	<h4>Manage pics</h4>

	<ul>
		<li><strong>Pics:</strong> {{ $pics->count() }}</li>
		<li><strong>Pics used:</strong>  {{ $pics->count() }}</li>
	</ul>

	<p class="text-center"><a href="{{ route('pic.index') }}" class="btn btn-primary">Pic Gallery</a></p>

</section>