<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\User;

class LoginController extends Controller
{
    
    public function form(){
        if(Auth::user())
            return view('painel.index');
        else
            return view('login');
    }

    public function login(Request $request){
        
        $request->validate([
            'login' => 'required',
            'senha' => 'required'
        ]);

        $lembrar = empty($request->lembrar) ? false : true;

        $usuario = User::where('email', $request->login)->first();
            
        if($usuario && Hash::check($request->senha, $usuario->password)){
            Auth::loginUsingId($usuario->id, $lembrar);
        }
        
        return redirect()->action('LoginController@form');
    }

    public function create(){
        return view('cadastro');
    }

    public function store(Request $request){
        $usuario = new User;
        $usuario->email = $request->login;
        $usuario->password = bcrypt($request->senha);
        $usuario->ativo = 1;
        $usuario->save();

        return redirect()->action('LoginController@form');

    }

}
