<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class UploadFileController extends Controller
{
    //
    function edukasi(Request $request){
        $file = $request->file('file');
        
        $filename = $request->edukasi.'.'.$file->getClientOriginalExtension();

        $file->move(public_path('edukasi'), $filename);
        
        $sts = back()->with('success','You have successfully upload edukasi.')->with('pdf',$filename);

        $data = json_decode($request->data);

        return Response()->json(array('status'=>200,'message'=>null,'result'=>$data),200);
    }
}
