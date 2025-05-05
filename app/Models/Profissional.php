<?php

namespace App\Models;

use App\Traits\HasHashid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Profissional extends Model
{
    use HasFactory;
    use HasHashid;

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

    protected $casts = [
        'dataNascimento' => 'datetime',
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

    /**
     * Obtenha o usuário que possui o Profissional
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function user()
    {
        return $this->hasOne(User::class, 'profissionals_id');
        // Um profissional tem um user através de users.profissionals_id
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }
}
