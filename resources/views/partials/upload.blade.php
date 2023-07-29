<section class="promo">

	<h4>Quick upload</h4>

	<p>Drop <strong>up to 3</strong> images in the box below for a quick and easy upload or click the box for a traditional file upload.</p>

	<div id="uploader">

        <form action="{{ $url }}" method="POST" class="dropzone" id="myAwesomeDropzone" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input type="hidden" name="folder" value="{{ $vars['article'] or '' }}" />
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>

	</div>

</section>