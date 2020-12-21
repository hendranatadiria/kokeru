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
</style>

@php
        $now= \Carbon\Carbon::now();
        $date = app('request')->input('date')!=null?\Carbon\Carbon::parse(app('request')->input('date')):$now;

        $today = $date->toDateString();
        $todayHour = $today.' 00:00:00';
        $todayEnd = $today.' 23:59:59';
    @endphp
<div class="col-12 text-center" >
    <h1>Laporan Harian Kebersihan dan Kerapian Ruangan Gedung Bersama Maju<br />
Hari {{$date->translatedFormat('l')}} Tanggal {{$date->translatedFormat('d F Y')}}</h1>
    <h5>Tanggal Cetak {{$now->translatedFormat('d F Y')}} Jam {{$now->translatedFormat('H:i')}} WIB</h5>
    <br/>
</div>
<div class="row">
    <div class="col-3 p-4">
<form method="GET" id="filter">
    <div class="form-group">
        <label >Filter berdasar Status</label>
        <select class="form-control" name="status">
            <option value="all">Semua</option>
            <option value="done">Sudah</option>
            <option value="nope">Belum</option>
          </select>
       </div>

      <div class="form-group">
        <label >Filter berdasar Tanggal</label>
        <input type="date" name="date" max="3000-12-31"
               min="1000-01-01" class="form-control">
       </div>
       <button class="btn btn-primary" type="submit">Tampil</button>
       <a href='{{url("/admin/laporan/cetak_pdf?date=".app('request')->input('date')."&status=".app('request')->input('status'))}}' id="pdf" class="btn btn-secondary">Download PDF</a>
</form>
    </div>
    <div class="col-12">
<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Cleaning Service</th>
				<th>Ruangan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($report as $r)
            @php
                $isCleaned = $r->cleaninghistory->where('created_at','>=', $todayHour)->where('created_at','<=', $todayEnd)->first();
                $cleaningServices = $r->responsibility->where('assigned_to', '>=', $today)->where('assigned_from', '<=', $today)->first()->cleaningService->name;
            @endphp
            @if(app('request')->input('status')=='all' || app('request')->input('status') == null || (app('request')->input('status') == 'done' && $isCleaned!=null ) || (app('request')->input('status') == 'nope' && $isCleaned==null ))
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$cleaningServices}}</td>
				<td>{{$r->name}}</td>
				<td>{{$isCleaned==null?'BELUM':'SUDAH'}}</td>
            </tr>
            @endif
			@endforeach
		</tbody>
    </table>
    </div>
</div>


@endsection

@section('after_scripts')

@endsection
