<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    
    public function index(){
        return view('login');
    }

    public function painel(){
        return view('painel.index');
    }

    public function show(){}

    public function create(){}

    public function store(){}

    public function edit(){}
    
    public function update(){}

    public function delete(){}

}
