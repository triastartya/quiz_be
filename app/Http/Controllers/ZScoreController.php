<?php

namespace App\Http\Controllers;

use App\Models\z_score;
use App\Models\simpang_baku;
use App\Models\standar_tinggi;
use Illuminate\Http\Request;

class ZScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $data = z_score::with('child')->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $tb_m = $request->tinggi_badan / 100; 
            $tb_kuadrat = $tb_m * $tb_m;
            $nilai_individu_subject = $request->berat_badan / $tb_kuadrat;
            
            $simpang_baku = simpang_baku::where('Tahun',$request->umur_tahun)->where('Bulan',$request->umur_bulan)->first();
            $median = $simpang_baku->Median;
            
            $individu_median = $nilai_individu_subject - $median;
            
            if($nilai_individu_subject < $median){
                $simpang_baku_rujukan = $median - $simpang_baku->min_1_SD;
            }else{
                $simpang_baku_rujukan = $simpang_baku->plus_1_SD - $median;
            }

            $z_score =  $individu_median / $simpang_baku_rujukan;

            $standar_tinggi = standar_tinggi::where('umur',$request->umur_tahun)->first();

            if($request->jenis_kelamin == "LAKI-LAKI"){
                $stinggi = $standar_tinggi->laki;
            }else{
                $stinggi = $standar_tinggi->perempuan;
            }

            if($request->tinggi_badan < $stinggi){
                $tinggi = "PENDEK";
                $f = "Terus tingkatkan kualitas asupan makanan bergizi dan kejar ketertinggalan tinggi badan";
            }else{
                $tinggi = "TINGGI";
                $f = "Bagus, pertahankan pola makan agar tinggi badan dan berat badanmu tetap seimbang.";
            }
            
            $request['nilai_individu_subject']      = $nilai_individu_subject;
            $request['nilai_median_baku_rujukan']   = $median;
            $request['nilai_simpang_baku_rujukan']  = $simpang_baku_rujukan;
            $request['z_score']                     = $z_score;
            $request['kondisi']                     = $this->kondisi($z_score);
            $request['feedback']                    = $this->feedback($z_score).', Tinggi Badan =  '.$f;
            $request['tinggi']                      = $tinggi;
        
            $data = z_score::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    function pemeriksaan(Request $request){
        try{
            if($request->umur_tahun <= 5){
                if($request->umur_bulan == 0){
                    throw new \Exception('usia harus 5-18 tahun');
                }
            }

            if($request->umur_tahun > 18 ){
                throw new \Exception('usia harus 5-18 tahun');
            }

            $tb_m = $request->tinggi_badan / 100; 
            $tb_kuadrat = $tb_m * $tb_m;
            $nilai_individu_subject = $request->berat_badan / $tb_kuadrat;
            
            $simpang_baku = simpang_baku::where('Tahun',$request->umur_tahun)->where('Bulan',$request->umur_bulan)->first();
            $median = $simpang_baku->Median;
            
            $individu_median = $nilai_individu_subject - $median;
            
            if($nilai_individu_subject < $median){
                $simpang_baku_rujukan = $median - $simpang_baku->min_1_SD;
            }else{
                $simpang_baku_rujukan = $simpang_baku->plus_1_SD - $median;
            }

            $z_score =  $individu_median / $simpang_baku_rujukan;

            $standar_tinggi = standar_tinggi::where('umur',$request->umur_tahun)->first();

            if($request->jenis_kelamin == "LAKI-LAKI"){
                $stinggi = $standar_tinggi->laki;
            }else{
                $stinggi = $standar_tinggi->perempuan;
            }

            if($request->tinggi_badan < $stinggi){
                $tinggi = "PENDEK";
                $f = "Terus tingkatkan kualitas asupan makanan bergizi dan kejar ketertinggalan tinggi badan";
            }else{
                $tinggi = "TINGGI";
                $f = "Bagus, pertahankan pola makan agar tinggi badan dan berat badanmu tetap seimbang.";
            }
            
            $request['nilai_individu_subject']      = $nilai_individu_subject;
            $request['nilai_median_baku_rujukan']   = $median;
            $request['nilai_simpang_baku_rujukan']  = $simpang_baku_rujukan;
            $request['z_score']                     = $z_score;
            $request['kondisi']                     = $this->kondisi($z_score);
            $request['feedback']                    = $this->feedback($z_score).', Tinggi Badan =  '.$f;
            $request['tinggi']                      = $tinggi;

            return response()->json(['status'=>true,'data'=>$request->all()]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    // <-3 GIZI BURUK
    // -3 sd <-2 KURANG GIZI
    // -2 sd 1 GIZI BAIK
    // 1 sd 2 GIZI LEBIH
    // > 2 OBESITAS
    //

    function kondisi($z_score){
        $kondisi = null;
        $feedback = null;
        if($z_score <= -3){
            $kondisi = 'SANGAT KURUS';
        }else{
            if($z_score > -3 && $z_score <= -2){
                $kondisi = 'KURUS';
            }else{
                if($z_score > -2 && $z_score <= 1){
                    $kondisi = 'NORMAL';
                }else{
                    if($z_score > 1 && $z_score <= 2){
                        $kondisi = 'GEMUK';
                    }else{
                        if($z_score > 2){
                            $kondisi = 'OBESITAS';
                        }else{
                            $kondisi = 'TIDAK TERHITUNG';
                        }
                    }
                }
            }
        }
        return $kondisi;
    }

    function feedback($z_score){
        $kondisi = null;
        $feedback = null;
        if($z_score <= -3){
            $kondisi = 'SANGAT KURUS';
            $feedback = 'Perhatikan konsumsi harian, sebaiknya tingkatkan asupan makanan dengan memilih jenis makanan bergizi seimbang. Apabila berat badanmu selama 3 bulan ke depan tidak naik, segera hubungi ahli gizi bersama orang tua.';
        }else{
            if($z_score > -3 && $z_score <= -2){
                $kondisi = 'KURUS';
                $feedback = 'Perhatikan konsumsi harian, sebaiknya tingkatkan asupan makanan dengan memilih jenis makanan bergizi seimbang. Apabila berat badanmu selama 3 bulan ke depan tidak naik, segera hubungi ahli gizi bersama orang tua.';
            }else{
                if($z_score > -2 && $z_score <= 1){
                    $kondisi = 'NORMAL';
                    $feedback = 'Pertahankan status gizimu.';
                }else{
                    if($z_score > 1 && $z_score <= 2){
                        $kondisi = 'GEMUK';
                        $feedback = 'Perhatikan konsumsi harian, sebaiknya kurangi asupan makanan terutama fast food dan junk food. Apabila berat badanmu selama 3 bulan ke depan tidak menurun, segera hubungi ahli gizi bersama orang tua';
                    }else{
                        if($z_score > 2){
                            $kondisi = 'OBESITAS';
                            $feedback = 'Perhatikan konsumsi harian, sebaiknya kurangi asupan makanan terutama fast food dan junk food. Apabila berat badanmu selama 3 bulan ke depan tidak menurun, segera hubungi ahli gizi bersama orang tua';
                        }else{
                            $kondisi = 'TIDAK TERHITUNG';
                            $feedback = 'feedback TIDAK TERHITUNG';
                        }
                    }
                }
            }
        }
        return $feedback;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\z_score  $z_score
     * @return \Illuminate\Http\Response
     */
    public function show(z_score $z_score)
    {
        //
        try{
            $data = $z_score->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\z_score  $z_score
     * @return \Illuminate\Http\Response
     */
    public function edit(z_score $z_score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\z_score  $z_score
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, z_score $z_score)
    {
        //
        try{   
            $data = $z_score->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\z_score  $z_score
     * @return \Illuminate\Http\Response
     */
    public function destroy(z_score $z_score)
    {
        //
        try{
            $data = $z_score->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getByChild(Request $req)
    {
        try{
            $data = z_score::where('id_child',$req->id_child)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function grafik(Request $req)
    {
        try{
            $data = z_score::where('id_child',$req->child)->whereBetween('tanggal_priksa',[$req->startDate,$req->endDate]);
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getSimpangBaku(){
        try{
            $data = simpang_baku::all();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getZscoreChild(Request $req){
        try{
            $data = z_score::where('id_child',$req->child)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getZscoreChildNow(Request $req){
        try{

            $data = z_score::where('id_child',$req->child)
            ->whereYear('created_at', '=', date("Y"))
            ->whereMonth('created_at', '=', date("m"))
            ->first();

            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

}
