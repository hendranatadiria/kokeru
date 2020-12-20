  @include('cleaningservice.header')


  <!-- Jumbotron
  <div class="jumbotron jumbotron-fluid">
    <div class="container text-center">
      <img src="img/speech-bubble.png" width="20%" height="25%">
      <h1 class="display-4">Peluang Berbicara</h1>
      <p class="lead"><b>Melalui ini mengutarakan isi pikiran yang menjadi sebuah kalimat didalamnya terdapat makna yang tersirat</b></p>
    </div>
  </div>

  // about
  <section id="tentang" class="tentang pt-3">
    <div class="container">
      <div class="row mb-3">
        <div class="col text-center">
          <h2>Tentang</h2>
        </div>
      </div>

      <div id="B">
        <div class="row text-center">
          <div class="col-md-6 offset-md-3">
            <div class="col text-justify">
              <p>Peluang Berbicara dibuat pada tahun 2020, isi dari Peluang Berbicara adalah kumpulan kata-kata, cerita pendek, puisi. Inspirasi mungkin berasal dari khayalan, keluh kesah. Daripada disimpan lebih baik ditulis dan dapat dibaca oleh orang lain. gak apa-apa terlihat dramatis dan sok puitis dimata orang lain. Yang penting inspirasi terwujudkan.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  -->


  <!-- terbaru -->
  <section id="terbaru" class="terbaru bg-light pb-4">
    <div class="container">
      <div class="row mb-4 pt-4">
        <div class="col text-center">
          <h2>Terbaru</h2>
        </div>
      </div>

      <div class="row">
        @foreach($post as $data)
        <div class="col-sm-6 col-lg-3 ">
          <div class="card-body">
              <div class="text-value text-center">{{$data->room_id}}</div>
              <div class="text-center">
                STATUS : BELUM<br/>
                <p class="card-text">{{\Illuminate\Support\Str::limit(strip_tags($data->isipost), 35, $end='...') }}</p>
                <a href="tugas/edit/{{$data->idpost}}"  class="btn btn-success">EDIT</a>
              </div>
          </div>
        </div>
        @endforeach
        {{--


      --}}
      </div>
  </div>
        
    </section>

    @include('cleaningservice.footer')
