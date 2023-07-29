@if ($user->user_type_id == 1 )

<section class="promo">

	<h4>Are you a business?</h4>

	<p>Upgrade now to a dealer account, it's quick and easy!</p>
	<p class="text-center"><a href="{{ route('upgrade') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">Upgrade account</a></p>

</section>

@endif
