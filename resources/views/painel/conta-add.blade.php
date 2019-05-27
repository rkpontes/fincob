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
      <h3 class="tile-title">Formulário de @if(empty($conta)) Cadastro @endif @if(!empty($conta)) Alteração @endif</h3>
      <div class="tile-body">
        <form method="post" action="{{action('ContaController@store')}}">
          @csrf
          
          <input type="hidden" name="id" value="{{$conta->id ?? ''}}" />
          <div class="form-group">
            <label class="control-label">Tipo da Conta</label>
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo[]" value="r" @if(empty($conta)) checked @endif @if(!empty($conta) && $conta->tipo == 'r') checked @endif>Receita
              </label>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo[]" value="d" @if(!empty($conta) && $conta->tipo == 'd') checked @endif>Despesa
              </label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label">Título</label>
            <input class="form-control" type="text" name="titulo" value="{{$conta->titulo ?? ''}}" placeholder="Descreva a conta...">
          </div>
          
          <div class="form-group">
            <label class="control-label">Valor</label>
            <input class="form-control" type="number" name="valor" value="{{$conta->valor ?? ''}}" placeholder="0,00">
          </div>

          <div class="form-group">
            <label class="control-label">Parcelas</label>
            <select class="form-control" name="parcela" @if(!empty($conta)) disabled @endif>
              @foreach(range(1, 12) as $parcela)
              <option value="{{$parcela}}">{{$parcela}}</option>
              @endforeach
            </select>
          </div>
          
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="efetivado" @if(!empty($conta) && $conta->efetivado == true) checked @endif >Conta efetivada?
              </label>
            </div>
          </div>
          <hr />
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>@if(empty($conta)) Cadastrar @endif @if(!empty($conta)) Alterar @endif</button>
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
                <a href="/conta/edit/{{$conta->id}}">Alterar</a> | 
                <a href='/conta/del/{{$conta->id}}' onclick=" return confirm('Deseja mesmo apagar a conta selecionada?')">Remover</a>
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