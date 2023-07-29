<div class="col-sm-4">

	<img src="{{ $img_url }}" alt="{{ $img_alt }}">
	<p><input type="text" value="{{ $img_filename or '' }}"></p>
	<p><input type="text" value="/image.png?filename={{ $img_filename or '' }}&folder=site"></p>

	<p class="clearfix"><a class="confirm" href="{{ $delete_url }}">Delete</a></p>

</div>