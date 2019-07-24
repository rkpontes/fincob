@extends('painel.template')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Cadastrar Usuário</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="#">Cadastrar Usuário</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Formulário de @if(empty($usuario->id)) Cadastro @endif @if(!empty($usuario->id)) Alteração @endif</h3>
      <div class="tile-body">
        <form class="row" method="post" action="{{action('UsuarioController@store')}}">
          @csrf
          <input type="hidden" name="id" value="{{$usuario->id ?? ''}}" />
          <div class="form-group col-md-3">
            <label class="control-label">E-mail</label>
            <input class="form-control" type="email" name="email" value="{{$usuario->email ?? ''}}" placeholder="Insira seu e-mail" autofocus required>
          </div>
          <div class="form-group col-md-3">
            <label class="control-label">Senha</label>
            <input class="form-control" type="password" name="senha" placeholder="Insira sua senha" @if(empty($usuario->id)) required @endif>
          </div>
          <div class="form-group col-md-4 align-self-end">
            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>@if(empty($usuario->id)) Cadastrar @endif @if(!empty($usuario->id)) Alterar @endif</button>
          </div>
        </form>
      </div>
    </div>

    <hr />


    <div class="tile">
      <h3 class="tile-title">Listagem de Usuários</h3>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>E-mail</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $usuario)
            <tr>
              <td>{{$usuario->id}}</td>
              <td>{{$usuario->email}}</td>
              <td>
                <a href="{{route('usuario-edit', ['id' => $usuario->id]) }}">Alterar</a> |
                <a href="{{route('usuario-del', ['id' => $usuario->id]) }}" onclick=" return confirm('Deseja mesmo apagar o usuário selecionado?')">Remover</a>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>



  </div>
</div>
@endsection
