@extends('layouts.master')

@section('page_title')
Electric Autos Seller FAQs
@endsection

@section('metas')
<meta name="description" value="Electric Autos Seller FAQs" />
<meta name="keywords" value="electric,autos,cars,sale,used,hybrid" />
<meta name="og:description" value="Electric Autos Seller FAQs" />
<meta name="og:title" value="Electric Autos Seller FAQs" />
<meta name="twitter:description" value="Electric Autos Seller FAQs" />
<meta name="twitter:title" value="Electric Autos Seller FAQs" />
@endsection

@section('title')
Seller FAQs
@endsection

@section('content')

<section class="section-pad">

	<div class="container">

		<div class="row">

			<div class="col-sm-12">

				<p class="lead">Our most frequently asked questions about using Electric Autos:</p>

				<ul>

					<li>
						<strong>How much does it cost?</strong>
						<p class="clearfix">You can list <strong>2 adverts for FREE</strong>. If you want to run more than 2 adverts at once, you'll need to upgrade your account to a dealer account costing just &pound;9.99 per month for an unlimited amount of advert slots.</p>

					</li>

					<li>
						<strong>How long am I tied in for with a dealer account?</strong>
						<p class="clearfix">You can cancel the subscription at any time, the dealer account will be downgraded at the end of the paid month. You'll be able to re-subscribe at any point after the downgrade.</p>
					</li>

					<li>
						<strong>How do I pay?</strong>
						<p class="clearfix">We use a company called <a href="https://stripe.com" target="_blank" title="Visit the Stripe website">Stripe</a> to take secure payments online using debit and credit cards. If you have a dealer account, we'll automatically charge for the next month on a subscription basis using the card you signed up with.</p>
					</li>

					<li>
						<strong>How long does an advert display for?</strong>
						<p class="clearfix">Your advert will be active for 14 days after you make your advert live. After 14 days you can re-activate if required by logging in and re-submitting your advert.</p>
					</li>

					<li>
						<strong>How many images can I add per advert</strong>
						<p class="clearfix">Currently you can add up to 10 images per advert, this may change depending on feedback.</p>
					</li>

					<li>
						<strong>Can I add video to my advert</strong>
						<p class="clearfix">We don't support video uploading at the moment, however, if it's something you really want let us know.</p>
					</li>

				</ul>

				<p>If you have a question that is not answered here, please <a href="{{ route('contact') }}">contact us</a>.</p>

				<p>Follow us on <a href="https://twitter.com/electricautosuk" target="_blank">Twitter</a> and <a href="https://www.facebook.com/Electric-Autos-1767600990124746/" target="_blank">Facebook</a> for hints, tips and other news.</p>

			</div>

		</div>

	</div>

</section>


@endsection