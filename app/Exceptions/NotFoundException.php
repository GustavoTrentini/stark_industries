<?php

namespace App\Exceptions;

class NotFoundException extends \Exception {
  public $message = "Nada encontrado";

  public function render()
  {
    return redirect()->route('clientes.create')->with([
      'message' => $this->message,
      'type' => "danger"
    ]);
  }
}