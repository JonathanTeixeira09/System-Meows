<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório de Evolução - {{ $evolucao->atendimento->paciente->nome }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.3;
            margin: 0;
            padding: 20px;
        }

        .header {
            width: 100%;
            margin-bottom: 5px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .title {
            color: #2c3e50;
            font-size: 18px;
            margin: 0;
        }

        /* Tabela de parâmetros - idêntica ao relatório */
        .parameters-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 12px;
        }

        .parameters-table th {
            background-color: #343a40;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #454d55;
        }

        .parameters-table td {
            padding: 8px;
            border: 1px solid #dee2e6;
        }

        .parameters-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        /* Badges - cores idênticas ao Bootstrap */
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .bg-primary { background-color: #007bff; color: white; }
        .bg-success { background-color: #28a745; color: white; }
        .bg-warning { background-color: #ffc107; color: black; }
        .bg-danger { background-color: #dc3545; color: white; }
        .bg-secondary { background-color: #6c757d; color: white; }

        /* Grau de deterioração - igual ao relatório */
        .deterioration-box {
            padding: 10px;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: bold;
        }

        .bg-primary { background-color: #007bff; color: white; }
        .bg-success { background-color: #28a745; color: white; }
        .bg-warning { background-color: #ffc107; color: black; }
        .bg-danger { background-color: #dc3545; color: white; }

        .observations {
            background: #f8f9fa;
            padding: 10px;
            border-left: 3px solid #3498db;
            margin: 15px 0;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .signature-area {
            margin-top: 20px;
        }

        .signature-line {
            width: 200px;
            border-top: 1px solid #333;
            text-align: center;
            padding-top: 5px;
            font-size: 12px;
            display: inline-block;
            margin: 0 20px;
        }
    </style>
</head>
<body>
<div class="header">
    <table class="header-table">
        <tr>
            <td>
                <h1 class="title">Relatório de Evolução Clínica</h1>
                Emitido em: {{ now()->format('d/m/Y H:i') }}
            </td>
            <td style="text-align: right;">
                <img src="{{ public_path('img/logo/logo.png') }}" alt="Logo" style="height: 50px;">
                <p>MEOWS DIGI</p>
            </td>
        </tr>
    </table>
</div>

<!-- Dados do Paciente -->
<div style="margin-bottom: 10px;">
    <h3 style="color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px;">Dados do Paciente</h3>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%;">
                <strong>Nome:</strong> {{ $evolucao->atendimento->paciente->nome }}<br>
                <strong>Idade:</strong> {{ $evolucao->atendimento->paciente->idade }} anos
            </td>
            <td style="width: 50%;">
                <strong>Local:</strong> {{ $evolucao->local->nome }}<br>
                <strong>Data:</strong> {{ $evolucao->created_at->format('d/m/Y H:i') }}
            </td>
        </tr>
    </table>
</div>

<!-- Profissional Responsável -->
<div style="margin-bottom: 10px;">
    <h3 style="color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px;">Profissional Responsável</h3>
    <strong>Nome:</strong> {{ $evolucao->user->profissional->nome }}<br>
    <strong>CRM/CRP:</strong> {{ $evolucao->user->profissional->registro }}
</div>

<!-- Tabela de Parâmetros - IDÊNTICA AO RELATÓRIO -->
<h3 style="color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px;">Parâmetros Clínicos</h3>
<table class="parameters-table">
    <thead>
    <tr>
        <th>Parâmetro</th>
        <th>Valor Coletado</th>
        <th>Valor Normal</th>
        <th>Classificação</th>
        <th>Pontuação MEOWS</th>
    </tr>
    </thead>
    <tbody>
    <!-- Frequência Cardíaca -->
    <tr>
        <td>Frequência Cardíaca (bpm)</td>
        <td>{{ $evolucao->fc ?? '--' }}</td>
        <td>60-99 bpm</td>
        <td>
            @php
                $fc = (float)$evolucao->fc;
                if($fc < 50) {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } elseif($fc >= 50 && $fc <= 59) {
                    $class = 'Leve';
                    $score = 1;
                    $color = 'success';
                } elseif($fc >= 60 && $fc <= 99) {
                    $class = 'Normal';
                    $score = 0;
                    $color = 'primary';
                } elseif($fc >= 100 && $fc <= 109) {
                    $class = 'Leve';
                    $score = 1;
                    $color = 'success';
                } elseif($fc >= 110 && $fc <= 129) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } elseif($fc >= 130) {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } else {
                    $class = '--';
                    $score = '--';
                    $color = 'secondary';
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>

    <!-- Frequência Respiratória -->
    <tr>
        <td>Frequência Respiratória (rpm)</td>
        <td>{{ $evolucao->fr ?? '--' }}</td>
        <td>16-20 rpm</td>
        <td>
            @php
                $fr = (float)$evolucao->fr;
                if($fr < 12) {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } elseif($fr >= 12 && $fr <= 15) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } elseif($fr >= 16 && $fr <= 20) {
                    $class = 'Normal';
                    $score = 0;
                    $color = 'primary';
                } elseif($fr >= 21 && $fr <= 24) {
                    $class = 'Leve';
                    $score = 1;
                    $color = 'success';
                } elseif($fr >= 25 && $fr <= 30) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } elseif($fr > 30) {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } else {
                    $class = '--';
                    $score = '--';
                    $color = 'secondary';
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>

    <!-- Pressão Arterial Sistólica -->
    <tr>
        <td>Pressão Arterial Sistólica (mmHg)</td>
        <td>{{ $evolucao->pas ?? '--' }}</td>
        <td>90-139 mmHg</td>
        <td>
            @php
                $pas = (float)$evolucao->pas;
                if ($pas !== null) {
                    if($pas < 70) {
                        $class = 'Crítico';
                        $score = 3;
                        $color = 'danger';
                    } elseif($pas >= 70 && $pas < 90) {
                        $class = 'Moderado';
                        $score = 2;
                        $color = 'warning';
                    } elseif($pas >= 90 && $pas <= 139) {
                        $class = 'Normal';
                        $score = 0;
                        $color = 'primary';
                    } elseif($pas > 139 && $pas <= 149) {
                        $class = 'Leve';
                        $score = 1;
                        $color = 'success';
                    } elseif($pas > 149 && $pas <= 159) {
                        $class = 'Moderado';
                        $score = 2;
                        $color = 'warning';
                    } elseif($pas >= 160) {
                        $class = 'Crítico';
                        $score = 3;
                        $color = 'danger';
                    }
                } else {
                    $class = '--';
                    $score = '--';
                    $color = 'secondary';
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>

    <!-- Pressão Arterial Diastólica -->
    <tr>
        <td>Pressão Arterial Diastólica (mmHg)</td>
        <td>{{ $evolucao->pad ?? '--' }}</td>
        <td>45-89 mmHg</td>
        <td>
            @php
                $pad = (float)$evolucao->pad;
                if (!is_null($pad)) {
                    if($pad < 45) {
                        $class = 'Moderado';
                        $score = 2;
                        $color = 'warning';
                    } elseif($pad >= 45 && $pad <= 89) {
                        $class = 'Normal';
                        $score = 0;
                        $color = 'primary';
                    } elseif($pad >= 90 && $pad <= 99) {
                        $class = 'Leve';
                        $score = 1;
                        $color = 'success';
                    } elseif($pad >= 100 && $pad <= 109) {
                        $class = 'Moderado';
                        $score = 2;
                        $color = 'warning';
                    } elseif($pad >= 110) {
                        $class = 'Crítico';
                        $score = 3;
                        $color = 'danger';
                    }
                } else {
                    $class = '--';
                    $score = '--';
                    $color = 'secondary';
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>

    <!-- Temperatura -->
    <tr>
        <td>Temperatura (°C)</td>
        <td>{{ $evolucao->temp ?? '--' }}</td>
        <td>35-37.4 °C</td>
        <td>
            @php
                $temp = (float)$evolucao->temp;
                if($temp < 35) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } elseif($temp >= 35 && $temp <= 37.4) {
                    $class = 'Normal';
                    $score = 0;
                    $color = 'primary';
                } elseif($temp >= 37.5 && $temp <= 37.9) {
                    $class = 'Leve';
                    $score = 1;
                    $color = 'success';
                } elseif($temp >= 38 && $temp <= 39) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } elseif($temp > 39) {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } else {
                    $class = '--';
                    $score = '--';
                    $color = 'secondary';
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>

    <!-- Saturação de Oxigênio -->
    <tr>
        <td>Saturação de Oxigênio (%)</td>
        <td>{{ $evolucao->so ?? '--' }}</td>
        <td>≥96%</td>
        <td>
            @php
                $soRaw = $evolucao->so ?? null;
                if ($soRaw === ">= 96" || $soRaw === "≥96") {
                    $class = 'Normal';
                    $score = 0;
                    $color = 'primary';
                } elseif ($soRaw === "< 92" || $soRaw === "<92") {
                    $class = 'Crítico';
                    $score = 3;
                    $color = 'danger';
                } elseif (strpos($soRaw, '92 - 95') !== false || strpos($soRaw, '92-95') !== false) {
                    $class = 'Moderado';
                    $score = 2;
                    $color = 'warning';
                } else {
                    $so = is_numeric(str_replace(',', '.', $soRaw)) ? (float)str_replace(',', '.', $soRaw) : null;
                    if ($so !== null) {
                        if ($so < 92) {
                            $class = 'Crítico';
                            $score = 3;
                            $color = 'danger';
                        } elseif ($so >= 92 && $so < 96) {
                            $class = 'Moderado';
                            $score = 2;
                            $color = 'warning';
                        } else {
                            $class = 'Normal';
                            $score = 0;
                            $color = 'primary';
                        }
                    } else {
                        $class = '--';
                        $score = '--';
                        $color = 'secondary';
                    }
                }
            @endphp
            {{ $class }}
        </td>
        <td>
            <span class="badge bg-{{ $color }}">{{ $score }}</span>
        </td>
    </tr>
    </tbody>
</table>

<!-- Grau de Deterioração - IDÊNTICO AO RELATÓRIO -->
<div style="margin: 5px 0;">
    <h5 style="color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px;">Grau de Deterioração</h5>
    <div class="deterioration-box bg-@php
        if ($evolucao->grauDeterioracao >= 0 && $evolucao->grauDeterioracao <= 2) {
            echo 'primary';
        } elseif ($evolucao->grauDeterioracao >= 3 && $evolucao->grauDeterioracao <= 4) {
            echo 'success';
        } elseif ($evolucao->grauDeterioracao >= 5 && $evolucao->grauDeterioracao <= 6) {
            echo 'warning';
        } elseif ($evolucao->grauDeterioracao >= 7) {
            echo 'danger';
        }
    @endphp">
        @php
            if ($evolucao->grauDeterioracao >= 0 && $evolucao->grauDeterioracao <= 2) {
                $avaliacao = 'Não há risco de deterioração';
            } elseif ($evolucao->grauDeterioracao >= 3 && $evolucao->grauDeterioracao <= 4) {
                $avaliacao = 'Baixo risco de deterioração';
            } elseif ($evolucao->grauDeterioracao >= 5 && $evolucao->grauDeterioracao <= 6) {
                $avaliacao = 'Risco moderado de deterioração';
            } elseif ($evolucao->grauDeterioracao >= 7) {
                $avaliacao = 'ALTO RISCO DE DETERIORAÇÃO';
            }
        @endphp
        <span style="font-weight: bold;">{{ $avaliacao }}</span>
        <span style="float: right;">Score Total: {{ $evolucao->grauDeterioracao }}</span>
    </div>
</div>

<!-- Observações -->
<div class="observations">
    <h5 style="color: #3498db; border-bottom: 1px solid #eee; padding-bottom: 5px;">Observações</h5>
    <p>{{ $evolucao->obs ?? 'Nenhuma observação registrada.' }}</p>
</div>

<!-- Assinaturas -->
<div class="signature-area mb-3">
    <p></p>
    <p></p>
    <div class="signature-line">
        <strong>{{ $evolucao->user->profissional->nome }}</strong><br>
        <strong>CRM/CRP:</strong> {{ $evolucao->user->profissional->registro }}<br>
        <strong>Data:</strong> {{ $evolucao->created_at->format('d/m/Y')}}
    </div>
</div>

<!-- Rodapé -->
<div class="footer">
    <p>Meows Digi - Sistema de Gestão Clínica</p>
    <p>Relatório gerado automaticamente em {{ now()->format('d/m/Y H:i') }}</p>
</div>
</body>
</html>
