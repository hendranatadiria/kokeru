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
				<label for="judul">ID</label>
                <input type="text" name="id" id="id" class="form-control" value="{{$data->id}}">
			</div>
			<div class="form-group">
				<label for="isipost">Cleaning Service ID</label>
                <textarea type="text" name="cs_id" id="cs_id" class="form-control" rows="6">{{$data->cleaning_service_id}}</textarea>
			</div>
      <div class="form-group">
				<label for="isipost">Room ID</label>
                <textarea type="text" name="room_id" id="room_id" class="form-control" rows="6">{{$data->room_id}}</textarea>
			</div>
      <div class="form-group">
				<label for="gambar">File gambar 1</label>
				<input type="file" name="prove_1" id="prove_1" class="form-control-file">
			</div>
      <div class="form-group">
				<label for="gambar">File gambar 2</label>
				<input type="file" name="prove_2" id="prove_2" class="form-control-file">
			</div>
      <div class="form-group">
				<label for="gambar">File gambar 3</label>
				<input type="file" name="prove_3" id="prove_3" class="form-control-file">
			</div>
      <div class="form-group">
				<label for="gambar">File gambar 4</label>
				<input type="file" name="prove_4" id="prove_4" class="form-control-file">
			</div>
      <div class="form-group">
				<label for="gambar">File gambar 5</label>
				<input type="file" name="prove_5" id="prove_5" class="form-control-file">
			</div>
			<div class="mt-4">
                <button class="btn btn-success " type="submit">Ubah Status</button>
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
