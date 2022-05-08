@extends('layouts.index')
@section('title', 'Adicionar Cliente')
@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Adicionar Cliente</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('clientes.addaction')}}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label for="cpfcnpj">CPF/CNPJ</label>
                        <input type="text" class="form-control" name="cpfcnpj" placeholder="CPF/CNPJ">
                    </div>

                    <div class="form-group">
                        <label >Status</label>
                        <select name="status" id="status" class="form-control">
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
