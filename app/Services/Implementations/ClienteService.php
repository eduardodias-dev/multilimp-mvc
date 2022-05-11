<?php

namespace App\Services\Implementations;

use App\Models\Cliente;
use App\Services\Interfaces\IClienteService;
use Exception;
use Illuminate\Support\Facades\DB;

class ClienteService implements IClienteService{

    public function getClienteById($id)
    {
        $cliente = Cliente::find($id);

        return $cliente;
    }
    public function addCliente(array $cliente){
        try{
            $clienteModel = new Cliente();

            $clienteModel->nome = $cliente['nome'];
            $clienteModel->cpfcnpj = $cliente['cpfcnpj'];
            $clienteModel->status = $cliente['status'];

            return $clienteModel->save();
        }
        catch(Exception $e){
            die($e->getMessage());
            return $e->getMessage() ;
        }
    }

    public function listClientes(array $filter = null)
    {
        try{
            $list = Cliente::all();

            return $list;

        }catch(Exception $e){

            return $e->getMessage();
        }
    }
    public function editCliente(array $cliente){
        try{
            $result = Cliente::where('id', $cliente['id'])->update([
                'nome' => $cliente['nome'],
                'cpfcnpj' => $cliente['cpfcnpj'],
                'status' => $cliente['status'],
                'id' => $cliente['id']
            ]);

            return $result;

        }catch(Exception $e){
            $e->getMessage();
        }
    }

    public function deleteCliente($clienteid){
        try{
            $clienteModel = Cliente::find($clienteid);

            return $clienteModel->delete();

        }catch(Exception $e){
            // return $e->getMessage();
            $e->getMessage();
            return 0;
        }
    }
}
