<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function bencana(Request $request)
    {
        $id = Auth::user()->id;
        $nama_gunung = $request->get('nama_gunung');
        $jenis_bencana = $request->get('jenis_bencana');
        $thn_kej = $request->get('thn_kej');

        $arr_akhir_laki = [];
        $arr_akhir_perempuan = [];

        // DB::table('penduduk')->insert(
        //     ['nama_kota' => $jenis_bencana, 'jenis_kelamin' => 'laki']
        // );


        $array_jenis_kelamin = ['laki','perempuan'];
        $array_kel_umur = ['0','1-4','5-9','10-19','20-64','>65'];

        // dd($array_kel_umur);


        if($nama_gunung=="Kelud" && $jenis_bencana == "Gunung Meletus")
        {
            $array_nama_kota = ['Blitar','Kediri','Malang'];

            for ($nk=0; $nk <count($array_nama_kota); $nk++) { 
                for ($ku=0; $ku<count($array_kel_umur); $ku++) {             
                    for ($jk=0; $jk<count($array_jenis_kelamin); $jk++) {             

                        $data = DB::table('penduduk')
                        ->select('*')
                        ->where('nama_kota',$array_nama_kota[$nk])
                        ->where('jenis_kelamin',$array_jenis_kelamin[$jk])
                        ->where('kelompok_umur',$array_kel_umur[$ku])
                        ->orderBy('tahun')
                        ->get();


                        $jumlah = [];
                        $tahun = [];
                        $total_X=0;
                        $total_Y=0;
                        $pangkat_X=0;
                        $XY=0;
                        $rata_X=0;
                        $rata_Y=0;
                        for ($i=0; $i <count($data); $i++) { 
                            array_push($jumlah, $data[$i]->jumlah);
                            array_push($tahun, $data[$i]->tahun);
                        }

                        for ($i=0; $i < count($tahun); $i++) { 
                            $total_X += $tahun[$i];
                        }
                        for ($i=0; $i < count($jumlah); $i++) { 
                            $total_Y += $jumlah[$i];
                        }
                        for ($i=0; $i < count($tahun); $i++) { 
                            $pangkat_X += $tahun[$i]*$tahun[$i];
                        }
                        for ($i=0; $i < count($data); $i++) { 
                            $XY += $tahun[$i]*$jumlah[$i];
                        }

                        $beta=((count($data)*$XY)-($total_X*$total_Y))/((count($data)*$pangkat_X)-($total_X*$total_X));

                       

                        $rata_X=$total_X/count($tahun);
                        $rata_Y=$total_Y/count($jumlah);

                        $alpha = $rata_Y-($rata_X*$beta);

                        //rumus-> Y = alpha + beta*tahun

                        for ($i=2000; $i <2021 ; $i++) { 
                            $nilai_Y = $alpha + ($beta*$i);
                            $cek = DB::table('penduduk')
                            ->select('*')
                            ->where('nama_kota',$array_nama_kota[$nk])
                            ->where('jenis_kelamin',$array_jenis_kelamin[$jk])
                            ->where('kelompok_umur',$array_kel_umur[$ku])
                            ->where('tahun',$i)
                            ->get();

                            if($cek->isEmpty())
                            {
                                DB::table('penduduk')
                                ->insert(['nama_kota' => $array_nama_kota[$nk], 
                                    'jenis_kelamin' => $array_jenis_kelamin[$jk], 
                                    'desa_kota' => 'desa', 
                                    'kelompok_umur' => $array_kel_umur[$ku], 
                                    'jumlah' => (int)$nilai_Y, 
                                    'tahun' => $i]);
                            }
                            else
                            {
                                DB::table('penduduk')
                                ->where('nama_kota',$array_nama_kota[$nk])
                                ->where('jenis_kelamin',$array_jenis_kelamin[$jk])
                                ->where('kelompok_umur',$array_kel_umur[$ku])
                                ->where('tahun',$i)
                                ->update(['jumlah' => (int)$nilai_Y]);
                            }
                        }

                        if($array_jenis_kelamin[$jk] == "laki")
                        {
                            $data_akhir = DB::table('penduduk')
                            ->select('*')
                            ->where('nama_kota',$array_nama_kota[$nk])
                            ->where('jenis_kelamin',$array_jenis_kelamin[$jk])
                            ->where('kelompok_umur',$array_kel_umur[$ku])
                            ->where('tahun',$thn_kej)
                            ->get();


                            array_push($arr_akhir_laki, $data_akhir[0]->jumlah);
                        }
                        else
                        {
                            $data_akhir = DB::table('penduduk')
                            ->select('*')
                            ->where('nama_kota',$array_nama_kota[$nk])
                            ->where('jenis_kelamin',$array_jenis_kelamin[$jk])
                            ->where('kelompok_umur',$array_kel_umur[$ku])
                            ->where('tahun',$thn_kej)
                            ->get();


                            array_push($arr_akhir_perempuan, $data_akhir[0]->jumlah);
                        }


                    }
                }
            }
        }
        $htg_laki = 0;
        $htg_prmpuan = 0;
        $total_laki = [];
        $total_perempuan = [];
        for ($i=0; $i < count($arr_akhir_perempuan); $i++) { 
            $htg_laki += $arr_akhir_laki[$i];
            $htg_prmpuan += $arr_akhir_perempuan[$i];

            if($i==5 || $i==11 || $i==17)
            {
                array_push($total_laki, $htg_laki);
                array_push($total_perempuan, $htg_prmpuan);
                $htg_laki = 0;
                $htg_prmpuan = 0;
            }
        }
        //ga kepake
        $hitung = 0;
        $hitung+=$arr_akhir_laki[1];
        $hitung+=$arr_akhir_laki[7];
        $hitung+=$arr_akhir_laki[13];

        $hitungg = 0;
        $hitungg+=$arr_akhir_perempuan[1];
        $hitungg+=$arr_akhir_perempuan[7];
        $hitungg+=$arr_akhir_perempuan[13];

        $total = $hitungg + $hitung;

        $total = $total*40/100;

        // dd($total);
        //1 = beras
        //2 = mie instan
        $count_umur = 0;
        $data_bantuan_laki = [];
        $data_bantuan_perempuan = [];
            $bantuan_beras_laki = [];
            $bantuan_beras_perempuan = [];
            $bantuan_mie_laki = [];
            $bantuan_mie_perempuan = [];
        for ($i=0; $i < count($arr_akhir_perempuan); $i++) { 
            if($count_umur == 6)
            {
                $count_umur = 0;
            }
            if($count_umur == 0)
            {
                array_push($bantuan_beras_laki, 0);
                array_push($bantuan_beras_perempuan, 0);
                array_push($bantuan_mie_laki, 0);
                array_push($bantuan_mie_perempuan, 0);
            }
            else
            {
                // $hitung = $arr_akhir_perempuan[$i]*200;

                array_push($bantuan_beras_laki, $arr_akhir_perempuan[$i]*200);
                array_push($bantuan_beras_perempuan, $arr_akhir_laki[$i]*200);
                array_push($bantuan_mie_laki, $arr_akhir_laki[$i]*3/100*40);
                array_push($bantuan_mie_perempuan, $arr_akhir_perempuan[$i]*3*40/100);
            }
            $count_umur++;
        }
            array_push($data_bantuan_laki, $bantuan_beras_laki);
            array_push($data_bantuan_perempuan, $bantuan_beras_perempuan);

            array_push($data_bantuan_laki, $bantuan_mie_laki);
            array_push($data_bantuan_perempuan, $bantuan_mie_perempuan);

            $hasil = 0;
            for ($i=0; $i < count($data_bantuan_laki[1]); $i++) { 

                # code...
                $hasil += $data_bantuan_laki[1][$i];
                $hasil += $data_bantuan_perempuan[1][$i];
            }
            // dd($data_bantuan_laki[1], $hasil,$total);

        // dd($tes);

        // return redirect('/home');
            $arr_kategori = ['Bayi','Balita','Anak-anak','Remaja','Dewasa','Lansia'];
        return view('bantuan', compact('data_bantuan_laki','data_bantuan_perempuan','array_kel_umur','array_nama_kota','hasil','arr_akhir_perempuan','arr_akhir_laki','total_laki','total_perempuan','arr_kategori'));
        // return redirect()->back();
    }
}
