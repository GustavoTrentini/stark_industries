<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Domain\DTOs\Cliente\ClienteDTO;


class UpdateClienteRequest extends FormRequest
{

    //public $id;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            "nome" => "required|max:150",
            "foto" => "image",
            "cpf" => [Rule::unique('clientes', 'cpf')->ignore($this->route('id')), "required", "max:20"],
            "rg"=> [Rule::unique('clientes', 'rg')->ignore($this->route('id')), "required", "max:12"],
            "data_nasc" => "required|before:now",
            "cep" => "required|max:9",
            "logradouro" => "required|max:100",
            "bairro" => "required|max:50",
            "cidade" => "required|max:60",
            "uf" => "required|max:2",
            "complemento" => "max:150",
            "numero" => "required"
        ];
    }

    public function getClienteDTO() {

        $payload = (object)$this->all();

        return new ClienteDTO((object)[
            "nome" => $payload->nome,
            "cpf" => $payload->cpf,
            "foto" => $this->file('foto') ?? null,
            "rg" => $payload->rg,
            "data_nasc" => $payload->data_nasc,
            "cep" => $payload->cep,
            "logradouro" => $payload->logradouro,
            "numero" => $payload->numero,
            "bairro" => $payload->bairro,
            "cidade" => $payload->cidade,
            "uf" => $payload->uf,
            "complemento" => $payload->complemento
        ]);
    }
}
