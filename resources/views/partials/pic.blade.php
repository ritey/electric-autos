<div class="col-sm-4">

	<img src="{{ route('image') }}?user_id={{ $pic->user_id }}&folder={{ $pic->folder }}&filename={{ urlencode($pic->maskname . '.' . $pic->extension) }}&width=200&height=150" alt="{{ $pic->filename }}">

</div>
