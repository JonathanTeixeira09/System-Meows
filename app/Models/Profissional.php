<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sexo',
        'dataNascimento',
        'cpf',
        'status',
        'formacao_id',
        'cargo_id',
        'conselho',
        'registro',
        'thumbnail',
        'rqe',
    ];
}
