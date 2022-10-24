<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientesController extends Controller
{
    // variável privada que contém os papéis de validação dos formulários de clientes
    protected $rules = [
        "nome" => "required|max:150",
        "foto" => "image",
        "cpf" => "required|max:20|unique:clientes,cpf",
        "rg" => "required|max:12|unique:clientes,rg",
        "data_nasc" => "required|before:now",
        "cep" => "required|max:9",
        "logradouro" => "required|max:100",
        "bairro" => "required|max:50",
        "cidade" => "required|max:60",
        "uf" => "required|max:2",
        "complemento" => "max:150",
        "numero" => "required"
    ];

    // Método que retorna a lista completa de clientes para view index.blade.php
    public function index(Clientes $clientes){
        return view('clientes.index', [
            'clientes' => $clientes->all()
        ]);
    }

    // Método que retorna a tela de cadastro de cliente
    public function create(){
        return view('clientes.create');
    }

    // Método que grava o cliente no banco de dados
    public function store(Request $request, Clientes $clientes){

        $request->validate($this->rules);
        $data = $request->all();

        if($request->hasFile('foto')){
            $upload = $request->foto->store('clientes', 'public');

            if ( $upload ){
                $data['foto'] = "storage/".$upload;
            }
            else{
                return redirect()->back()->with([
                    'message' => "Não foi possível fazer o upload da foto!",
                    'type' => "danger"
                ]);
            }
        }

        $cliente = $clientes->create($data);

        if($cliente){
            return redirect()->route('clientes.index')->with([
                'message' => "Cliente ($cliente->id) $cliente->nome cadastrado com sucesso",
                'type' => "success"
            ]);
        }
        else{
            return redirect()->back()->with([
                'message' => "Não foi possível cadastrar o cliente",
                'type' => "danger"
            ]);
        }
    }

    // Método que retorna o usuário consultado via botão (ver)
    public function show(Clientes $clientes, $id){
        return view('clientes.show', [
            "cliente" => $clientes->find($id)
        ]);
    }

    // Método que retorna o usuário consultado via botão (editar)
    public function edit(Clientes $clientes, $id){
        return view('clientes.edit', [
            "cliente" => $clientes->find($id)
        ]);
    }

    // Método que grava as alterações do cliente no banco de dados
    public function update(Request $request, Clientes $clientes, $id){

        $rules = (object)$this->rules;
        $rules->cpf = [Rule::unique('clientes', 'cpf')->ignore($id),"required","max:20"];
        $rules->rg = [Rule::unique('clientes', 'rg')->ignore($id),"required","max:12"];

        $request->validate((array)$rules);
        $cliente = $clientes->find($id);
        $data = $request->all();

        if($request->hasFile('foto')){
            $upload = $request->foto->store('clientes', 'public');

            if ( $upload ){
                $data['foto'] = "storage/".$upload;
            }
            else{
                return redirect()->back()->with([
                    'message' => "Não foi possível fazer o upload da foto!",
                    'type' => "danger"
                ]);
            }
        }

        $cliente->update($data);

        if($cliente->wasChanged()){
            return redirect()->route('clientes.index')->with([
                'message' => "Cliente ($cliente->id) $cliente->nome atualizado com sucesso",
                'type' => "success"
            ]);
        }
        else{
            return redirect()->back()->with([
                'message' => "Não foi possível atualizar o cliente",
                'type' => "danger"
            ]);
        }
    }

    public function delete(Clientes $clientes, $id){

        if($clientes->destroy($id)){
            return redirect()->route('clientes.index')->with([
                'message' => "Cliente ($id) deletado com sucesso",
                'type' => "success"
            ]);
        }
        else{
            return redirect()->back()->with([
                'message' => "Não foi possivel deletar o cliente",
                'type' => "danger"
            ]);
        }
    }
}
