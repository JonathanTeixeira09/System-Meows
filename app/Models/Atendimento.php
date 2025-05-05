<?php

namespace App\Models;

use App\Traits\HasHashid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;
    use HasHashid;
    protected $fillable = [
        'paciente_id',
        'data_entrada',
        'data_alta',
        'hora_entrada',
        'hora_saida',
        'entrada_user_id',
        'alta_user_id'
    ];
    protected $casts = [
        'data_alta' => 'datetime', // Converte automaticamente para Carbon
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
    public function evolucoes()
    {
        return $this->hasMany(Evolucao::class, 'atendimento_id');
    }

    public function ultimaEvolucao()
    {
        return $this->hasOne(Evolucao::class)->latestOfMany();
    }

    /**
     * Determina o status do atendimento baseado no grau de deterioração
     *
     * @return array
     */
    public function determinarStatus()
    {
        $ultimaEvolucao = $this->evolucoes()->latest()->first();
        $grauDeterioracao = $ultimaEvolucao->grauDeterioracao ?? null;

        if (is_null($grauDeterioracao)) {
            return [
                'class' => 'bg-light',
                'text' => 'Aguardando atendimento',
                'tempo' => null,
                'tipo' => 'sem_avaliacao'
            ];
        }

        if ($grauDeterioracao >= 0 && $grauDeterioracao <= 2) {
            return [
                'class' => 'bg-primary text-white',
                'text' => 'Sem risco',
                'tempo' => 4 * 60 * 60 * 1000, // 4 horas
                'tipo' => 'sem_risco'
            ];
        }

        if ($grauDeterioracao >= 3 && $grauDeterioracao <= 4) {
            return [
                'class' => 'bg-success text-white',
                'text' => 'Baixo risco',
                'tempo' => 1 * 60 * 60 * 1000, // 1 hora
                'tipo' => 'baixo_risco'
            ];
        }

        if ($grauDeterioracao >= 5 && $grauDeterioracao <= 6) {
            return [
                'class' => 'bg-warning',
                'text' => 'Risco moderado',
                'tempo' => 30 * 60 * 1000, // 30 minutos
                'tipo' => 'risco_moderado'
            ];
        }

        return [
            'class' => 'bg-danger text-white',
            'text' => 'Intervenção imediata',
            'tempo' => null,
            'tipo' => 'intervencao_imediata'
        ];
    }

    public function tempoDecorrido()
    {
        if ($this->evolucoes()->count() === 0) {
            return $this->created_at->diffInSeconds(now());
        }
        return null;
    }

    public function tempoAtrasoVerificacao()
    {
        if (!$this->ultimaEvolucao) {
            return null;
        }

        $status = $this->determinarStatus();

        if (!$status['tempo']) {
            return null;
        }

        $ultimaEvolucaoTime = $this->ultimaEvolucao->created_at->getTimestamp();
        $tempoLimite = $status['tempo'] / 1000;
        $tempoDecorrido = now()->getTimestamp() - $ultimaEvolucaoTime;

        return max(0, $tempoDecorrido - $tempoLimite);
    }

    public static function findByHashid(string $hashid)
    {
        $hashids = new Hashids(config('app.key'), 12);
        $decoded = $hashids->decode($hashid);

        if (empty($decoded)) {
            return null;
        }

        return self::find($decoded[0]);
    }

}
