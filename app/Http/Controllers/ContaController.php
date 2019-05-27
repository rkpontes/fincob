<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Conta;
use App\Models\UsuariosConta;
use App\Models\Categoria;
use App\Models\Pasta;

class ContaController extends Controller
{
    
    public function index(){}

    public function show(){}

    public function create(){
        $contas = Auth::user()->contas;
        $categorias = Categoria::orderBy('nome')->get();
        $pastas = Pasta::orderBy('nome')->get();
        return view('painel.conta-add', compact('contas', 'categorias', 'pastas'));
    }

    public function store(Request $request){
        //dd($request);

        if($request->id){

            $conta = Conta::find($request->id);
            $conta->tipo = $request->tipo[0];
            $conta->titulo = $request->titulo;
            $conta->valor = $request->valor;
            $conta->vencimento = date_format(date_create_from_format('d/m/Y', $request->vencimento), 'Y-m-d');
            $conta->categoria_fk = $request->categoria;
            $conta->pasta_fk = $request->pasta;
            
            ($request->efetivado && !$conta->efetivado) ? $conta->data_efetivacao = date('Y-m-d H:i:s') : $conta->data_efetivacao = null; 
            $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
            
            $conta->save();

        }else{
            if($request->parcela > 1){
           
                foreach(range(1, $request->parcela) as $parcela){
                    $conta = new Conta;
                    $conta->tipo = $request->tipo[0];
                    $conta->titulo = $request->titulo . " ( {$parcela} / {$request->parcela} )";
                    $conta->valor = $request->valor;
                    $conta->vencimento = date_format(date_create_from_format('d/m/Y', $request->vencimento), 'Y-m-d');
                    $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
                    $conta->parcela = $parcela;
                    $conta->data_conta = date('Y-m-d H:i:s');
                    $conta->categoria_fk = $request->categoria;
                    $conta->pasta_fk = $request->pasta;
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
                $conta->vencimento = date_format(date_create_from_format('d/m/Y', $request->vencimento), 'Y-m-d');
                $request->efetivado ? $conta->efetivado = 1 : $conta->efetivado = 0;
                $conta->parcela = 1;
                $conta->data_conta = date('Y-m-d H:i:s');
                $conta->categoria_fk = $request->categoria;
                $conta->pasta_fk = $request->pasta;
                $conta->save();
    
                $uc = new UsuariosConta;
                $uc->usuario_pfk = Auth::user()->id;
                $uc->conta_pfk = Conta::orderBy('id', 'desc')->first()->id;
                $uc->save();
            }
        }

        return redirect()->action('ContaController@create');
        
    }

    public function edit($id){
        $conta = Conta::find($id);

        $contas = Auth::user()->contas;
        $categorias = Categoria::orderBy('nome')->get();
        $pastas = Pasta::orderBy('nome')->get();

        if($conta)
            return view('painel.conta-add', compact('contas', 'conta', 'categorias', 'pastas'));
        else
            return redirect()->action('ContaController@create');

    }

    public function update(){}

    public function destroy($id){
        $conta = Conta::find($id);
        $conta->delete();        
        return redirect()->action('ContaController@create');
    }


}
