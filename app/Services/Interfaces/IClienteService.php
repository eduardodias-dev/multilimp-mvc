<?php

namespace App\Services\Interfaces;


interface IClienteService
{

    public function getClienteById($id);
    public function listClientes(array $filter);
    public function addCliente(array $cliente);
    public function editCliente(array $cliente);
    public function deleteCliente($clienteid);


}
