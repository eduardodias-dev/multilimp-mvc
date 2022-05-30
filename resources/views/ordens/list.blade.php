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
                       <th>Telefone</th>
                       <th>Endereço</th>
                       <th>Valor Total</th>
                       <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($list))
                    @foreach($list ?: [] as $item)
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
                            <td>{{$item->Telefone}}</td>
                            <td>{{$item->Endereco.', '.$item->Bairro.', '.$item->Cidade.'/'.$item->UF }}</td>
                            <td>{{$item->ValorTotal}}</td>
                            <td>
                                <a href="{{route('ordens.edit', ['id' => $item->OrdemServicoId])}}" class="btn btn-sm btn-info">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button href="{{route('ordens.del')}}" data-id="{{$item->OrdemServicoId}}" data-nome="{{$item->OrdemServicoId}}" class="btn btn-sm btn-danger btnExcluir" title="Excluir">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-primary btn-sm btnImprimirRelatorio" data-id="{{$item->OrdemServicoId}}" title="Imprimir Ordem de Serviço">
                                    <i class="fa fa-file"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- @empty
                            <tr>
                                <td colspan="9" class="text-center">Nenhum registro encontrado</td>
                            </tr> --}}

                    @endforeach
                    @endif
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
          <h4 class="modal-title">Excluir Ordem de Serviço</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Confirma a exclusão da ordem <span id="spanOrdem"></span> ?</p>
          <input type="hidden" name="ordemServicoId" />
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
  <div class="modal fade" id="modal-imprimir-ordem-servico">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ordem de Serviço</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="osbody" style="padding: 10px;">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          {{-- <button type="submit" class="btn btn-primary" id="btnImprimirOrdemServico">Imprimir</button> --}}
          <button type="submit" class="btn btn-primary" id="btnSalvarPDFOrdemServico">Salvar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div id="elementH"></div>
@endsection

@push('script_pagina')
    <script>
        $(document).ready(function(){
            $('.btnExcluir').click(function(e){
                e.preventDefault();
                var id = $(this).data('id');
                var nome = $(this).data('nome');

                $('#modal-exclusao').modal();
                $('#spanOrdem').html(nome);
                $('#modal-exclusao').find('[name=ordemServicoId]').val(id);
            });

            $('#btnSalvarExclusao').click(function(){
                var id = $('#modal-exclusao').find('[name=ordemServicoId]').val();
                $.ajax({
                    headers: {"X-CSRF-TOKEN": "{{ csrf_token() }}",},
                    method: 'DELETE',
                    url: '{{ route("ordens.del")}}',
                    data: {id}
                }).done(function(result){
                    if(result != 0){
                        $('#modal-exclusao').modal('hide');
                        window.location.reload();
                    }

                    console.log(result);


                });
            });

            $('.btnImprimirRelatorio').click(function(){
                var id = $(this).data('id');
                console.log(id);
                $('#modal-imprimir-ordem-servico').modal();
                $('#btnImprimirOrdemServico').prop('disabled', true);
                $.ajax({
                    url: '{{route("ordens.getprint")}}',
                    method: 'get',
                    data: {id}
                }).done(function(result){
                    if(result != 'false'){
                        $('#osbody').html(result);
                        $('#btnImprimirOrdemServico').prop('disabled', false);
                    }
                });

            });
            $('#btnImprimirOrdemServico').click(function(){

            });
            $('#btnSalvarPDFOrdemServico').click(function(){
                var element = $('#osbody').html();
                var opt = {
                    margin: 10,
                    filename: 'ordem-servico.pdf'
                };
                html2pdf().set(opt).from(element).save();
            });
        })
    </script>
@endpush

