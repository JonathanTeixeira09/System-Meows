<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'nome',
        'sexo',
        'data_nascimento',
        'cpf',
        'rg',
        'data_gestacao',
        'nome_mae',
        'nome_pai',
        'cns',
        'codigo_prontuario',
        'cep',
        'uf',
        'cidade',
        'bairro',
        'logradouro',
        'numero',
        'complemento',
        'email',
        'celular',
        'celular2',
        'telefone_fixo',
        'observacoes',
    ];

    protected static function boot()
    {
        parent::boot();

        // Gera o código do prontuário automaticamente antes de criar - Código Único (Ex: "PR-ABC123")
        static::creating(function ($paciente) {
            $paciente->codigo_prontuario = 'PR-' . strtoupper(uniqid());
        });
    }
}
