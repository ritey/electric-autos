@extends('layouts.admin')

@section('page_title')
Makes - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
@endsection

@section('metas')

@endsection

@section('content')

<section class="">

	<div class="container mx-auto">

		<div class="row">

			<div class="col-sm-8">

				<ul class="breadcrumb">
					<li><a href="{{ route('admin.home') }}">Admin home</a></li>
					<li class="active">Makes</li>
				</ul>

				<p class="text-right"><a class="btn btn-sm btn-default" href="{{ route('admin.makes.create') }}">Add</a></p>

				@if ($vars['makes']->count())

				<table class="table table-bordered table-hover table-responsive">

					<tr>

						<th></th>
						<th>Name</th>
						<th>Created on</th>
						<th></th>

					</tr>

					@foreach($vars['makes'] as $item)

						@if ($vars['makes']->currentPage() > 1)
							$loop->iteration = $loop->iteration + ($vars['makes']->currentPage()  * $vars['makes']->perPage())
						@endif

					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item['name'] }}</td>
						<td class="text-center text-middle">{{ $item['created_at']->format('d-m-Y H:i') }}</td>
						<td class="text-center text-middle"><a href="{{ route('admin.makes.edit', ['id' => $item['id']]) }}">Edit</a></td>
					</tr>

					@endforeach

				</table>

				@endif

				@if (!empty($vars['makes']))

				<div class="text-center">

					{!! $vars['makes']->links() !!}

				</div>

				@endif

			</div>

			<div class="col-sm-4">

			</div>

		</div>

	</div>

</section>

@endsection