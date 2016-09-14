@if ($user->user_type_id == 1 )

<section class="promo">

	<h4>Are you a business?</h4>

	<p>Upgrade now to a dealer account, it's quick and easy!</p>
	<p class="text-center"><a href="{{ route('upgrade') }}" class="btn btn-success">Upgrade account</a></p>

</section>

@endif
