<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHashid;


class Paciente extends Model
{
    use HasFactory;
    use HasHashid;

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

    protected $casts = [
        'data_nascimento' => 'datetime',
        'data_gestacao' => 'datetime',
    ];

    /**
     * Gera o código do prontuário automaticamente antes de criar
     * Código Único (Ex: "PR-ABC123")
     *
     * @var string
     */
    protected static function boot()
    {
        parent::boot();

        // Gera o código do prontuário automaticamente antes de criar - Código Único (Ex: "PR-ABC123")
        static::creating(function ($paciente) {
            $paciente->codigo_prontuario = 'PR-' . strtoupper(uniqid());
        });
    }

    /**
     * Calcula e formata o tempo de gestação
     *
     * @return string
     */
    public function formatarTempoGestacao()
    {
        // Verifica se a data existe
        if (empty($this->data_gestacao)) {
            return [
                'texto' => 'Data não informada',
                'badge' => 'bg-secondary'
            ];
        }

        try {
            $dum = \Carbon\Carbon::parse($this->data_gestacao)->startOfDay();
            $hoje = now()->startOfDay();

            // Verifica se a DUM é futura (erro de cadastro)
            if ($dum->isFuture()) {
                return [
                    'texto' => 'Data inválida (futura)',
                    'badge' => 'bg-warning'
                ];
            }

            // Cálculo preciso em dias
            $diasDecorridos = $dum->diffInDays($hoje);
            $semanas = (int)($diasDecorridos / 7); // Força número inteiro
            $dias = $diasDecorridos % 7;

            // Limitação obstétrica (máximo 42 semanas)
            if ($semanas > 42) {
                $semanas = 42;
                $dias = 0;
            }

            // Formatação do texto
            $texto = $semanas.' semana'.($semanas != 1 ? 's' : '');
            if ($dias > 0) {
                $texto .= ' e '.$dias.' dia'.($dias != 1 ? 's' : '');
            }

            // Classificação obstétrica
            if ($semanas >= 42) {
                return [
                    'texto' => 'Pós-termo: '.$texto,
                    'badge' => 'bg-danger'
                ];
            } elseif ($semanas >= 37) {
                return [
                    'texto' => 'Termo: '.$texto,
                    'badge' => 'bg-success'
                ];
            }

            return [
                'texto' => $texto,
                'badge' => 'bg-primary'
            ];

        } catch (\Exception $e) {
            return [
                'texto' => 'Erro no cálculo',
                'badge' => 'bg-warning'
            ];
        }
    }

    /**
     * Versão alternativa que retorna array com dados brutos
     * (útil para APIs ou cálculos adicionais)
     */
    public function calcularIdadeGestacional()
    {
        if (empty($this->data_gestacao)) {
            return null;
        }

        try {
            $dataGestacao = Carbon::parse($this->data_gestacao);
            $dataAtual = now();
            $semanas = $dataGestacao->diffInWeeks($dataAtual);
            $dias = $dataGestacao->diffInDays($dataAtual) % 7;

            return [
                'semanas' => $semanas,
                'dias' => $dias,
                'is_termo' => ($semanas >= 37),  // Corrigido: removida a vírgula extra
                'is_pos_termo' => ($semanas >= 42),
                'is_futuro' => $dataGestacao->isFuture()
            ];
        } catch (\Exception $e) {
            return null;
        }
    }

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }

    public function ultimoAtendimento()
    {
        return $this->hasOne(Atendimento::class)->latestOfMany();
    }
}
