@extends('layouts.master')

@section('page_title')
Dashboard
@endsection

@section('metas')
<meta name="description" value="Cookie Policy for using the Electric Autos website" />
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

						<table class="table table-bordered table-hover table-responsive">

							<tr>

								<th></th>
								<th>Name</th>
								<th>Created on</th>
								<th>Enabled</th>
								<th>Sold</th>
								<th></th>

							</tr>

							@if (!empty($vars['ads']))

							@foreach($vars['ads'] as $item)

							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $item['name'] }}</td>
								<td>{{ $item['created_at']->format('d-m-Y H:i') }}</td>
								<td>{{ $item['enabled']  == 1 ? 'Yes' : 'No' }}</td>
								<td>{{ $item['sold']  == 1 ? 'Yes' : 'No' }}</td>
								<td><a href="{{ route('ad.edit',['slug' => $item->slug]) }}">Edit</a></td>
							</tr>

							@endforeach

							@else

							<tr>
								<td colspan="6">No ads, create one</td>
							</tr>

							@endif

						</table>

						@if (!empty($vars['ads']))

						<div class="text-center">

							{!! $vars['ads']->links() !!}

						</div>

						@endif


					</div>

					<div class="col-sm-4">

						@if ($vars['user']->user_type_id == 1 )

						<section class="promo">

							<h4>Are you a business?</h4>

							<p>Upgrade now to a dealer account, it's quick and easy!</p>
							<a href="{{ route('upgrade') }}" class="btn btn-success">Upgrade account</a>

						</section>

						@endif

						@include('partials.stats', ['ads' => $vars['all_ads']])

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

@endsection