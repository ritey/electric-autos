@extends('layouts.admin')

@section('page_title')
Models - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')

@endsection

@section('content')

<section class="">

	<div class="container">

		<div class="row">

			<div class="col-sm-8">

				<ul class="breadcrumb">
					<li><a href="{{ route('admin.home') }}">Admin home</a></li>
					<li class="active">Models</li>
				</ul>

				<p class="text-right"><a class="btn btn-sm btn-default" href="{{ route('admin.models.create') }}">Add</a></p>

				@if ($vars['models']->count())

				<table class="table table-bordered table-hover table-responsive">

					<tr>

						<th></th>
						<th>Make</th>
						<th>Name</th>
						<th>Created on</th>
						<th></th>

					</tr>

					@foreach($vars['models'] as $item)

					<tr>
						<td>
							@if ($vars['models']->currentPage() > 1)
							 {{ $loop->iteration = $loop->iteration + (($vars['models']->currentPage()-1)  * $vars['models']->perPage()) }}
							@else
							{{ $loop->iteration }}
							@endif
						</td>
						<td>{{ $item->make->name }}</td>
						<td>{{ $item['name'] }}</td>
						<td class="text-center text-middle">{{ $item['created_at']->format('d-m-Y H:i') }}</td>
						<td class="text-center text-middle"><a href="{{ route('admin.models.edit', ['id' => $item['id']]) }}">Edit</a></td>
					</tr>

					@endforeach

				</table>

				@endif

				@if (!empty($vars['models']))

				<div class="text-center">

					{!! $vars['models']->links() !!}

				</div>

				@endif

			</div>

			<div class="col-sm-4">

			</div>

		</div>

	</div>

</section>

@endsection