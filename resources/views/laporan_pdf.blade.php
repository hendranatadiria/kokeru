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

<table border="1" style="width:100%;">
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
    <div style="text-align: right; width: 90%;">
        <p>Approval</p><br>
        <p>ttd</p><br>
        <p>Manajer</p>
    </div>
</div>