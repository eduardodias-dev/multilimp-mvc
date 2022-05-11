<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\IClienteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'regex:/[a-zA-Z]+/'],
            'cpfcnpj' => ['required'],
            'status' => ['required', 'numeric']
        ], [
            'nome.required'          => 'Campo nome é obrigatório.',
            'nome.regex'             => 'Campo nome permite somente letras.',
            'cpfcnpj.required'       => 'Campo cpf/cnpj é obrigatório.',
            'status.required'        => 'Campo status é obrigatório.',
            'status.numeric'         => 'Formato inválido para o campo status.'
        ]);

        if($validator->fails())
            return redirect()->route('clientes.add')->withErrors($validator)->withInput();

        $cliente = $request->all();

        $return = $this->clienteService->addCliente($cliente);

        if(!$return)
            return redirect()->route('clientes.addaction')->with('warning', 'Erro ao salvar cliente. Verifique com o suporte.');

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
