<?php

namespace App\Http\Controllers;

use App\Models\quiz_submission;
use Illuminate\Http\Request;

class QuizSubmissionController extends Controller
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
            $data = quiz_submission::all();
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
            $data = quiz_submission::create($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\quiz_submission  $quiz_submission
     * @return \Illuminate\Http\Response
     */
    public function show(quiz_submission $quiz_submission)
    {
        //
        try{
            $data = $quiz_submission->first();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\quiz_submission  $quiz_submission
     * @return \Illuminate\Http\Response
     */
    public function edit(quiz_submission $quiz_submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\quiz_submission  $quiz_submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quiz_submission $quiz_submission)
    {
        //
        try{   
            $data = $quiz_submission->update($request->all());
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\quiz_submission  $quiz_submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(quiz_submission $quiz_submission)
    {
        //
        try{
            $data = $quiz_submission->delete();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }

    public function getByChild(Request $req){
        try{
            $data = quiz_submission::where('id_child',$req->id_child)->get();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
