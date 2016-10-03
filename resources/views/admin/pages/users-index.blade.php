@extends('layouts.admin')

@section('page_title')
Users - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
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
					<li class="active">Users</li>
				</ul>

				@if ($vars['users']->count())

				<table class="table table-bordered table-hover table-responsive">

					<tr>

						<th></th>
						<th>Name</th>
						<th>Email</th>
						<th>Dealer</th>
						<th>Created on</th>
						<th></th>

					</tr>

					@foreach($vars['users'] as $item)

					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item['name'] }}</td>
						<td>{{ $item['email'] }}</td>
						<td></td>
						<td class="text-center text-middle">{{ $item['created_at']->format('d-m-Y H:i') }}</td>
						<td class="text-center text-middle"><a href="{{ route('admin.users.edit', ['id' => $item['id']]) }}">Edit</a></td>
					</tr>

					@endforeach

				</table>

				@endif

				@if (!empty($vars['users']))

				<div class="text-center">

					{!! $vars['users']->links() !!}

				</div>

				@endif

			</div>

			<div class="col-sm-4">

			</div>

		</div>

	</div>

</section>

@endsection