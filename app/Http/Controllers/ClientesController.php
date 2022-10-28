<?php

namespace App\Http\Controllers;

use App\Services\Cliente\FindClienteService;
use App\Services\Cliente\CreateClienteService;
use App\Services\Cliente\DeleteClienteService;
use App\Services\Cliente\UpdateClienteService;
use App\Http\Requests\CreateClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClientesController extends Controller
{

    public function __construct(
        private FindClienteService $findClienteService,
        private CreateClienteService $createClienteService,
        private DeleteClienteService $deleteClienteService,
        private UpdateClienteService $updateClienteService
    ) {
    }

    // Método que retorna a lista completa de clientes para view index.blade.php
    public function index()
    {
        return view('clientes.index', [
            'clientes' => $this->findClienteService->getAll()
        ]);
    }

    // Método que retorna a tela de cadastro de cliente
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Método que grava o cliente no banco de dados
     *
     * @return view
     */
    public function store(CreateClienteRequest $request)
    {
        $cliente = $this->createClienteService->store($request->getClienteDTO());

        return redirect()->route('clientes.index')->with([
            'message' => "Cliente ($cliente->id) $cliente->nome cadastrado com sucesso",
            'type' => "success"
        ]);
    }

    // Método que retorna o usuário consultado via botão (ver)
    public function show($id)
    {
        return view('clientes.show', [
            "cliente" => $this->findClienteService->find($id)
        ]);
    }

    // Método que retorna o usuário consultado via botão (editar)
    public function edit($id)
    {
        return view('clientes.edit', [
            "cliente" => $this->findClienteService->find($id)
        ]);
    }

    // Método que grava as alterações do cliente no banco de dados
    public function update(UpdateClienteRequest $request, $id)
    {
        $cliente = $this->updateClienteService->update($request->getClienteDTO(), $id);

        return redirect()->route('clientes.index')->with([
            'message' => "Cliente ($cliente->id) $cliente->nome atualizado com sucesso",
            'type' => "success"
        ]);
    }

    public function delete($id)
    {
        $this->deleteClienteService->delete($id);

        return redirect()->route('clientes.index')->with([
            'message' => "Cliente ($id) deletado com sucesso",
            'type' => "success"
        ]);
    }
}
