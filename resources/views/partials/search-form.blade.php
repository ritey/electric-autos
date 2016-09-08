<form method="GET" action="{{ $vars['search_route'] }}" class="form">
	<div class="form-group">
		<label for="make">Make</label>
		<select name="make" id="make" class="form-control">
			<option value="">All</option>
			@foreach($vars['makes'] as $make)
				@if (isset($vars['brand']) && !empty($vars['brand']) && $vars['brand']->name == $make->name)
					<option selected value="{{ $make->id }}">{{ $make->name }}</option>
				@elseif ($make->id == $vars['request']->input('make'))
					<option selected value="{{ $make->id }}">{{ $make->name }}</option>
				@else
					<option value="{{ $make->id }}">{{ $make->name }}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="form-group">
		<label for="model">Model</label>
		<select name="model" id="model" class="form-control">
			<option value="">All</option>
			@if(!empty($vars['models']))
			@foreach($vars['models'] as $item)
				@if (isset($vars['model']) && is_object($vars['model']) && $vars['model']->name == $item->name)
					<option selected value="{{ $item->id }}">{{ $item->name }}</option>
				@elseif ($item->id == $vars['request']->input('model'))
					<option selected value="{{ $item->id }}">{{ $item->name }}</option>
				@else
					<option value="{{ $item->id }}">{{ $item->name }}</option>
				@endif
			@endforeach
			@endif
		</select>
	</div>
	<div class="form-group">
		<label for="min_price">Price (min)</label>
		<select name="min_price" id="min_price" class="form-control">
			<option value="">Price (min)</option>
			<option value="500">&pound;500</option>
			@for($i=1000;$i<=20000;$i+=1000)
			@if ($i == $vars['request']->input('min_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@for($i=25000;$i<=150000;$i+=5000)
			@if ($i == $vars['request']->input('min_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@for($i=175000;$i<=500000;$i+=25000)
			@if ($i == $vars['request']->input('min_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@if ('1000000' == $vars['request']->input('min_price'))
			<option selected value="1000000">&pound;1000000</option>
			@else
			<option value="1000000">&pound;1000000</option>
			@endif
		</select>
	</div>
	<div class="form-group">
		<label for="max_price">Price (max)</label>
		<select name="max_price" id="max_price" class="form-control">
			<option value="">Price (max)</option>
			<option value="500">&pound;500</option>
			@for($i=1000;$i<=20000;$i+=1000)
			@if ($i == $vars['request']->input('max_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@for($i=25000;$i<=150000;$i+=5000)
			@if ($i == $vars['request']->input('max_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@for($i=175000;$i<=500000;$i+=25000)
			@if ($i == $vars['request']->input('max_price'))
			<option value="{{ $i }}" selected>&pound;{{ $i }}</option>
			@else
			<option value="{{ $i }}">&pound;{{ $i }}</option>
			@endif
			@endfor
			@if ('1000000' == $vars['request']->input('max_price'))
			<option selected value="1000000">&pound;1000000</option>
			@else
			<option value="1000000">&pound;1000000</option>
			@endif
		</select>
	</div>
	<div class="form-group">
		<label for="min_mileage">Mileage (min)</label>
		<select name="min_mileage" id="min_mileage" class="form-control">
			<option value="">Mileage (min)</option>
			<option value="500">500</option>
			@for($i=1000;$i<=20000;$i+=1000)
			@if ($i == $vars['request']->input('min_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
			@for($i=25000;$i<=100000;$i+=5000)
			@if ($i == $vars['request']->input('min_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
			@for($i=125000;$i<=175000;$i+=25000)
			@if ($i == $vars['request']->input('min_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
		</select>
	</div>
	<div class="form-group">
		<label for="max_mileage">Mileage (max)</label>
		<select name="max_mileage" id="max_mileage" class="form-control">
			<option value="">Mileage (max)</option>
			<option value="500">500</option>
			@for($i=1000;$i<=20000;$i+=1000)
			@if ($i == $vars['request']->input('max_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
			@for($i=25000;$i<=100000;$i+=5000)
			@if ($i == $vars['request']->input('max_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
			@for($i=125000;$i<=175000;$i+=25000)
			@if ($i == $vars['request']->input('max_mileage'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
		</select>
	</div>
	<div class="form-group">
		<label for="min_year">Year (from)</label>
		<select name="min_year" id="min_year" class="form-control">
			<option value="">Year (from)</option>
			@for ($i = date('Y'); $i > (date('Y')-10); $i--)
			@if ($i == $vars['request']->input('min_year'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
		</select>
	</div>
	<div class="form-group">
		<label for="max_year">Year (to)</label>
		<select name="max_year" id="max_year" class="form-control">
			<option value="">Year (to)</option>
			@for ($i = date('Y'); $i > (date('Y')-10); $i--)
			@if ($i == $vars['request']->input('max_year'))
			<option value="{{ $i }}" selected>{{ $i }}</option>
			@else
			<option value="{{ $i }}">{{ $i }}</option>
			@endif
			@endfor
		</select>
	</div>
	<div class="form-group text-center">
		<a href="{{ route('cars.index') }}" class="btn btn-default">Clear filters</a>
		<button type="submit" class="btn btn-success">View results</button>
	</div>
</form>