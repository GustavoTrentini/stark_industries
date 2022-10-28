<?php

namespace App\Domain\DTOs\Cliente;

class ClienteDTO {
  public $id;

  public $nome;

  public $cpf;

  public $foto;

  public $rg;

  public $data_nasc;

  public $cep;

  public $logradouro;

  public $numero;

  public $bairro;

  public $cidade;

  public $uf;

  public $complemento;

  public function __construct(Object $obj) {
    $this->id = $obj->id ?? null;
    $this->nome = $obj->nome;
    $this->cpf = $obj->cpf;
    $this->foto = $obj->foto;
    $this->rg = $obj->rg;
    $this->data_nasc = $obj->data_nasc;
    $this->cep = $obj->cep;
    $this->logradouro = $obj->logradouro;
    $this->numero = $obj->numero;
    $this->bairro = $obj->bairro;
    $this->cidade = $obj->cidade;
    $this->uf = $obj->uf;
    $this->complemento = $obj->complemento;
  }
}