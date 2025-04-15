<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'data_entrada',
        'data_alta',
        'hora_entrada',
        'hora_saida',
        'entrada_user_id',
        'alta_user_id'
    ];

    // Relacionamento com Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    // Relacionamento com Usuário que iniciou o atendimento
    public function entradaUser()
    {
        return $this->belongsTo(User::class, 'entrada_user_id');
    }

    // Relacionamento com Usuário que deu alta
    public function altaUser()
    {
        return $this->belongsTo(User::class, 'alta_user_id');
    }
}
