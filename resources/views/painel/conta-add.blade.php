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
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="tipo[]" value="t" @if(!empty($conta) && $conta->tipo == 't') checked @endif>Transferência
              </label>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label">Título</label>
            <input class="form-control" type="text" name="titulo" value="{{$conta->titulo ?? ''}}" placeholder="Descreva a conta...">
          </div>

          <div class="form-group">
            <label class="control-label">Vencimento</label>
            <input class="form-control" type="text" id="demoDate" name="vencimento" value="{{$conta->vencimento ?? ''}}" placeholder="DD/MM/YYYY">
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
            <label class="control-label">Categoria</label>
            <select class="form-control" name="categoria">
              @foreach($categorias as $categoria)
              <option value="{{$categoria->id}}" @if(!empty($conta) && $conta->categoria_fk == $categoria->id) selected @endif>{{$categoria->nome}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="control-label">Pasta</label>
            <select class="form-control" name="pasta">
              @foreach($pastas as $pasta)
              <option value="{{$pasta->id}}" @if(!empty($conta) && $conta->pasta_fk == $pasta->id) selected @endif>{{$pasta->nome}}</option>
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
              <th>Categoria</th>
              <th>Pasta</th>
              <th>Valor (R$)</th>
              <th>Parcela</th>
              <th>Vencimento</th>
              <th>Efetivado?</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody>
            @foreach($contas as $conta)
            <tr>
              <td>{{$conta->id}}</td>
              <td>{{strtoupper($conta->tipo)}}</td>
              <td>{{$conta->titulo}}</td>
              <td>{{$conta->categoria->nome}}</td>
              <td>{{$conta->pasta->nome}}</td>
              <td>{{number_format($conta->valor, 2, ',', '')}}</td>
              <td>{{$conta->parcela}}</td>
              <td>{{date('d/m/Y', strtotime($conta->vencimento))}}</td>
              <td>{{$conta->efetivado ? 'Sim' : 'Não'}}</td>
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