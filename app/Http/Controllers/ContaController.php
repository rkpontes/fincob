<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Conta;
use App\Models\UsuariosConta;

class ContaController extends Controller
{
    
    public function index(){}

    public function show(){}

    public function create(){
        $contas = Conta::all();
        return view('painel.conta-add', compact('contas'));
    }

    public function store(Request $request){
        //dd($request);

        if($request->parcela > 1){
           
            foreach(range(1, $request->parcela) as $parcela){
                $conta = new Conta;
                $conta->tipo = $request->tipo[0];
                $conta->titulo = $request->titulo . " ( {$parcela} / {$request->parcela} )";
                $conta->valor = $request->valor;
                $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
                $conta->parcela = $parcela;
                $conta->data_conta = date('Y-m-d H:i:s');
                $conta->save();

                $uc = new UsuariosConta;
                $uc->usuario_pfk = Auth::user()->id;
                $uc->conta_pfk = Conta::orderBy('id', 'desc')->first()->id;
                $uc->save();
            }

        }else{
            $conta = new Conta;
            $conta->tipo = $request->tipo[0];
            $conta->titulo = $request->titulo;
            $conta->valor = $request->valor;
            $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
            $conta->parcela = 1;
            $conta->data_conta = date('Y-m-d H:i:s');
            $conta->save();

            $uc = new UsuariosConta;
            $uc->usuario_pfk = Auth::user()->id;
            $uc->conta_pfk = Conta::orderBy('id', 'desc')->first()->id;
            $uc->save();
        }

        

        return redirect()->action('ContaController@create');
        
    }

    public function edit(){}

    public function update(){}

    public function destroy(){}


}
