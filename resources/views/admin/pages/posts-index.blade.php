@extends('layouts.admin')

@section('page_title')
Posts - Electric Autos | Used Hybrid and Electric Cars For Sale | Second hand electric cars | Second hand hybrid Cars
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
					<li class="active">Posts</li>
				</ul>

				<p class="text-right"><a class="btn btn-default btn-sm" href="{{ route('admin.posts.create') }}">New</a></p>

				@if ($vars['posts']->count())

				<table class="table table-bordered table-hover table-responsive">

					<tr>

						<th></th>
						<th>Name</th>
						<th>Created on</th>
						<th>Enabled</th>
						<th>Pics</th>
						<th></th>

					</tr>

					@foreach($vars['posts'] as $item)

					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item['name'] }}</td>
						<td class="text-center text-middle">{{ $item['created_at']->format('d-m-Y H:i') }}</td>
						<td class="text-center text-middle">{{ $item['enabled']  == 1 ? 'Yes' : 'No' }}</td>
						<td class="text-center text-middle"><a href="{{ route('admin.pic.ad.index', ['article' => $item['id'] ]) }}"><i class="fa fa-camera"></i></a></td>
						<td class="text-center text-middle"><a href="{{ route('admin.posts.edit', ['id' => $item['id']]) }}">Edit</a></td>
					</tr>

					@endforeach

				</table>

				@endif

				@if (!empty($vars['posts']))

				<div class="text-center">

					{!! $vars['posts']->links() !!}

				</div>

				@endif

			</div>

			<div class="col-sm-4">

			</div>

		</div>

	</div>

</section>

@endsection