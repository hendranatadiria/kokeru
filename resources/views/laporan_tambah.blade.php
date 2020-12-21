@extends(backpack_view('blank'))

@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" />

@endsection

@section('content')
<style>
    .proof-crop {
        object-fit: cover;
        width:230px;
        height:230px;
        }
    .custom-file-label, .custom-file {
        text-overflow: ellipsis;
    }
</style>

@php
        $now= \Carbon\Carbon::now();
        $date = app('request')->input('date')!=null?\Carbon\Carbon::parse(app('request')->input('date')):$now;

        $today = $date->toDateString();
        $todayHour = $today.' 00:00:00';
        $todayEnd = $today.' 23:59:59';
    @endphp
<div class="row">
    <div class="col-12 pt-2" >
        <h1>Tambah Laporan Kebersihan</h1>
        <h5>Ruang {{$room->name}} - {{$now->translatedFormat('l, d F Y')}}</h5>
        <br/>
    </div>
    <div class="col-lg-8 col-sm-12 p-4">
<form method="POST" id="filter" enctype="multipart/form-data">
    @csrf
    <h5>Unggah bukti pembersihan ruangan:</h5>
    <div class="form-group">
    <div class="custom-file p-2 ">
        <input type="file" class="custom-file-input"  accept="video/*, image/*"id="proof1" name="proof1" required>
        <label class="custom-file-label" for="proof1"><span class="d-inline-block text-truncate w-75">Unggah bukti 1</span></label>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-file p-2">
        <input type="file" class="custom-file-input" accept="video/*, image/*" id="proof2" name="proof2">
        <label class="custom-file-label" for="proof2"><span class="d-inline-block text-truncate w-75">Unggah bukti 2</span></label>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-file p-2">
        <input type="file" class="custom-file-input" accept="video/*, image/*" id="proof3" name="proof3">
        <label class="custom-file-label" for="proof3"><span class="d-inline-block text-truncate w-75">Unggah bukti 3</span></label>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-file p-2">
        <input type="file" class="custom-file-input"  accept="video/*, image/*" id="proof4" name="proof4">
        <label class="custom-file-label" for="proof4"><span class="d-inline-block text-truncate w-75">Unggah bukti 4</span></label>
      </div>
    </div>

    <div class="form-group">
      <div class="custom-file p-2">
        <input type="file" class="custom-file-input" accept="video/*, image/*" id="proof5" name="proof5">
        <label class="custom-file-label" for="proof5"><span class="d-inline-block text-truncate w-75">Unggah bukti 5</span></label>
      </div>
    </div>
      <br />
       <button class="btn btn-primary" type="submit">Tambah</button>
</form>
    </div>

</div>
@endsection

@section('after_scripts')
<script>
    $("#proof1").change(function(){
        if($(this)[0].files.length != 0) {
            console.log($(this)[0].files);
            $(this).next("label").children('span').text($(this)[0].files[0].name);
        }
        });
        $("#proof2").change(function(){
        if($(this)[0].files.length != 0) {
            console.log($(this)[0].files);
            $(this).next("label").children('span').text($(this)[0].files[0].name);
        }
        });
        $("#proof3").change(function(){
        if($(this)[0].files.length != 0) {
            console.log($(this)[0].files);
            $(this).next("label").children('span').text($(this)[0].files[0].name);
        }
        });
        $("#proof4").change(function(){
        if($(this)[0].files.length != 0) {
            console.log($(this)[0].files);
            $(this).next("label").children('span').text($(this)[0].files[0].name);
        }
        });
        $("#proof5").change(function(){
        if($(this)[0].files.length != 0) {
            console.log($(this)[0].files);
            $(this).next("label").children('span').text($(this)[0].files[0].name);
        }
        });
</script>
@endsection
