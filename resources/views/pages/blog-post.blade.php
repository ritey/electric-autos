@extends('layouts.master')

@section('page_title')
Electric Autos Blog
@endsection

@section('metas')
<meta name="description" value="Electric Autos Blog" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Electric Autos Blog" />
<meta name="og:title" value="Electric Autos Blog" />
<meta name="twitter:description" value="Electric Autos Blog" />
<meta name="twitter:title" value="Electric Autos Blog" />
<meta name="twitter:creator" value="@electricautosuk" />
@endsection

@section('title')
{{ $vars['article']->name }}
@endsection

@section('content')

<section class="">

	<div class="container mx-auto">

		<div class="row">

			<div class="col-sm-12">

				<div class="addon-header">
					<h2>{{ $vars['article']->name }}</h2>
				</div>

				<div class="row">

				      <!-- Blog Block -->
				      <section class="inner-section">

				         <div class="container-fluid nopadding">

				            <img src="{{ $vars['article']->image or '/images/bolt-logo-128x128.png' }}" alt="Electric Autos Blog Post Image" class="img-responsive wow fadeInDown" data-wow-delay="0.6s" data-wow-offset="10">

				            <article class="post wow fadeInDown" data-wow-delay="0.6s" data-wow-offset="10">

				               <div class="dividewhite6"></div>

				               {!! $vars['article']->body !!}

				               <div class="dividewhite4"></div>
				               <hr>

				            </article>

				         </div>
				         <div class="dividewhite8"></div>

				      </section>
				      <!-- /Blog Block -->

				</div>

			</div>

		</div>

	</div>

</section>

</section>


@endsection