<?php

namespace App\Http\Controllers;

use App\Models\child;
use App\Models\quiz_submission;
use App\Models\quiz_submission_jawaban;
use App\Models\quiz_submission_master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizReportController extends Controller
{
    //
    public function report(Request $request){
        DB::beginTransaction();
        try{
            $data = [];
            $m_benar = 0;
            $m_max=0;
            foreach($request->data as $jenis){
                $benar = 0;
                //====== Scoring 
                if($jenis['scoring']==1){
                    foreach($jenis['soal'] as $soal){
                        $benar = $benar + (int)$soal['answer'];
                    }
                    $score = ($benar/(int)$jenis['max_score'])*100;
                    $status = 'oke';
                    $color = '';
                    if($score>80){
                        $status = 'baik';
                        $color = 'text-green-500';
                    }
                    if($score>=60 && $score<=80){
                        $status = 'cukup';
                        $color = 'text-yellow-400';
                    }
                    if($score<60){
                        $status = 'kurang';
                        $color = 'text-red-500';
                    }
                    $data[] = [
                        'id_child'=>$request->id_child,
                        'id_quiz'=>$jenis['id'],
                        'jenis_quiz' =>$jenis['id'],
                        'is_passed' => true,
                        'answer' => json_encode($jenis),
                        'jawaban' => (int)$jenis['max_score'],
                        'benar' =>$benar,
                        'score' =>$score,
                        'color' => $color,
                        'status' => $status
                    ];
                }else{
                    $data[] = [
                        'id_child'=>$request->id_child,
                        'id_quiz'=>$jenis['id'],
                        'jenis_quiz' =>$jenis['id'],
                        'is_passed' => true,
                        'answer' => json_encode($jenis),
                        'jawaban' => (int)$jenis['max_score'],
                        'benar' =>0,
                        'score' =>0,
                        'color' => 'ok',
                        'status' => 'tidak di scoring'
                    ];
                }
                
                $m_benar = $m_benar + $benar;
                $m_max = $m_max + (int)$jenis['max_score'];
                
            }
            
            $m_score =  ($m_benar/$m_max)*100;
            $m_status = 'oke';
            if($m_score>80){
                $m_status = 'baik';
            }
            if($m_score>=60 && $score<=80){
                $m_status = 'cukup';
            }
            if($m_score<60){
                $m_status = 'kurang';
            }
            
            $master = quiz_submission_master::create([
                'id_child'=>$request->id_child,
                'jawaban' =>$m_max,
                'benar' => $m_benar,
                'score' => $m_score,
                'color' => 'ok',
                'status' => $m_status
            ]);
            
            foreach($data as $hasil){
                $hasil['id_master'] = $master->id;
                quiz_submission::create($hasil);
            }
            
            DB::commit();
            return response()->json(['status'=>true,'data'=>$master]);
            
        }catch(\Exception $ex) {
            DB::rollBack();
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
        
    }
    
    public function getReport(Request $request){
        $data = quiz_submission_master::with('child','quiz_submission.quiz')->where('id',$request->id)->first();
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function hasil(){
        $data = quiz_submission_master::with('child','quiz_submission')->get();
        return response()->json(['status'=>true,'data'=>$data]);
    }
    
    public function setJawaban(){
        DB::beginTransaction();
        try{
            $data = child::with('quiz_submission_master.quiz_submission')->get();
            foreach($data as $anak){
                if(count($anak->quiz_submission_master)){
                    foreach($anak->quiz_submission_master as $input_soal){
                        if(count($input_soal->quiz_submission)){
                            foreach($input_soal->quiz_submission as $jenis_soal){
                                if(count($jenis_soal->answer->soal)){
                                    foreach($jenis_soal->answer->soal as $soal){
                                        if(count($soal->options)){
                                            foreach($soal->options as $options){
                                                if($options->jawaban){
                                                    quiz_submission_jawaban::create([
                                                        'id_anak'=>$anak->id,
                                                        'anak' =>$anak->nama,
                                                        'id_submission' => $jenis_soal->id,
                                                        'id_quiz' => $jenis_soal->id_quiz,
                                                        'quiz' => $jenis_soal->answer->title,
                                                        'id_quiz_soal' => $soal->id,
                                                        'soal' => $soal->question,
                                                        'is_isian' => $soal->is_isian,
                                                        'id_quiz_option' => $options->id,
                                                        'jawaban' => $options->question,
                                                        'isian' => $options->isian,
                                                        'score' => $options->score,
                                                    ]);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            DB::commit();
            return response()->json(['status'=>true,'data'=>$data]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
    
    public function jawaban(){
        $jawaban = [];
        try{
            $data = child::with('quiz_submission_master.quiz_submission')->get();
            foreach($data as $anak){
                if(count($anak->quiz_submission_master)){
                    foreach($anak->quiz_submission_master as $input_soal){
                        if(count($input_soal->quiz_submission)){
                            foreach($input_soal->quiz_submission as $jenis_soal){
                                if(count($jenis_soal->answer->soal)){
                                    foreach($jenis_soal->answer->soal as $soal){
                                        if(count($soal->options)){
                                            foreach($soal->options as $options){
                                                if($options->jawaban){
                                                    $jawaban[] = [
                                                        'id_anak'=>$anak->id,
                                                        'anak' =>$anak->nama,
                                                        'tangal_input' => $input_soal->created_at,
                                                        'id_submission' => $jenis_soal->id,
                                                        'id_quiz' => $jenis_soal->id_quiz,
                                                        'quiz' => $jenis_soal->answer->title,
                                                        'id_quiz_soal' => $soal->id,
                                                        'soal' => $soal->question,
                                                        'is_isian' => $soal->is_isian,
                                                        'id_quiz_option' => $options->id,
                                                        'jawaban' => $options->question,
                                                        'isian' => $options->isian,
                                                        'score' => $options->score,
                                                    ];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return response()->json(['status'=>true,'data'=>$jawaban]);
        } catch (\Exception $ex) {
            return response()->json(['status'=>false,'data'=>[],'message'=>$ex->getMessage()]);
        }
    }
}
