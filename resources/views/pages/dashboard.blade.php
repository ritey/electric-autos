@extends('layouts.master')

@section('page_title')
Dashboard
@endsection

@section('metas')
<meta name="description" value="Your dashboard" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
@endsection

@section('title')
{{ 'Hello ' . $vars['user']->name }}
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="row">

					<div class="col-sm-8">

						<ul class="breadcrumb">
							<li class="active">Dashboard</li>
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
								<td class="text-center text-middle"><a href="{{ route('pic.ad.index', ['ad' => $item['id']]) }}"><i class="fa fa-camera"></i></a></td>
								<td class="text-center text-middle"><a href="{{ route('ad.edit',['slug' => $item->slug]) }}">Edit</a></td>
							</tr>

							@endforeach

						</table>

						@else

						<p><strong>You don't have any ads yet, why not <a href="{{ route('ad.create') }}">create</a> your first ad.</strong></p>

						@endif

						@if (!empty($vars['ads']))

						<div class="text-center">

							{!! $vars['ads']->links() !!}

						</div>

						@endif


					</div>

					<div class="col-sm-4">

						@if (!$vars['user']->subscribed('Dealer Plan'))

						@include('partials.upgrade', ['user' => $vars['user']])

						@else

						@include('partials.dealer-button')

						@endif

						@include('partials.stats', ['ads' => $vars['all_ads']])

						@include('partials.pics', ['pics' => $vars['all_pics']])

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection