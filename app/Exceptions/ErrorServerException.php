<?php

namespace App\Exceptions;

use Exception;

class ErrorServerException extends Exception
{
    public $message = "Erro interno do servidor";

    public function render(){
        return redirect()->back()->with([
            'message' => $this->message,
            'type' => "danger"
        ]);
    }
}
