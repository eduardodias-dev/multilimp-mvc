<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IClienteService;
use App\Services\Interfaces\IOrdemServicoService;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    private $ordemServicoService;
    private $clienteService;

    public function __construct(IOrdemServicoService $ordemServicoService, IClienteService $clienteService){
        $this->ordemServicoService = $ordemServicoService;
        $this->clienteService = $clienteService;
    }
    //
    public function list(){
        $list = $this->ordemServicoService->listOrdemServicos([]);

        return view('ordens.list',['list'=>$list]);
    }

    public function add(){
        $listClientes = $this->clienteService->listClientes([]);

        return view('ordens.add', ['listClientes' => $listClientes]);
    }

    public function addAction(Request $request){
        $this->ordemServicoService->addOrdemServico($request->all());

        return redirect()->route('ordens.list');
    }

    public function edit($id){
        $ordemServico = $this->ordemServicoService->getOrdemServicoById($id);
        $listClientes = $this->clienteService->listClientes([]);

        if(!empty($ordemServico)){
            $ordemServico->DataExecucao = \Carbon\Carbon::parse($ordemServico->DataExecucao)->translatedFormat('Y-m-d');
            $ordemServico->DataAgendamento = \Carbon\Carbon::parse($ordemServico->DataAgendamento)->translatedFormat('Y-m-d');

            return view('ordens.edit', ['ordemServico' => $ordemServico, 'listClientes' => $listClientes]);
        }
        else
            return redirect()->route('ordens.list')->with('Erro', 'Ordem de Serviço não encontrada.');

    }

    public function editAction(Request $request, $id){
        $ordemServico = $request->all();

        $result = $this->ordemServicoService->editOrdemServico($ordemServico);

        return redirect()->route('ordens.list');
    }

    public function delete(Request $request){
        // die($request->input('id'));
        $id = $request->input('id');

        $result = $this->ordemServicoService->deleteOrdemServico($id);

        return $result;
    }

    public function getOrdemServicoPrint(Request $request){
        $id = $request->only(['id']);
        $ordemServico = $this->ordemServicoService->getOrdemServicoById($id);

        //die(print_r($ordemServico[0]));
        if(!empty($ordemServico)){
            $ordemServico = $ordemServico[0];

            $ordemServico->DataExecucao = \Carbon\Carbon::parse($ordemServico->DataExecucao)->translatedFormat('d/m/Y');
            $ordemServico->DataAgendamento = \Carbon\Carbon::parse($ordemServico->DataAgendamento)->translatedFormat('d/m/Y');
            $ordemServico->Valor = number_format($ordemServico->Valor, 2,',','.');
            $ordemServico->ValorTotal = number_format($ordemServico->ValorTotal, 2,',','.');
            $ordemServico->Desconto = number_format($ordemServico->Desconto, 2,',','.');

            $cliente = $this->clienteService->getClienteById($ordemServico->ClienteId);


            return view('ordens.layout-ordem-servico', ['ordemServico' => $ordemServico, 'cliente' => $cliente]);
        }

        return false;
    }
}
