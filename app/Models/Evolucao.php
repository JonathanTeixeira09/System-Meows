<?php

namespace App\Models;

use App\Traits\HasHashid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    use HasFactory;
    use HasHashid;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array
     */
    protected $fillable = [
        'atendimento_id',
        'fr',
        'fc',
        'pas',
        'pad',
        'temp',
        'so',
        'obs',
        'grauDeterioracao',
        'local_id',
        'user_id'
    ];

    // Definindo os relacionamentos
    public function atendimento()
    {
        return $this->belongsTo(Atendimento::class, 'atendimento_id');
    }
    public function local()
    {
        return $this->belongsTo(Local::class, 'local_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function avaliacao()
    {
        return $this->hasOne(Avaliacao::class);
    }


    // Busca por hashid





}
