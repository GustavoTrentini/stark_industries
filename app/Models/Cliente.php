<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nome',
        'cpf',
        'rg',
        'data_nasc',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'complemento',
    ];

    protected $dates = [
        'data_nasc',
    ];
}
