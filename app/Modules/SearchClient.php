<?php

namespace App\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Clientes;

class SearchClient extends Controller
{

    public function search(Request $request, Clientes $clientes)
    {

        $request->validate([
            'nome' => Rule::requiredIf($request->input('cpf') == '' && $request->input('rg') == ''),
            'cpf' => Rule::requiredIf($request->input('nome') == '' && $request->input('rg') == ''),
            'rg' => Rule::requiredIf($request->input('cpf') == '' && $request->input('nome') == '')
        ]);

        $clientes = $clientes
            ->where('nome', "LIKE", "%{$request->input('nome')}%")
            ->orWhere('cpf', $request->input('cpf'))
            ->orWhere('rg', $request->input('rg'))
            ->get();

        return view('clientes.filter', [
            "clientes" => $clientes,
            "nome" => $request->input('nome'),
            "cpf" => $request->input('cpf'),
            "rg" => $request->input('rg')
        ]);
    }
}
