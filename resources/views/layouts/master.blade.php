<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('page_title','Electric Autos | Used Electric Cars For Sale | Second hand electric cars')</title>
	@yield('metas')

	<link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="/css/app.css">

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
				<a class="navbar-brand" href="{{ route('home') }}">Electric Autos</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="{{ active_class(if_uri(['/']), 'active') }}"><a href="{{ route('home') }}">Home</a></li>
					<li class="{{ active_class(if_uri_pattern(['cars','cars/*']), 'active') }}"><a href="{{ route('cars.index') }}">Autos</a></li>
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
					<li><a href="">Create an account</a></li>
					<li><a href="">Login</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>

	@yield('content')

	<section id="social-links" class="">

		<div class="container">

			<div class="row">

				<div class="col-sm-12 col-md-12 text-center">

					<div class="row">

						<div class="col-sm-6 col-md-6">

							<a class="social-icon" href="https://www.facebook.com/Electric-Autos-1767600990124746/" target="_blank"><i class="fa fa-facebook"></i> <span>2</span> <small>Likes</small></a>

						</div>

						<div class="col-sm-6 col-md-6">

							<a class="social-icon" href="http://www.twitter.com/electricautosuk" target="_blank"><i class="fa fa-twitter"></i> <span>2</span> <small>Followers</small></a>

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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>

@yield('footer')
</body>
</html>