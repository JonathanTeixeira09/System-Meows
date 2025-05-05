<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    /**
     * Display a listing of the resource.
     */
    protected $fillable = [
        'evolucao_id',
        'profissionals_id',
        'avaliacao',
        'conduta'
    ];

    /**
     * Get the evolução associated with the Avaliacao.
     */
    public function evolucao()
    {
        return $this->belongsTo(Evolucao::class);
    }

    /**
     * Get the profissional associated with the Avaliacao.
     */
    public function profissional()
    {
        return $this->belongsTo(Profissional::class);
    }
}
