@extends('layouts.index')
@section('title', 'Listagem de Ordens')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listagem de Ordens</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Id</th>
                       <th>Nome</th>
                       <th>CPF/CNPJ</th>
                       <th>Status</th>
                       <th>Data Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse($list as $item)
                        <tr>
                            <td>{{$item['id']}}</td>
                            <td>{{$item['nome']}}</td>
                            <td>{{$item['cpfcnpj']}}</td>
                            <td>{{$item['status']}}</td>
                            <td>{{$item['dtcadastro']}}</td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum registro encontrado</td>
                            </tr>

                    @endforelse --}}
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection


