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
    <div style="text-align: right; width: 90%;">
        <p>Approval</p><br>
        <p>ttd</p><br>
        <p>Manajer</p>
    </div>
</div>
