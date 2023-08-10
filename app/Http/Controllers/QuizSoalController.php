<?php

namespace App\Http\Controllers;

use App\Models\quiz_soal;
use App\Models\quiz_option;
use Illuminate\Http\Request;

class QuizSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        //
        try {
            $data = quiz_soal::where('id_quiz')->get();
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
        // dd(json_decode($request->option));
        $option = json_decode($request->option);
        // dd($option);
        try{
            $data = quiz_soal::create($request->all());
            foreach($option as $row){
                quiz_option::create([
                    'id_quiz_soal'=>$data->id,
                    'question'=>$row->option,
                    'answer'=>$row->answer,
                    'score'=>$row->score,
                ]);
            }
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function tambahQuis(Request $request){
        $option = json_decode($request->option);
        try{
            $file = $request->file('gambar');
            $value = [
                'score_soal' => $request->score_soal,
                'answer' => $request->answer,
                'question' => $request->question,
                'id_quiz' => $request->id_quiz,
                'option' => $request->option,
                'no_urut'=>$request->no_urut
            ];
            if($file){
                $filename = rand().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('kuis'), $filename);
                $value['gambar'] = $filename;
            }

            $data = quiz_soal::create($value);

            foreach($option as $row){
                quiz_option::create([
                    'id_quiz_soal'=>$data->id,
                    'question'=>$row->option,
                    'answer'=>$row->answer,
                    'score'=>$row->score,
                ]);
            }
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quiz_soal  $quiz_soal
     * @return \Illuminate\Http\Response
     */
    public function show(quiz_soal $quiz_soal)
    {
        //
        try{
            $data = $quiz_soal->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quiz_soal  $quiz_soal
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz_soal $quiz_soal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quiz_soal  $quiz_soal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz_soal $quiz_soal)
    {
        //
        dd($request->all());
        try{
            $option = json_decode($request->option);
            $data = $quiz_soal->update($request->all());
            quiz_option::where('id_quiz_soal',$quiz_soal->id)->delete();
            foreach($option as $row){
                quiz_option::create([
                    'id_quiz_soal'=>$quiz_soal->id,
                    'question'=>$row->option,
                    'answer'=>$row->answer,
                    'score'=>$row->score,
                ]);
            }
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function editQuis(Request $request){
        try{
            $file = $request->file('gambar');
            $value = [
                'score_soal' => $request->score_soal,
                'answer' => $request->answer,
                'question' => $request->question,
                'id_quiz' => $request->id_quiz,
                'option' => $request->option,
            ];
            if($file){
                $filename = rand().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('kuis'), $filename);
                $value['gambar'] = $filename;
            }
    
            $option = json_decode($request->option);
            $request->gambar = 'oke';
            $data = quiz_soal::where('id',$request->id)->update($value);
            quiz_option::where('id_quiz_soal',$request->id)->delete();
            foreach($option as $row){
                quiz_option::create([
                    'id_quiz_soal'=>$request->id,
                    'question'=>$row->option,
                    'answer'=>$row->answer,
                    'score'=>$row->score,
                ]);
            }
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quiz_soal  $quiz_soal
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz_soal $quiz_soal)
    {
        //
        try{
            quiz_option::where('id_quiz_soal',$quiz_soal->id)->delete();
            $data = $quiz_soal->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
