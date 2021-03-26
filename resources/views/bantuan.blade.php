@extends('layouts.admin')

@section('title', 'Dashboard')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <h1 class="m-0 text-dark ml-4 mt-4 mb-3">Berita Bencana yang Sedang Aktif</h1>
        </div>

        <div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <!-- <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p>
      <p><a href="#">Link</a></p> -->
    </div>
    <div class="col-sm-8 text-left bg$red"> 

       <h1 class="text-center">Jumlah Penduduk Daerah Terdampak</h1>
        <table class="table">
          <thead>
            <tr>
              <th></th>
              <th scope="col" colspan="3"class="text-center">Pedesaan Blitar 2018</th>
              <th scope="col" colspan="3"class="text-center">Pedesaan Kediri 2018</th>
              <th scope="col" colspan="3"class="text-center">Pedesaan Malang 2018</th>
            </tr>
            <tr>
              <th scope="col">Kelompok Umur</th>
              <th scope="col" colspan="3"class="text-center">Jenis Kelamin</th>
              <th scope="col" colspan="3"class="text-center">Jenis Kelamin</th>
              <th scope="col" colspan="3"class="text-center">Jenis Kelamin</th>
            </tr>
            <tr>
              <th scope="col"></th>
              <th scope="col">Laki-Laki</th>
              <th scope="col">Perempuan</th>
              <th scope="col">Total Pedesaan</th>
              <th scope="col">Laki-Laki</th>
              <th scope="col">Perempuan</th>
              <th scope="col">Total Pedesaan</th>
              <th scope="col">Laki-Laki</th>
              <th scope="col">Perempuan</th>
              <th scope="col">Total Pedesaan</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < count($array_kel_umur); $i++)  
            <tr>
              <th scope="row"class="text-center">{{$array_kel_umur[$i]}}</th>
              <td class="text-center">{{$arr_akhir_laki[$i]}}</td>
              <td class="text-center">{{$arr_akhir_perempuan[$i]}}</td>
              <td class="text-center">{{$arr_akhir_laki[$i]+$arr_akhir_perempuan[$i]}}</td>

              <td class="text-center">{{$arr_akhir_laki[$i+6]}}</td>
              <td class="text-center">{{$arr_akhir_perempuan[$i+6]}}</td>
              <td class="text-center">{{$arr_akhir_laki[$i+6]+$arr_akhir_perempuan[$i+6]}}</td>

              <td class="text-center">{{$arr_akhir_laki[$i+12]}}</td>
              <td class="text-center">{{$arr_akhir_perempuan[$i+12]}}</td>
              <td class="text-center">{{$arr_akhir_laki[$i+12]+$arr_akhir_perempuan[$i+12]}}</td>
            </tr>
            @endfor
            <tr>
              <th scope="row" class="text-center">Jumlah</th>
              @for ($i = 0; $i < count($total_laki); $i++)  
              <td class="text-center">{{$total_laki[$i]}}</td>
              <td class="text-center">{{$total_perempuan[$i]}}</td>
              <td class="text-center">{{$total_laki[$i]+$total_perempuan[$i]}}</td>
              @endfor
            </tr>
          </tbody>
        </table>

        <br><br>

        <h1 class="text-center">Pengelompokan Penduduk Daerah Terdampak</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"class="text-center">Kategori Penduduk</th>
              <th scope="col"class="text-center">Kelompok Umur</th>
              <th scope="col"class="text-center">Laki-Laki</th>
              <th scope="col"class="text-center">Perempuan</th>
              <th scope="col"class="text-center">Total Tahun 2018</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < count($array_kel_umur); $i++)  
            <tr>
              <th scope="row"class="text-center">{{$arr_kategori[$i]}}</th>
              <th scope="row"class="text-center">{{$array_kel_umur[$i]}}</th>
              <td class="text-center">{{$arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12]}}</td>
              <td class="text-center">{{$arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12]}}</td>
              <td class="text-center">{{$arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12]+$arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12]}}</td>
            </tr>
            @endfor
          </tbody>
        </table>

        <br><br>

        <h1 class="text-center">Asumsi Pengelompokan Penduduk Daerah Terdampak Sebesar 40%</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col"class="text-center">Kategori Penduduk</th>
              <th scope="col"class="text-center">Kelompok Umur</th>
              <th scope="col"class="text-center">Laki-Laki</th>
              <th scope="col"class="text-center">Perempuan</th>
              <th scope="col"class="text-center">Total Tahun 2018</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < count($array_kel_umur); $i++)  
            <tr>
              <th scope="row"class="text-center">{{$arr_kategori[$i]}}</th>
              <th scope="row"class="text-center">{{$array_kel_umur[$i]}}</th>
              <td class="text-center">{{(int)(($arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12])*40/100)}}</td>
              <td class="text-center">{{(int)(($arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12])*40/100)}}</td>
              <td class="text-center">{{(int)(($arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12]+$arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12])*40/100)}}</td>
            </tr>
            @endfor
          </tbody>
        </table>

        <h1 class="text-center">Prediksi Kebutuhan Logistik</h1>

        <?php

        $chart_beras =[];
        $chart_mie =[];
        
        
        for ($i=0; $i <count($array_kel_umur) ; $i++) { 
          if($i==0)
          {            
            $data_brs = ["label"=>$array_kel_umur[$i],"y"=>0];
            $data_mie = ["label"=>$array_kel_umur[$i],"y"=>0];
            array_push($chart_beras, $data_brs);
            array_push($chart_mie, $data_mie);
          }
          else
          {
            $data_brs = [];
            $data_mie = [];
            $data_brs = ["label"=>$array_kel_umur[$i],"y"=>(int)((($arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12]+$arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12])*40/100)*2/10)];
            $data_mie = ["label"=>$array_kel_umur[$i],"y"=>(int)((($arr_akhir_perempuan[$i] + $arr_akhir_perempuan[$i+6] + $arr_akhir_perempuan[$i+12]+$arr_akhir_laki[$i] + $arr_akhir_laki[$i+6] + $arr_akhir_laki[$i+12])*40/100)*3)];
            array_push($chart_beras, $data_brs);
            array_push($chart_mie, $data_mie);
          }
        }?>

        <div id="chartContainerBeras" style="height: 370px; width: 100%;"></div>
        <br><br>
        <div id="chartContainerMie" style="height: 370px; width: 100%;"></div>
        <br><br>
        <div id="chartContainerTelur" style="height: 370px; width: 100%;"></div>
        <br><br>
        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
        <div id="chartContainer3" style="height: 370px; width: 100%;"></div>

                <?php $j=0 ?>

                @for ($i = 0; $i < count($data_bantuan_laki[0]); $i++)   

                @if ($i%6 == 0 && $i>0)
                <?php $j++ ?>
                @endif

                Jumlah bantuan beras kota {{$array_nama_kota[$j]}} untuk kelompok umur {{ $array_kel_umur[$i%6] }} sebesar {{$data_bantuan_laki[0][$i]}}
                <br>
                Jumlah bantuan mie instant kota {{$array_nama_kota[$j]}} untuk kelompok umur {{ $array_kel_umur[$i%6] }} sebesar {{$data_bantuan_laki[1][$i]}}
                <br><br>
                @endfor

        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

            </div>

            <div class="col-sm-2 sidenav">
              <!-- <div class="well">
                <p>ADS</p>
              </div>
              <div class="well">
                <p>ADS</p>
              </div> -->
            </div>


    </div>

