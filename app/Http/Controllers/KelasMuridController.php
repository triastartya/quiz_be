<?php

namespace App\Http\Controllers;

use App\Models\kelas_murid;
use Illuminate\Http\Request;

class KelasMuridController extends Controller
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
            $data = kelas_murid::all();
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
            $data = kelas_murid::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kelas_murid  $kelas_murid
     * @return \Illuminate\Http\Response
     */
    public function show(kelas_murid $kelas_murid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kelas_murid  $kelas_murid
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas_murid $kelas_murid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kelas_murid  $kelas_murid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas_murid $kelas_murid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kelas_murid  $kelas_murid
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas_murid $kelas_murid)
    {
        //
        try{
            $data = $kelas_murid->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
