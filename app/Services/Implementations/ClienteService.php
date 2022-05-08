<?php

namespace App\Services\Implementations;

use App\Services\Interfaces\IClienteService;
use Exception;
use Illuminate\Support\Facades\DB;

class ClienteService implements IClienteService{

    public function getClienteById($id)
    {
        $cliente = DB::select('SELECT * FROM clientes WHERE id = :id', ['id' => $id]);

        return $cliente[0];
    }
    public function addCliente(array $cliente){
        try{
            $success = DB::insert('INSERT INTO clientes (nome, cpfcnpj, status) VALUES (:nome, :cpfcnpj, :status) ', [
                'nome' => $cliente['nome'],
                'cpfcnpj' => $cliente['cpfcnpj'],
                'status' => $cliente['status']
            ]);

            return $success;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function listClientes(array $filter = null)
    {
        try{
            $list = DB::select('SELECT * FROM clientes');


            return $list;

        }catch(Exception $e){
            return $e->getMessage();
        }
    }
    public function editCliente(array $cliente){
        try{
            $lines = DB::update('UPDATE clientes set nome = :nome, status = :status, cpfcnpj = :cpfcnpj WHERE id = :id',[
                'nome' => $cliente['nome'],
                'cpfcnpj' => $cliente['cpfcnpj'],
                'status' => $cliente['status'],
                'id' => $cliente['id']
            ]);

            return $lines;

        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function deleteCliente($clienteid){
        try{
            $lines = DB::delete('DELETE FROM clientes WHERE id = :id', ['id' => $clienteid]);

            return $lines;

        }catch(Exception $e){
            // return $e->getMessage();
            die($e->getMessage());
            return 0;
        }
    }
}
