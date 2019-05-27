@extends('painel.template')

@section('title', 'Cadastrar Conta')

@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Cadastrar Conta</h1>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="#">Cadastrar Conta</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <h3 class="tile-title">Formulário de Cadastro</h3>
      <div class="tile-body">
        <form method="post" action="{{action('ContaController@store')}}">
          @csrf
          
          <div class="form-group">
            <label class="control-label">Tipo da Conta</label>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo[]" value="r" checked>Receita
              </label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo[]" value="d">Despesa
              </label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label">Título</label>
            <input class="form-control" type="text" name="titulo" placeholder="Descreva a conta...">
          </div>
          
          <div class="form-group">
            <label class="control-label">Valor</label>
            <input class="form-control" type="number" name="valor" placeholder="0,00">
          </div>

          <div class="form-group">
            <label class="control-label">Parcelas</label>
            <select class="form-control" name="parcela">
              @foreach(range(1, 12) as $parcela)
              <option value="{{$parcela}}">{{$parcela}}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="efetivado">Conta efetivada?
              </label>
            </div>
          </div>
          <hr />
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Cadastrar</button>
        </form>
      </div>
    </div>

    <hr />


    <div class="tile">
      <h3 class="tile-title">Listagem de Contas</h3>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Tipo</th>
              <th>Titulo</th>
              <th>Valor (R$)</th>
              <th>Efetivado?</th>
              <th>Parcela</th>
              <th>Criado</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contas as $conta)
            <tr>
              <td>{{$conta->id}}</td>
              <td>{{strtoupper($conta->tipo)}}</td>
              <td>{{$conta->titulo}}</td>
              <td>{{number_format($conta->valor, 2, ',', '')}}</td>
              <td>{{$conta->efetivado ? 'Sim' : 'Não'}}</td>
              <td>{{$conta->parcela}}</td>
              <td>{{date('d/m/Y H:i', strtotime($conta->data_conta))}}</td>
              <td>
                <a href="#">Alterar</a> | <a href='#' onclick=" return confirm('Deseja mesmo apagar o usuário selecionado?')">Remover</a>
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