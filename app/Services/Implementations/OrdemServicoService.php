<?php

namespace App\Services\Implementations;

use App\Models\Cliente;
use App\OrdemServico;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\Interfaces\IOrdemServicoService;
use App\Services\Interfaces\IClienteService;

class OrdemServicoService implements IOrdemServicoService{

    private $clienteService;
    public function __construct(IClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function getOrdemServicoById($id){
        try{
            $ordemServico = OrdemServico::find($id);

            return $ordemServico;
        }catch(Exception $e){
            return $e->getMessage();
        }

    }
    public function listOrdemServicos(array $filter){
        try{
            $list = OrdemServico::all();

            foreach($list as $ordem){
                $cliente = $this->clienteService->getClienteById($ordem->ClienteId);

                if(!empty($cliente))
                    $ordem->nomeCliente = $cliente->nome;
            }

            return $list;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function addOrdemServico(array $ordemServico){
        try{
            $ordemServicoEntity = new OrdemServico;

            $ordemServicoEntity->ClienteId = $ordemServico['clienteId'];
            $ordemServicoEntity->Status = $ordemServico['status'];
            $ordemServicoEntity->Descricao = $ordemServico['descricao'];
            $ordemServicoEntity->Observacoes = $ordemServico['observacoes'];
            $ordemServicoEntity->DataAgendamento = $ordemServico['dataagendamento'];
            $ordemServicoEntity->DataExecucao = $ordemServico['dataexecucao'];
            $ordemServicoEntity->Valor = $ordemServico['valor'];
            $ordemServicoEntity->Desconto = $ordemServico['desconto'];
            $ordemServicoEntity->ValorTotal = $ordemServico['valor'] - abs($ordemServico['desconto']); //$ordemServico['valorTotal'];
            $ordemServicoEntity->Telefone = $ordemServico['telefone'];
            $ordemServicoEntity->Endereco = $ordemServico['endereco'];
            $ordemServicoEntity->Bairro = $ordemServico['bairro'];
            $ordemServicoEntity->Cidade = $ordemServico['cidade'];
            $ordemServicoEntity->UF = $ordemServico['uf'];

            $ordemServicoEntity->save();

        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function editOrdemServico(array $ordemServico){
        try{
            //die(print_r($ordemServico));

            $result = OrdemServico::where('OrdemServicoId', $ordemServico['ordemServicoId'])->update([
                'ClienteId' => $ordemServico['clienteId'],
                'Status' => $ordemServico['status'],
                'Descricao' => $ordemServico['descricao'],
                'Observacoes' => $ordemServico['observacoes'],
                'DataAgendamento' => $ordemServico['dataagendamento'],
                'DataExecucao' => $ordemServico['dataexecucao'],
                'Valor' => $ordemServico['valor'],
                'Desconto' => $ordemServico['desconto'],
                'ValorTotal' => $ordemServico['valor'] - abs($ordemServico['desconto']),
                'Telefone' => $ordemServico['telefone'],
                'Endereco' => $ordemServico['endereco'],
                'Bairro' => $ordemServico['bairro'],
                'Cidade' => $ordemServico['cidade'],
                'UF' => $ordemServico['uf']
            ]);

            return $result;

        }catch(Exception $e){
            die($e->getMessage());
            return $e->getMessage();
        }
    }
    public function deleteOrdemServico($ordemServicoid){
        try{
            $ordemModel = OrdemServico::find($ordemServicoid);

            return $ordemModel->delete();

        }catch(Exception $e){
            // return $e->getMessage();
            $e->getMessage();
            return 0;
        }
    }

}
