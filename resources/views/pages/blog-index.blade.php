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
@endsection

@section('content')

@include('partials.section-title', ['title' => 'Blog'])

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<div class="addon-header">
					<h2>Featured electric and hybrid cars for sale</h2>
				</div>

				<div class="row">

					@foreach($vars['articles'] as $article)

						<div class="col-sm-6 col-md-4">

                           @if ($article->images()->count())
                           <img src="{{ '/image.png?width=357&height=267&filename=' . $article->images->first()->maskname . '.' . $article->images->first()->extension . '&folder=' . $article->images->first()->folder }}" class="img-responsive" alt="Electric Autos Blog Post" />
                           @else
                           <img src="/images/holder.png" class="img-responsive" alt="Electric Autos">
                           @endif
                           <figcaption>
                              <div class="post-meta"><span>by {{ $article->meta_author }},</span> <span>{{ $article->live_at->format('d-m-Y') }}</span></div>
                              <div class="post-header">
                                 <h5><a href="{{ route('blog.post', ['slug' => $article->slug]) }}">{{ $article->name }}</a></h5>
                              </div>
                              <div class="post-entry">
                                 <p>{{ $article->summary }}</p>
                              </div>
                              <!-- <div class="post-tag pull-left">
                                 <span><a href="#branding" data-filter=".branding">Branding</a>,</span><span><a href="#design" data-filter=".design">Design</a></span>
                              </div> -->
                              <div class="post-more-link pull-right"><a href="{{ route('blog.post', ['slug' => $article->slug]) }}">More<i class="fa fa-long-arrow-right right"></i></a></div>
                           </figcaption>

						</div>

					@endforeach

				</div>

			</div>

		</div>

	</div>

</section>

@endsection