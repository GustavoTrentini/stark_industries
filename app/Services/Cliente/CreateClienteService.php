<?php

namespace App\Services\Cliente;

use App\Models\Cliente;
use App\Domain\DTOs\Cliente\ClienteDTO;
use App\Exceptions\NotFoundException;

class CreateClienteService
{
    public function __construct(
        private Cliente $cliente
    ){}

    public function store(ClienteDTO $clienteDTO): Cliente
    {
        if ($clienteDTO->foto) {
            $upload = $clienteDTO->foto->store('clientes', 'public');

            if (!$upload) {
                throw new NotFoundException("Não foi possível fazer o upload da foto!");
            }

            $clienteDTO->foto = "storage/" . $upload;
        }

        return $this->cliente->create((array)$clienteDTO);
    }
}
