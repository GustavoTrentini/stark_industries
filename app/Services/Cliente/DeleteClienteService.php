<?php

namespace App\Services\Cliente;

use App\Models\Cliente;
use App\Exceptions\ErrorServerException;

class DeleteClienteService
{
    public function __construct(
        private Cliente $cliente
    ){}

    public function delete($id){
        if (!$this->cliente->destroy($id)) {
            throw new ErrorServerException("Não foi possivel deletar o cliente $id");
        }
    }
}
