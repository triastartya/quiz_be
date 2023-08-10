<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    //
    public function getAllUser(){
        return Response()->json(User::where('jenis_user',1)->get());
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    public function login(Request $request){
        try{
            $checkUsername = User::where('email',$request->username)->orWhere('no_hp', $request->username)->where('jenis_user',3)->first();
            if($checkUsername){
                $checkPassword = User::where('email',$request->username)
                                ->orWhere('no_hp', $request->username)
                                ->where('password',md5($request->password))->first();
                if($checkPassword){
                    $request->session()->put('data',$checkPassword);
                    return Response()->json(['status'=>true,'message'=>null,'data'=>$checkPassword]);
                }else{
                    return Response()->json(['status'=>false,'message'=>'Password Salah','data'=>null]);    
                }
            }else{
                return Response()->json(['status'=>false,'message'=>'email Tidak Di Temukan','data'=>null]);
            }
        }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>$exception->getMessage(),'data'=>null]);
        }
    }

    public function login_admin(Request $request){
        try{
            $checkUsername = User::where('email',$request->username)->first();
            if($checkUsername){
                $checkPassword = User::where('password',md5($request->password))->first();
                if($checkPassword){
                    $request->session()->put('data',$checkPassword);
                    return Response()->json(['status'=>true,'message'=>null,'data'=>$checkPassword]);
                }else{
                    return Response()->json(['status'=>false,'message'=>'Password Salah','data'=>null]);    
                }
            }else{
                return Response()->json(['status'=>false,'message'=>'email Tidak Di Temukan','data'=>null]);
            }
        }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>$exception->getMessage(),'data'=>null]);
        }
    }

    public function postUser(Request $request){
        try{
            $data = new User;
            $data->email = $request->email;
            $data->password = md5($request->password);
            $data->name     = $request->nama;
            $data->no_hp= $request->no_hp;
            $data->alamat = $request->alamat;
            $data->jenis_user = 1;
            $data->save();
            return Response()->json(['status'=>true,'message'=>null,'data'=>$data]);
        }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>$exception->getMessage(),'data'=>null]);
        }
    }

    public function register(Request $request){
        try{
            $data = new User;
            $data->email = $request->email;
            $data->password = md5($request->password);
            $data->name     = $request->nama;
            $data->no_hp= $request->no_hp;
            $data->no_hp_ortu= $request->no_hp_ortu;
            $data->alamat = $request->alamat;
            $data->jenis_user = 3;
            $data->save();
            return Response()->json(['status'=>true,'message'=>null,'data'=>$data]);
        }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>$exception->getMessage(),'data'=>null]);
        }
    }

    public function editUser(Request $request){
        try{
            $data = User::where('id',$request->id)->first();
            $data->email = $request->email;
            // $data->password = md5($request->password);
            $data->name = $request->nama;
            $data->no_hp = $request->no_hp;
            $data->alamat = $request->alamat;
            $data->save();
            return Response()->json(['status'=>true,'message'=>null,'data'=>$data]);
        }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>$exception->getMessage(),'data'=>null]);
        }
    }

    public function deleteUser(Request $request){
        // try{
        //     $data = User::where('id','=',$request->id)->delete();
        //     return Response()->json(array('status'=>true,'message'=>null),201);
        // }catch (\Exception $exception) {
            return Response()->json(['status'=>false,'message'=>'user tidak bisa di hapus','data'=>null]);
        // }
    }

    public function guru(){
        $data = User::where('jenis_user',2)->get();
        return Response()->json(['status'=>true,'data'=>$data]);
    }

    public function pengguna(){
        $data = User::where('jenis_user',3)->get();
        return Response()->json(['status'=>true,'data'=>$data]);
    }
}
