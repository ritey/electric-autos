@extends('layouts.master')

@section('page_title')
Contact Electric Autos
@endsection

@section('metas')
<meta name="description" value="Contact Electric Autos" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Contact Electric Autos" />
<meta name="og:title" value="Contact Electric Autos" />
<meta name="twitter:description" value="Contact Electric Autos" />
<meta name="twitter:title" value="Contact Electric Autos" />
<meta name="twitter:creator" value="@electricautosuk" />
@endsection

@section('title')
Contact us
@endsection

@section('content')

<section class="section-pad">

	<div class="container mx-auto">

		<div class="row">

			<div id="map3" class="height-300 margin-bottom-60"></div>

			<div class="row">

				<!-- FORM -->
				<div class="col-md-9 col-sm-9">

					<h3>Drop us a line or just say <strong><em>Hello!</em></strong></h3>

					<p><strong>Thank you for time, we'll be in touch soon.</strong></p>

				</div>
				<!-- /FORM -->


				<!-- INFO -->
				<div class="col-md-3 col-sm-3">

					<h2>Contact Us</h2>

					<p>
						Use the form to send us an email, or the details below to call, tweet or good old fashioned mail. We're also on Facebook if you prefer to message us.
					</p>

					<hr />

					<p>
						<span class="block"><strong><i class="fa fa-map-marker"></i> Address:</strong> 224 Almners Road, Lyne, Surrey KT16 0BL UK</span>
						<span class="block"><strong><i class="fa fa-phone"></i> Phone:</strong> <a href="tel:+447841206889">+44 7841 206 889</a></span>
						<span class="block"><strong><i class="fa fa-envelope"></i> Email:</strong> <a href="mailto:hello@electric-autos.co.uk">hello@electric-autos.co.uk</a></span>
						<span class="block"><strong><i class="fa fa-twitter"></i> Twitter:</strong> <a href="https://twitter.com/electricautosuk">@electricautosuk</a></span>
						<span class="block"><strong><i class="fa fa-facebook"></i> Facebook:</strong> <a href="https://www.facebook.com/Electric-Autos-1767600990124746/">Electric Autos</a></span>
					</p>

					<hr />

					<h4>Business Hours</h4>
					<p>
						<span class="block"><strong>Monday - Friday:</strong> 9am to 5pm</span>
						<span class="block"><strong>Saturday:</strong> Closed</span>
						<span class="block"><strong>Sunday:</strong> Closed</span>
					</p>

				</div>
				<!-- /INFO -->

			</div>

		</div>

	</div>

</section>

@endsection

@section('footer')

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="/assets/js/vendor/gmaps.js"></script>
		<script type="text/javascript">

			jQuery(document).ready(function(){

				map3 = new GMaps({
					div: '#map3',
					lat: 51.386108,
					lng:  -0.542447
				});

				// Marker 2
				map3.addMarker({
					lat: 51.386108,
					lng: -0.542447,
					title: 'Electric Autos',
					infoWindow: {
						content: '<p>Hello from Electric Autos</p>'
					}
				});

			});

		</script>

@endsection