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
        $today = $now->toDateString();
        $todayHour = $today.' 00:00:00';
    @endphp
<div class="col-12 text-center" >
    <h1>Monitoring Kebersihan dan Kerapian Ruangan<br />Gedung Bersama Maju</h1>
    <h4>Hari {{$now->translatedFormat('l')}} Tanggal {{$now->translatedFormat('d F Y')}} Jam {{$now->translatedFormat('H:i')}} WIB</h4>
    <br/>
</div>
<div class="row">
<a href='{{url("/admin/laporan/cetak_pdf")}}' class="btn btn-primary">Download PDF</a>
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
                $isCleaned = $r->cleaninghistory->where('created_at','>=', $todayHour)->first();
                $cleaningServices = $r->responsibility->where('assigned_to', '>=', $today)->where('assigned_from', '<=', $today)->first()->cleaningService->name;
            @endphp
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$cleaningServices}}</td>
				<td>{{$r->name}}</td>
				<td>{{$isCleaned==null?'BELUM':'SUDAH'}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>


@endsection
