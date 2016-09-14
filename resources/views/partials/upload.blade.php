<section class="promo">

	<h4>Quick upload</h4>

	<p>Drop images in the box below for a quick and easy upload or click the box for a traditional file upload.</p>

	<div id="uploader">

        <form action="{{ route('pic.save') }}" method="POST" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>

	</div>

</section>