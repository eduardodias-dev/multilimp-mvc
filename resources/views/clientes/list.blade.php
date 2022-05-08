@extends('layouts.index')
@section('title', 'Listagem de clientes')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Listagem de Clientes</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{route('clientes.add')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    Novo
                </a>
                <br />
                <br />
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                       <th>Id</th>
                       <th>Nome</th>
                       <th>CPF/CNPJ</th>
                       <th>Status</th>
                       <th>Data Cadastro</th>
                       <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{$item->nome}}</td>
                            <td>{{$item->cpfcnpj}}</td>
                            <td>
                                @if($item->status === 1) Ativo
                                    @else Inativo
                                @endif
                            </td>
                            <td>{{$item->dtcadastro}}</td>
                            <td>
                                <a href="{{route('clientes.edit', ['id' => $item->id])}}" class="btn btn-sm btn-info" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button href="{{route('clientes.del')}}" data-id="{{$item->id}}" data-nome="{{$item->nome}}" class="btn btn-sm btn-danger btnExcluir" title="Excluir">
                                    <i class="fa fa-trash"></i>
                                </button>
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

  <div class="modal fade" id="modal-exclusao">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Excluir Cliente</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Confirma a exclusão do cliente <span id="spanCliente"></span> ?</p>
          <input type="hidden" name="clienteId" />
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btnSalvarExclusao">Salvar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection

@push('script_pagina')
    <script>
        $(document).ready(function(){
            $('.btnExcluir').click(function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var nome = $(this).data('nome');

                $('#modal-exclusao').modal();
                $('#spanCliente').html(nome);
                $('#modal-exclusao').find('[name=clienteId]').val(id);
            });

            $('#btnSalvarExclusao').click(function(){
                var id = $('#modal-exclusao').find('[name=clienteId]').val();
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}",},
                    method: 'DELETE',
                    url: '{{ route("clientes.del")}}',
                    data: {id}
                }).done(function(result){
                    if(result != 0){
                        $('#modal-exclusao').modal('hide');
                        window.location.reload();
                    }

                    console.log(result);


                });
            });
        })
    </script>
@endpush


