@if($success_message)
<section class="message alternative">

	<div class="container">

		<div class="row">

			<div class="col-sm-12 text-center">

				@if($success_message)

				<h3 class="text-success">{!! $success_message !!}</h3>

				@endif


			</div>

		</div>

	</div>

</section>
@endif