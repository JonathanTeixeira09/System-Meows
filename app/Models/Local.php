<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Local extends Model
{
    /** @use HasFactory<\Database\Factories\LocalFactory> */
    use HasFactory;
    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function evolucaos()
    {
        return $this->hasMany(Evolucao::class);
    }
}
