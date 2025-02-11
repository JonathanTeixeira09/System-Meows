<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
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

    /**
     * Obtenha o cargo que possui o Profissional
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Cargo(){
        return$this->belongsTo(Cargo::class);
    }


    /**
     * Obtenha a formação que possui o Profissional
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Formacao(){
        return$this->belongsTo(FormacaoProfissional::class);
    }
}
