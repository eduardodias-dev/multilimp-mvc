<?php

namespace App\Services\Interfaces;


interface IOrdemServicoService
{

    public function getOrdemServicoById($id);
    public function listOrdemServicos(array $filter);
    public function addOrdemServico(array $ordemServico);
    public function editOrdemServico(array $ordemServico);
    public function deleteOrdemServico($ordemServicoid);


}
