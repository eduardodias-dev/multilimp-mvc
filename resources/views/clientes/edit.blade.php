@extends('layouts.index')
@section('title', 'Editar Cliente')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Editar Cliente</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('clientes.editaction', ['id' => $cliente->id])}}" method="POST">
                    @csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{$cliente->id}}"/>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{$cliente->nome}}">
                    </div>
                    <div class="form-group">
                        <label for="cpfcnpj">CPF/CNPJ</label>
                        <input type="text" class="form-control" name="cpfcnpj" placeholder="CPF/CNPJ" value="{{$cliente->cpfcnpj}}">
                    </div>

                    <div class="form-group">
                        <label >Status</label>
                        <select name="status" id="status" class="form-control" value="{{$cliente->status}}">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
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
