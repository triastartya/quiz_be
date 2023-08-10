<?php

namespace App\Http\Controllers;

use App\Models\kelas_guru;
use Illuminate\Http\Request;

class KelasGuruController extends Controller
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
            $data = kelas_guru::all();
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
            $data = kelas_guru::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kelas_guru  $kelas_guru
     * @return \Illuminate\Http\Response
     */
    public function show(kelas_guru $kelas_guru)
    {
        //
        try{
            $data = $kelas_guru->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kelas_guru  $kelas_guru
     * @return \Illuminate\Http\Response
     */
    public function edit(kelas_guru $kelas_guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kelas_guru  $kelas_guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kelas_guru $kelas_guru)
    {
        //
        try{   
            $data = $kelas_guru->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kelas_guru  $kelas_guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelas_guru $kelas_guru)
    {
        //
        try{
            $data = $kelas_guru->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
