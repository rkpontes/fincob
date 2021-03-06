@extends('painel.template')

@section('title', 'Início')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-home"></i> Início</h1>
    <p>Comece uma jornada bonita aqui</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="#">Início</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">Crie um lindo painel</div>
    </div>
  </div>
</div>
@endsection