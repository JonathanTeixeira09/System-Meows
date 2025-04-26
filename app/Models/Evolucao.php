<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evolucao extends Model
{
    use HasFactory;
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


}
