<?php

namespace App\Services\Cliente;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Cliente;
use App\Exceptions\NotFoundException;

class FindClienteService
{
    public function __construct(
        private Cliente $cliente
    ){}

    public function getAll(): Collection
    {
        return $this->cliente->all();
    }

    public function find($id): Cliente
    {
        return $this->cliente->find($id);
    }
}
