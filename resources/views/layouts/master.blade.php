<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('page_title','Electric Autos | Used Electric Cars For Sale | Second hand electric cars')</title>
	@yield('metas')

	<noscript id="deferred-styles">
    <link rel="stylesheet" href="{{ elixir("css/app.css") }}">
    </noscript>
	<link rel="icon" href="/images/bolt-logo-64x64.png">

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-418381-31', 'auto');
	  ga('send', 'pageview');

	</script>
</head>
<body>

	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ route('home') }}"><img src="/images/text-logo-400x50.png" alt="Electric Autos" height="20"></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="{{ active_class(if_uri_pattern(['cars','cars/*']), 'active') }}"><a href="{{ route('cars.index') }}">Autos</a></li>
                    @if (Auth::guest())
					<li class="{{ active_class(if_uri_pattern(['start-selling','start-selling/*']), 'active') }}"><a href="{{ route('start-selling') }}">Sell</a></li>
					@else
					<li class="{{ active_class(if_uri_pattern(['start-selling','start-selling/*']), 'active') }}"><a href="{{ route('ad.create') }}">Sell</a></li>
					@endif
					<li class="{{ active_class(if_uri(['about','contact']), 'active') }} dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Help <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="{{ active_class(if_uri(['about']), 'active') }}"><a href="{{ route('about') }}">About us</a></li>
							<li class="{{ active_class(if_uri(['contact']), 'active') }}"><a href="{{ route('contact') }}">Contact us</a></li>
							<!-- <li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li class="dropdown-header">Nav header</li>
							<li><a href="#">Separated link</a></li>
							<li><a href="#">One more separated link</a></li> -->
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
					<li><a href="{{ route('register') }}">Create an account</a></li>
					<li><a href="{{ route('login') }}">Login</a></li>
					@else
					<li><a href="{{ route('dashboard') }}">Dashboard</a></li>
					<li>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">Logout</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST">
                            {{ csrf_field() }}
                        </form>

					</li>
					@endif
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	@include('partials.section-title')

	@include('partials.message',['success_message' => $success_message])

	@yield('content')

	<section id="social-links" class="">

		<div class="container">

			<div class="row">

				<div class="col-sm-12 col-md-12 text-center">

					<div class="row">

						<div class="col-sm-6 col-md-6">

							<a class="social-icon" href="https://www.facebook.com/Electric-Autos-1767600990124746/" target="_blank"><i class="fa fa-facebook"></i> <span>{{ $likes }}</span> <small>{{ str_plural('Like', $likes) }}</small></a>

						</div>

						<div class="col-sm-6 col-md-6">

							<a class="social-icon" href="http://www.twitter.com/electricautosuk" target="_blank"><i class="fa fa-twitter"></i> <span>{{ $followers }}</span> <small>{{ str_plural('Follower', $followers) }}</small></a>

						</div>

					</div>

				</div>

			</div>

		</div>

	</section>

	<section id="bottom-menu" class="">

		<div class="container">

			<div class="row">

				<div class="col-sm-6 col-md-2">

					<h4>Useful</h4>

					<ul class="list-unstyled">
						<li><a href="{{ route('terms') }}">Terms &amp; Conditions</a></li>
						<li><a href="{{ route('privacy') }}">Privacy Policy</a></li>
						<li><a href="{{ route('cookie') }}">Cookie Policy</a></li>
						<li><a href="{{ route('seller-faqs') }}">Sellers FAQ</a></li>
					</ul>

				</div>

				<div class="col-sm-6 col-md-2">

					<h4>Connect</h4>

					<ul class="list-unstyled">
						<li><a href="{{ route('about') }}">About</a></li>
						<li><a href="{{ route('start-selling') }}">Start selling</a></li>
						<li><a href="{{ route('blog.index') }}">Blog</a></li>
					</ul>

				</div>

			</div>

		</div>

	</section>

	<section id="footer" class="">

		<div class="container">

			<div class="row">

				<div class="col-sm-6 col-md-6">

					<p>&copy; {{ date('Y') }} Electric Autos. Site maintained by <a href="http://www.coderstudios.com" target="_blank">Coder Studios</a></p>

				</div>

				<div class="col-sm-6 col-md-6">

				</div>

			</div>

		</div>

	</section>

	<script src="{{ elixir("js/app.js") }}" type="text/javascript"></script>
	<script async src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script async src="https://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

    <script>
      var loadDeferredStyles = function() {
        var addStylesNode = document.getElementById("deferred-styles");
        var replacement = document.createElement("div");
        replacement.innerHTML = addStylesNode.textContent;
        document.body.appendChild(replacement)
        addStylesNode.parentElement.removeChild(addStylesNode);
      };
      var raf = requestAnimationFrame || mozRequestAnimationFrame ||
          webkitRequestAnimationFrame || msRequestAnimationFrame;
      if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
      else window.addEventListener('load', loadDeferredStyles);
    </script>

@yield('footer')
</body>
</html>