@extends('layouts.admin')

@section('page_title')
Ads - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
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
					<li class="active">Ads</li>
				</ul>

				@if ($vars['ads']->count())

				<table class="table table-bordered table-hover table-responsive">

					<tr>

						<th></th>
						<th>Name</th>
						<th>Created on</th>
						<th>Enabled</th>
						<th>Sold</th>
						<th>Pics</th>
						<th></th>

					</tr>

					@foreach($vars['ads'] as $item)

					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item['name'] }}</td>
						<td class="text-center text-middle">{{ $item['created_at']->format('d-m-Y H:i') }}</td>
						<td class="text-center text-middle">{{ $item['enabled']  == 1 ? 'Yes' : 'No' }}</td>
						<td class="text-center text-middle">{{ $item['sold']  == 1 ? 'Yes' : 'No' }}</td>
						<td class="text-center text-middle"><a href="#"><i class="fa fa-camera"></i></a></td>
						<td class="text-center text-middle"><a href="{{ route('admin.ads.edit', ['id' => $item['id']]) }}">Edit</a></td>
					</tr>

					@endforeach

				</table>

				@endif

				@if (!empty($vars['ads']))

				<div class="text-center">

					{!! $vars['ads']->links() !!}

				</div>

				@endif

			</div>

			<div class="col-sm-4">

			</div>

		</div>

	</div>

</section>

@endsection