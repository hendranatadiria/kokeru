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
        $todayEnd = $today.' 23:59:59';
    @endphp
<div class="col-12 text-center" >
    <h1>Monitoring Kebersihan dan Kerapian Ruangan<br />Gedung Bersama Maju</h1>
    <h4>Hari {{$now->translatedFormat('l')}} Tanggal {{$now->translatedFormat('d F Y')}} Jam {{$now->translatedFormat('H:i')}} WIB</h4>
    <br/>
</div>
<div class="row">
@php $count=0; @endphp
@foreach($rooms as $room)
@php
    $isCleaned = $room->cleaninghistory->where('created_at','>=', $todayHour)->where('created_at','<=', $todayEnd)->first();
    $cleaningServices = $room->responsibility->where('assigned_to', '>=', $today)->where('assigned_from', '<=', $today)->first();
@endphp
@if (backpack_user()->hasRole('manager') || $cleaningServices->cleaningService->id == backpack_user()->cleaning_services_id)
@php $count++ @endphp
<div class="col-sm-6 col-lg-3 ">
    <div class="card text-white {{$isCleaned==null?'bg-orange':'bg-success'}}">
      <div class="card-body">
        <div class="text-value text-center">{{$room->name}}</div>
        <div class="text-center">{{$isCleaned==null?'BELUM':'SUDAH'}}<br/>
            {{$cleaningServices==null?'Cleaning Service belum di set':optional($cleaningServices->cleaningService)->name}}<br />
            @if($isCleaned!=null)

            <button type="button" class="btn detailmodal" data-toggle="modal" data-target="#detailedModal" data-detailid="{{$isCleaned->id}}">Detail</button>
            @else
            <a class="btn">Detail</a>
                @if($cleaningServices->cleaningService->id == backpack_user()->cleaning_services_id && $isCleaned==null)
                    <a class="btn" href="{{url('/admin/laporan/tambah/'.$room->id)}}">Update Status</a>
                @endif
            @endif
            </div>
        </div>

    </div>
  </div>
  @endif
  @endforeach
  @if($count<1)
  <div class="col-12 text-center">
  <h4 style="margin-top: auto;"> Anda belum memiliki penugasan ruangan untuk dibersihkan </h4>
</div>
    @endif
</div>
</div>

  <div class="modal fade" tabindex="500" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="detailedModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Bukti Kebersihan dan Kerapihan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body bg-info text-center" id="bodyModal">
          <img src="{{url("/load.gif")}}" width="40" >
        </div>
        <div class="modal-footer bg-info">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('after_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.js" integrity="sha512-UHlZzRsMRK/ENyZqAJSmp/EwG8K/1X/SzErVgPc0c9pFyhUwUQmoKeEvv9X0uNw8x46FxgIJqlD2opSoH5fjug==" crossorigin="anonymous"></script><script>
    $(document).on('click','.detailmodal', function(e) {
        $('#detailedModal').modal('show');
    })

    function detectExt(string){
        var ext = string.substring(string.length-3).toLowerCase();
        console.log(ext);
        if (ext=='jpg' || ext=='png' || ext=='tif' || ext=='eic' || ext=='gif') {
            return 'photo';
        } else if (ext == 'mp4' || ext=='mov' || ext=='avi' || ext=='3gp' || ext=='eiv' ) {
            return 'video';
        } else {
            return ext;
        }
    }


    $('#detailedModal').on('shown.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        console.log(button.data('detailid'));
        var id = button.data('detailid')
        var modalBody = $('#bodyModal');
        modalBody.empty();
        modalBody.append('<img src="{{url("/")}}/load.gif" width="40">');
        $.ajax({url: '/admin/cleaninghistory/'+id+'/json', success: function(result){
            modalBody.empty();
            console.log(result.proof_1);
            if(result.proof_1 != null) {
                var type= detectExt(result.proof_1);
                if (type=='photo') {
                    tag='<a href="{{url("/public/upload/proof")}}/'+result.proof_1+'" data-lightbox="proof">'+'<img src="{{url("/public/upload/proof")}}'+'/'+result.proof_1+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="{{url("/public/upload/proof")}}'+'/'+result.proof_1+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_2 != null) {
                var type= detectExt(result.proof_2);
                if (type=='photo') {
                    tag='<a href="{{url("/public/upload/proof")}}/'+result.proof_2+'" data-lightbox="proof">'+'<img src="{{url("/public/upload/proof")}}'+'/'+result.proof_2+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="{{url("/public/upload/proof")}}'+'/'+result.proof_2+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_3 != null) {
                var type= detectExt(result.proof_3);
                if (type=='photo') {
                    tag='<a href="{{url("/public/upload/proof")}}/'+result.proof_3+'" data-lightbox="proof">'+'<img src="{{url("/public/upload/proof")}}'+'/'+result.proof_3+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="{{url("/public/upload/proof")}}'+'/'+result.proof_3+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_4 != null) {
                var type= detectExt(result.proof_4);
                if (type=='photo') {
                    tag='<a href="{{url("/public/upload/proof")}}/'+result.proof_4+'" data-lightbox="proof">'+'<img src="{{url("/public/upload/proof")}}'+'/'+result.proof_4+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="{{url("/public/upload/proof")}}'+'/'+result.proof_4+'">';
                }
                modalBody.append(tag);
            }
            if(result.proof_5 != null) {
                var type= detectExt(result.proof_5);
                if (type=='photo') {
                    tag='<a href="{{url("/public/upload/proof")}}/'+result.proof_5+'" data-lightbox="proof">'+'<img src="{{url("/public/upload/proof")}}'+'/'+result.proof_5+'" class="img-fluid proof-crop p-1"></a>';
                } else if (type=='video') {
                    tag='<video width="409" height="230" controls><source src="{{url("/public/upload/proof")}}'+'/'+result.proof_5+'">';
                }
                modalBody.append(tag);
            }

        }});

    })

    $('#detailedModal').on('hidden.bs.modal', function(){
        $(this).find('video').each(function() {
            this.pause();
        });
    });
</script>
@endsection
