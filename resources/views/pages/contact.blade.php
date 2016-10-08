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

	<div class="container">

		<div class="row">

			<div id="map3" class="height-300 margin-bottom-60"></div>

			<div class="row">

				<!-- FORM -->
				<div class="col-md-9 col-sm-9">

					<h3>Drop us a line or just say <strong><em>Hello!</em></strong></h3>

					@if ($errors->any())
						<div id="errors" class="alert alert-danger margin-bottom-30">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				            </ul>
						</div>
					@endif


					<form action="{{ route('contact.send') }}" method="POST" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<fieldset>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label for="contact:name">Full Name *</label>
										<input required type="text" class="form-control" name="contact[name]" value="{{ old('contact[name]') }}" id="contact:name">
									</div>
									<div class="col-md-4">
										<label for="contact:email">E-mail Address *</label>
										<input required type="email" value="{{ old('contact[email]') }}" class="form-control" autocomplete="false" name="contact[email]" id="contact:email">
									</div>
									<div class="col-md-4">
										<label for="contact:phone">Phone</label>
										<input type="text" value="{{ old('contact[phone]') }}" class="form-control" name="contact[phone]" id="contact:phone">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-8">
										<label for="contact:subject">Subject *</label>
										<input required type="text" value="{{ old('contact[subject]') }}" class="form-control" name="contact[subject]" id="contact:subject">
									</div>
									<div class="col-md-4">
										<label for="contact_department">Department</label>
										<select class="form-control pointer" name="contact[department]">
											<option value="">--- Select ---</option>
											<option value="Accounts">Accounts</option>
											<option value="General">General</option>
											<option value="Support">Support</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label for="contact:message">Message *</label>
										<textarea required maxlength="10000" rows="8" class="form-control" name="contact[message]" id="contact:message"></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										<label for="contact:attachment">File Attachment</label>

										<!-- custom file upload -->
										<input class="custom-file-upload" type="file" name="contact[attachment]" id="contact:attachment" data-btn-text="Select a File" />
										<small class="text-muted block">Max file size: 10Mb (zip/pdf/jpg/png)</small>

									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-12">
										{!! Recaptcha::render() !!}
									</div>
								</div>
							</div>

						</fieldset>

						<div class="row">
							<div class="col-md-12">
								<button type="submit" id="sendmessage" class="btn btn-primary"><i class="fa fa-check"></i> SEND MESSAGE</button>
							</div>
						</div>
					</form>

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

		<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBv3I0Nfk5ttFMFulcZp3fn1bWMCwby7sc"></script>
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