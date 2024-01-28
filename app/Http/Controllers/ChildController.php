<?php

namespace App\Http\Controllers;

use App\Models\child;
use Illuminate\Http\Request;

class ChildController extends Controller
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
            $data = child::all();
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
        //
        try{
            $insert = $request->all();
            //lila 
            if($request->lila >=23.5){
                $insert['lila_status'] = 'NORMAL';
            }else{
                $insert['lila_status'] = 'KURANG ENERGI KRONIK';
            }            
            //imt
            $tb = $request->tinggi_badan / 100;
            $imt = $request->berat_badan / ($tb*$tb);
            $insert['imt'] = $imt;
            if($imt < 17.0){
                $insert['imt_status'] = 'KURANG BERAT BADAN TINGKAT BERAT';
            }
            if($imt >= 17.0 && $imt < 18.5){
                $insert['imt_status'] = 'KURANG BERAT BADAN TINGKAT RINGAN';
            }
            if($imt >= 18.5 && $imt <= 25){
                $insert['imt_status'] = 'NORMAL';
            }
            if($imt > 25 && $imt <= 27){
                $insert['imt_status'] = 'KELEBIHAN BERAT BADAN TINGKAT RINGAN';
            }
            if($imt > 27){
                $insert['imt_status'] = 'KELEBIHAN BERAT BADAN TINGKAT BERAT';
            }
            $data = child::create($insert);
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\child  $child
     * @return \Illuminate\Http\Response
     */
    public function show(child $child)
    {
        //
        try{
            $data = $child->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\child  $child
     * @return \Illuminate\Http\Response
     */
    public function edit(child $child)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\child  $child
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, child $child)
    {
        //
        try{
            $data = $child->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\child  $child
     * @return \Illuminate\Http\Response
     */
    public function destroy(child $child)
    {
        //
        try{
            $data = $child->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getByUser(Request $request){
        try{
            $data = child::with('z_score.feedback','quiz_pengetahuan','quiz_gizi','quiz_makanan')->where('id_user',$request->id_user)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
    
    public function getByNisn(Request $request){
        try{
            $data = child::where('nisn',$request->nisn)->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
