<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IClienteService;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    private $clienteService;

    public function __construct(IClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }
    //
    public function list(){
        $list = $this->clienteService->listClientes([]);

        return view('clientes.list', [ 'list' => $list ]);
    }

    public function add(){

        return view('clientes.add');
    }

    public function addAction(Request $request){
        $cliente = $request->all();

        $return = $this->clienteService->addCliente($cliente);

        return redirect()->route('clientes.list');
    }

    public function edit($id){
        $cliente = $this->clienteService->getClienteById($id);

        return view('clientes.edit', ['cliente' => $cliente]);
    }

    public function editAction($id, Request $request){
        $cliente = $request->all();
        $cliente['id'] = $id;

        $return = $this->clienteService->editCliente($cliente);

        return redirect()->route('clientes.list');
    }

    public function delete(Request $request){
        // die($request->input('id'));
        $id = $request->input('id');

        $result = $this->clienteService->deleteCliente($id);

        return $result;
    }
}
