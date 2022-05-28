@extends('layouts.index')
@section('title', 'Adicionar Ordem de Serviço')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

            @if($errors->any())
                <div class="alert alert-warning alert-dismissible fade show">
                    <strong>Alerta! </strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Adicionar Ordem de Serviço</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('ordens.addaction')}}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="clienteId">Cliente</label>
                        <select name="clienteId" class="form-control">
                            <option>Selecione...</option>
                            @foreach ($listClientes as $cliente)
                                <option value="{{$cliente->id}}">{{$cliente->id}} - {{$cliente->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option>Selecione...</option>
                            <option value="1">Agendado</option>
                            <option value="2">Executado</option>
                            <option value="3">Cancelado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Descricao</label>
                        <input type="text" name="descricao" placeholder="" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data Agendamento</label>
                                    <input type="date" name="dataagendamento" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data Execução</label>
                                    <input type="date" name="dataexecucao" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" name="telefone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Endereço</label>
                                    <input type="text" name="endereco" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Bairro</label>
                                    <input type="text" name="bairro" class="form-control" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Cidade</label>
                                    <input type="text" name="cidade" class="form-control" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>UF</label>
                                    <input type="text" name="uf" class="form-control" maxlength="2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input type="number" name="valor" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Desconto</label>
                                    <input type="number" name="desconto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Valor Total</label>
                                    <input type="number" name="valorTotal" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Observações</label>
                        <textarea name="observacoes" class="form-control" id="" rows="3"></textarea>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        Salvar
                    </button>
                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
</section>

@endsection
