@extends('layouts.index')
@section('title', 'Listagem de Ordens')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
        @if(session('Erro'))
            <div class="alert alert-warning alert-dismissible fade show">
                <strong>Alerta! </strong>
                <ul>
                    <li>{{session('Erro')}}</li>
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listagem de Ordens</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('ordens.add')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Novo
                </a>
                <br />
                <br />
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Id</th>
                       <th>Descrição</th>
                       <th>Nome Cliente</th>
                       <th>Status</th>
                       <th>Data Agendamento</th>
                       <th>Valor Total</th>
                       <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                        <tr>
                            <td>{{$item->OrdemServicoId}}</td>
                            <td>{{$item->Descricao}}</td>
                            <td>{{$item->nomeCliente}}</td>
                            <td>
                                @switch($item->Status)
                                    @case(1)
                                        Agendado
                                        @break
                                    @case(2)
                                        Executado
                                        @break
                                    @case(3)
                                        Cancelado
                                        @break
                                    @default
                                        Sem status
                                @endswitch</td>
                            <td>{{$item->DataAgendamento}}</td>
                            <td>{{$item->ValorTotal}}</td>
                            <td>
                                <a href="{{route('ordens.edit', ['id' => $item->OrdemServicoId])}}" class="btn btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{route('ordens.del', ['id' => $item->OrdemServicoId])}}" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Nenhum registro encontrado</td>
                            </tr>

                    @endforelse
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


