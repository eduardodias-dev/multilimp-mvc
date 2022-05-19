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

    }
}
