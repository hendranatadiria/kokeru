@include('cleaningservice.header')
<!-- Edit Post -->
<section id="editpost" class="editpost bg-light pb-4">
    <div class="container-fluid p-5">
      <div class="row mb-5">
        <div class="col text-center">
          <h2>Edit Tugas</h2>
        </div>
      </div>

	<div class="container-fluid mt-5 pb-4">
		<div class="card w-50 m-auto">
			<div class="card-body h-50">
			<form method="POST" autocomplete="on" action="">
                @csrf
			<div class="form-group">
				<label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{$data->judul}}">
			</div>
			<div class="form-group">
				<label for="isipost">Isi Post</label>
                <textarea type="text" name="isipost" id="isipost" class="form-control" rows="6">{{$data->isipost}}</textarea>
			</div>
			<div class="mt-4">
                <button class="btn btn-success " type="submit">Simpan</button>
                <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
              </div>
			</form>
		  </div>
				{{--

			--}}
		</div>
	</div>
</section>
<script>
    $(document).ready(function() {
    $('#isipost').summernote({
        toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
            ],
    });
    });
</script>
@include('cleaningservice.footer')
