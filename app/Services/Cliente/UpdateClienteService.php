<?php

namespace App\Services\Cliente;

use App\Models\Cliente;
use App\Domain\DTOs\Cliente\ClienteDTO;
use App\Exceptions\ErrorServerException;
use App\Exceptions\NotFoundException;

class UpdateClienteService
{
    public function __construct(
        private Cliente $cliente
    ){}

    public function update(ClienteDTO $clienteDTO, $id): Cliente
    {
        $clienteUpdated = $this->cliente->find($id);

        if ($clienteDTO->foto) {
            $upload = $clienteDTO->foto->store('clientes', 'public');

            if (!$upload) {
                throw new NotFoundException("Não foi possível fazer o upload da foto!");
            }

            $clienteDTO->foto = "storage/" . $upload;
        }

        $clienteUpdated->update((array)$clienteDTO);

        if(!$clienteUpdated->wasChanged()){
            throw new ErrorServerException("Não foi possivel Atualizar o cliente");
        }

        return $clienteUpdated;
    }
}
