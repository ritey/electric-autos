<div class="col-sm-4">

	<img src="{{ route('image') }}?user_id={{ $pic->user_id }}&folder={{ $pic->folder }}&filename={{ urlencode($pic->maskname . '.' . $pic->extension) }}&width=200&height=150" alt="{{ $pic->filename }}">

	@if ($ad)
	<p class="clearfix"><a class="confirm" href="{{ route('pic.ad.delete', ['ad' => $ad, 'id' => $pic->id]) }}">Delete</a></p>
	@else
	<p class="clearfix"><a class="confirm" href="{{ route('pic.delete', ['id' => $pic->id]) }}">Delete</a></p>
	@endif

</div>