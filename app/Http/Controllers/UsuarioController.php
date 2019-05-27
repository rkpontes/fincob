<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    
    public function index(){}

    public function show(){}

    public function create(){

        $usuarios = Usuario::where('ativo', 1)->get();
        return view('painel.usuario-add', compact('usuarios'));
    }

    public function store(Request $request){
        //dd($request);

        if($request->id){
            $u = Usuario::find($request->id);
            $u->email = $request->email;
            $request->senha ? $u->password = bcrypt($request->senha) : null;
            $u->ativo = 1;
            $u->save();
        }else{
            $u = new Usuario;
            $u->email = $request->email;
            $u->password = bcrypt($request->senha);
            $u->ativo = 1;
            $u->save();
        }

        return redirect()->action('UsuarioController@create');

    }

    public function edit($id){
        
        $usuario = Usuario::find($id);
        $usuarios = Usuario::where('ativo', 1)->get();

        if($usuario)
            return view('painel.usuario-add', compact('usuarios','usuario'));
        else
            return redirect()->action('UsuarioController@create'); 
    }
    
    public function update(){}

    public function destroy($id){
        $usuario = Usuario::find($id);
        $usuario->ativo = 0;
        $usuario->save();
        return redirect()->action('UsuarioController@create');
    }

}
