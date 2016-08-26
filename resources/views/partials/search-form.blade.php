<form method="get" action="" class="">
	<div class="form-group">
		<label for="make">Make</label>
		<select name="make" id="make" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="model">Model</label>
		<select name="model" id="model" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="min_price">Price (min)</label>
		<select name="min_price" id="min_price" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="max_price">Price (max)</label>
		<select name="max_price" id="max_price" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="min_mileage">Mileage (min)</label>
		<select name="min_mileage" id="min_mileage" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="max_mileage">Mileage (max)</label>
		<select name="max_mileage" id="max_mileage" class="form-control">
			<option value=""></option>
		</select>
	</div>
	<div class="form-group">
		<label for="min_year">Year (from)</label>
		<select name="min_year" id="min_year" class="form-control">
			@for ($i = date('Y'); $i > (date('Y')-10); $i--)
			<option value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
	</div>
	<div class="form-group">
		<label for="max_year">Year (to)</label>
		<select name="max_year" id="max_year" class="form-control">
			@for ($i = date('Y'); $i > (date('Y')-10); $i--)
			<option value="{{ $i }}">{{ $i }}</option>
			@endfor
		</select>
	</div>
	<div class="form-group text-center">
		<a href="{{ route('cars.index') }}" class="btn btn-default">Clear filters</a>
		<button type="submit" class="btn btn-success">View results</button>
	</div>
</form>