<script type="text/javascript">
    window.onload = function () {


  var chart = new CanvasJS.Chart("chartContainerBeras", {
  animationEnabled: true,
  exportEnabled: true,
  title:{
    text: "Bahan Pokok Beras Berdasarkan Kelompok Usia"
  },
  subtitles: [{
    text: "Dalam Satuan Kg/Hari"
  }],
  data: [{
    type: "pie",
    showInLegend: "true",
    legendText: "{label}",
    indexLabelFontSize: 16,
    indexLabel: "{label} - {y} Kg/Hari",
    yValueFormatString: "#,##0",
    dataPoints: <?php echo json_encode($chart_beras, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();


 


  var chart_2 = new CanvasJS.Chart("chartContainerMie", {
  animationEnabled: true,
  theme: "light2",
  title: {
    text: "Bahan Pokok Mie Instant"
  },
  axisY: {
    scaleBreaks: {
    }
  },
  data: [{
    type: "column",
    yValueFormatString: "#,##0",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($chart_mie); ?>
  }]
});
chart_2.render();

var chart_3 = new CanvasJS.Chart("chartContainerTelur", {
  animationEnabled: true,
  theme: "light2",
  title: {
    text: "Bahan Pokok Telur"
  },
  axisY: {
    scaleBreaks: {
    }
  },
  data: [{
    type: "column",
    yValueFormatString: "#,##0",
    indexLabel: "{y}",
    indexLabelPlacement: "inside",
    indexLabelFontColor: "white",
    dataPoints: <?php echo json_encode($chart_mie); ?>
  }]
});
chart_3.render();
 
}
</script>

@endsection
