<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class ApiLoginController extends Controller
{
    
    public function login(Request $request){

        //return response()->json($request);
        
        $usuario = User::where('email', $request->email)->first();
            
        if($usuario && Hash::check($request->senha, $usuario->password)){
            return response()->json($usuario);
        }else{
            return response()->json(['message'   => 'Record not found'], 404);
        }
        
    }

}
