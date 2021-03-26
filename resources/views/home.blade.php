@extends('layouts.app')

@section('content')

<!-- <div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!




                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
    <div class="col-sm-8 text-left bg$red"> 
      
          <form method="GET" enctype="multipart/form-data" action="{{url('bencana')}}">
          <!-- {{ csrf_field() }} -->
                <p>
                    Pilih Jenis Bencana: 
                <select class="form-select" aria-label="Default select example" name="jenis_bencana" id="bencana">
                  <option selected>Jenis Bencana</option>
                  <option value="Banjir">Banjir</option>
                  <option value="Gunung Meletus">Gunung Meletus</option>
                  <option value="Tanah Longsor">Tanah Longsor</option>
                </select>
                <br>

                <p id="textGunung">Pilih Gunung:
                <select name="nama_gunung" id="nama_gunung">
                  <option value="Agung">Gunung Agung</option>
                  <option value="Ambang">Gunung Ambang</option>
                  <option value="Anak Krakatau">Gunung Anak Krakatau </option>
                  <option value="Kelud">Gunung Kelud</option>
                </select>
                <span id="gng_terdampak" style="padding-left: 1%"></span>
                </p>  
                <p id="textBencana">Pilih Lokasi:
                <select name="lokasi_bencana" id="lokasi_bencana">
                  <option value="JawaTimur">Jawa Timur</option>
                  <option value="JawaBarat">Jawa Barat</option>
                  <option value="JawaTengah">Jawa Tengah</option>
                  <option value="Jakarta">Jakarta</option>
                </select>
                </p>  

                Asumsi Wilayah Terdampak<input type="number" required name="price" min="0" max="100" value="0" step=".01"  style="width: 5.4%">%

                <br>
                Tahun Kejadian<input type="number" required name="thn_kej" min="2000" max="2100" style="width: 5.4%">

                <br>
                <!-- <b><font size="4">Pilih Metode : </b></font> 
                    <input type="radio" name="metode" value="Minkowski" checked> Minkowski
                    <input type="radio" name="metode" value="Euclidean"> Euclidean <br> -->

                <input type="submit" name="search" value="Search" class="btn btn-primary"><br>
                

                </p>
                
    </form>


  </div>
</div>








<!-- <footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer> -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#nama_gunung').hide();
    $('#lokasi_bencana').hide();
    $('#textGunung').hide();
    $('#textBencana').hide();
    $('#gng_terdampak').hide();   

    $('#bencana').change(function(){
      if($('#bencana').val() == "Gunung Meletus")
      {
        $('#nama_gunung').show();
        $('#textGunung').show();
        $('#lokasi_bencana').hide();
        $('#textBencana').hide();
      }
      else
      {
        $('#lokasi_bencana').show();
        $('#textBencana').show();
        $('#nama_gunung').hide();
        $('#textGunung').hide();        
      }
    });


    $('#nama_gunung').change(function(){
      if($('#nama_gunung').val() == "Kelud")
      {
        $('#gng_terdampak').show();    
        document.getElementById("gng_terdampak").innerHTML = "*Kabupaten/Kota terdampak: Blitar, Kediri, Malang";
      }
      else
      {
        $('#gng_terdampak').hide();     
      }
    });


});  




</script>
@endsection
