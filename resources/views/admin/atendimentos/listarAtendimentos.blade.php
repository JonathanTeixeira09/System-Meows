@extends('layouts.app')

@section('title', 'Listagem de Atendimentos')
@section('conteudo')
    @push('listandoAtendimentosCSS')
        <style>
            /*@media (max-width: 1000px) {*/
            /*    .table thead {*/
            /*        display: none;*/
            /*    }*/

            /*    .table td {*/
            /*        display: flex;*/
            /*        justify-content: space-between;*/
            /*    }*/

            /*    .table tr {*/
            /*        display: block;*/
            /*    }*/

            /*    .table td:first-of-type {*/
            /*        font-weight: bold;*/
            /*        font-size: 1.2rem;*/
            /*        text-align: center;*/
            /*        display: block;*/
            /*    }*/

            /*    .table td:not(:first-of-type):before {*/
            /*        content: attr(data-title);*/
            /*        display: block;*/
            /*        font-weight: bold;*/
            /*    }*/
            /*}*/
            /*.bg-light td {*/
            /*    background-color: #f8f9fa !important;*/
            /*}*/
            /*.bg-primary td {*/
            /*    background-color: #4e73df !important;*/
            /*}*/
            /*.bg-success td {*/
            /*    background-color: #1cc88a !important;*/
            /*}*/
            /*.bg-warning td {*/
            /*    background-color: #f6c23e !important;*/
            /*}*/
            /*.bg-danger td {*/
            /*    background-color: #e74a3b !important;*/
            /*}*/
            /*.img-profile {*/
            /*    border: 2px solid #fff;*/
            /*    box-shadow: 0 0 5px rgba(0,0,0,0.2);*/
            /*}*/
            /*.display-6 {*/
            /*    font-size: 1.2rem;*/
            /*    margin-bottom: 0.2rem;*/
            /*}*/
            /*.coluna-acoes {*/
            /*    background-color: #f8f9fa !important; !* Cinza claro *!*/
            /*    position: relative;*/
            /*}*/

            /*!* Manter a cor original quando a linha tiver classes de status *!*/
            /*tr.bg-primary .coluna-acoes,*/
            /*tr.bg-success .coluna-acoes,*/
            /*tr.bg-warning .coluna-acoes,*/
            /*tr.bg-danger .coluna-acoes {*/
            /*    background-color: inherit !important;*/
            /*}*/
            /*!* Estilo para os botões *!*/
            /*.coluna-acoes .btn {*/
            /*    margin: 2px;*/
            /*    box-shadow: 0 2px 4px rgba(0,0,0,0.1);*/
            /*}*/

            /* Estilos gerais para a tabela */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            /* Estilos para desktop */
            .table td, .table th {
                vertical-align: middle;
                padding: 12px 8px;
            }

            .img-profile {
                border: 2px solid #fff;
                box-shadow: 0 0 5px rgba(0,0,0,0.2);
                width: 60px;
                height: 60px;
                object-fit: cover;
            }

            /* Cores das linhas */
            .bg-light td {
                background-color: #f8f9fa !important;
            }
            .bg-primary td {
                background-color: #4e73df !important;
                color: white;
            }
            .bg-success td {
                background-color: #1cc88a !important;
                color: white;
            }
            .bg-warning td {
                background-color: #f6c23e !important;
            }
            .bg-danger td {
                background-color: #e74a3b !important;
                color: white;
            }

            /* Coluna de ações */
            .coluna-acoes {
                background-color: #f8f9fa !important;
            }
            .coluna-acoes .btn {
                margin: 2px;
                min-width: 36px;
            }

            /* Responsividade - Versão mobile */
            @media (max-width: 1280px) {
                .table thead {
                    display: none;
                }

                .table, .table tbody, .table tr, .table td {
                    display: block;
                    width: 100%;
                }

                .table tr {
                    margin-bottom: 20px;
                    border: 1px solid #dee2e6;
                    border-radius: 8px;
                    overflow: hidden;
                    position: relative;
                }

                .table td {
                    padding: 10px 15px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    border-top: 1px solid #e9ecef;
                }

                /* Foto do paciente em destaque */
                .table td:first-child {
                    background-color: rgba(0,0,0,0.03);
                    justify-content: center;
                    padding: 15px;
                    border-top: none;
                }

                /* Rótulos dos campos */
                .table td:not(:first-child):before {
                    content: attr(data-title);
                    font-weight: bold;
                    width: 45%;
                    padding-right: 15px;
                    text-align: left;
                }

                /* Conteúdo dos campos */
                .table td:not(:first-child) {
                    text-align: right;
                    width: 100%;
                    flex: 1;
                }

                /* Ajustes específicos para colunas */
                .table .coluna-acoes {
                    flex-direction: row;
                    gap: 8px;
                    padding: 15px;
                }

                .table .coluna-acoes:before {
                    display: none;
                }

                .table .coluna-acoes .btn {
                    width: 100%;
                    justify-content: center;
                }

                /* Ajuste para o status */
                .table td[data-title="Status"] .badge {
                    display: block;
                    text-align: center;
                    width: 100%;
                }

                /* Ajuste para o tempo de espera */
                .table td[data-title="Tempo de Espera"] {
                    flex-direction: column;
                    text-align: center !important;
                }

                .table td[data-title="Tempo de Espera"]:before {
                    width: 100%;
                    text-align: center;
                    margin-bottom: 5px;
                }
            }

            /* Melhorias para telas médias */
            @media (min-width: 768px) and (max-width: 1000px) {
                .table td:not(:first-child):before {
                    width: 30%;
                }

                .table td:not(:first-child) {
                    width: 100%;
                }
            }

            /* Estilo específico apenas para INTERVENÇÃO IMEDIATA */
            .alerta-critico .blinking {
                color: #fff !important;
                font-weight: bold;
                text-shadow:
                    -1px -1px 0 #fff,
                    1px -1px 0 #fff,
                    -1px 1px 0 #fff,
                    1px 1px 0 #fff,
                    0 0 8px rgba(255,255,255,0.8);
                animation: critical-blink 0.8s infinite;
                padding: 2px 5px;
                border-radius: 4px;
                display: inline-block;
            }

            /* Versão com text-stroke para navegadores modernos */
            @supports (-webkit-text-stroke: 1px white) or (text-stroke: 1px white) {
                .alerta-critico .blinking {
                    -webkit-text-stroke: 1px white;
                    text-stroke: 1px white;
                    text-shadow: none;
                }
            }

            /* Animação específica para o caso crítico */
            @keyframes critical-blink {
                0%, 100% {
                    opacity: 1;
                    background-color: rgba(255, 255, 255, 0.2);
                }
                50% {
                    opacity: 0.7;
                    background-color: rgba(255, 255, 255, 0.3);
                }
            }

            /* Mantém os outros estilos de blinking como estavam */
            .blinking:not(.alerta-critico .blinking) {
                animation: blink-animation 1s steps(2, start) infinite;
                -webkit-animation: blink-animation 1s steps(2, start) infinite;
                color: #dc3545 !important;
                font-weight: bold;
            }

            @keyframes blink-animation {
                to { visibility: hidden; }
            }

            /* Estilo específico para o alerta crítico */
            .alerta-critico {
                text-align: center;
            }

            .alerta-critico h5 {
                display: inline-block;
                background-color: rgba(255, 255, 255, 0.2);
                padding: 3px 7px;
                border-radius: 4px;
                border: 1px solid rgba(255, 255, 255, 0.3);
            }

            /* Estilo para o tempo em atraso */
            .text-overdue {
                color: #dc3545;
                font-weight: bold;
            }

        </style>
        <script>
            setInterval(function () {
                location.reload();
            }, 30000); // 30000 milissegundos = 30 segundos
        </script>
    @endpush


    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Listagem de Atendimentos</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <!-- Tabela de Atendimentos -->
                    <table class="table table-striped table-md">
                        <div class="table-responsive">
                            <thead>
                            <tr style='text-align:left;'>
                                <th>Foto</th>
                                <th>Nome</th>
{{--                                <th>Data de Entrada</th>--}}
{{--                                <th>Hora de Entrada</th>--}}
                                <th>Nome do Profissional</th>
                                <th>Status</th>
                                <th>Tempo</th>
                                <th>Local</th>
                                <th style='text-align:right;'>Ações</th>
                            </tr>
                            </thead>
                            <tbody style='text-align:left;'>
                            @foreach ($atendimentos as $atendimento)
                                @php
                                    // Determina o grau de deterioração
                                    $ultimaEvolucao = $atendimento->evolucoes->first();
                                    $grauDeterioracao = $ultimaEvolucao->grauDeterioracao ?? null;

                                    // Define a classe CSS baseada no grau
                                    $rowClass = '';
                                    $statusText = 'Aguardando atendimento';
                                    $tempoProximaVerificacao = null;

                                    if (is_null($grauDeterioracao)) {
                                        $rowClass = 'bg-light';
                                    } elseif ($grauDeterioracao >= 0 && $grauDeterioracao <= 2) {
                                        $rowClass = 'bg-primary text-white';
                                        $statusText = 'Sem risco';
                                        $tempoProximaVerificacao = 4 * 60 * 60 * 1000; // 4 horas em milissegundos
                                    } elseif ($grauDeterioracao >= 3 && $grauDeterioracao <= 4) {
                                        $rowClass = 'bg-success text-white';
                                        $statusText = 'Baixo risco';
                                        $tempoProximaVerificacao = 1 * 60 * 60 * 1000; // 1 hora em milissegundos
                                    } elseif ($grauDeterioracao >= 5 && $grauDeterioracao <= 6) {
                                        $rowClass = 'bg-warning';
                                        $statusText = 'Risco moderado';
                                        $tempoProximaVerificacao = 30 * 60 * 1000; // 30 minutos em milissegundos
                                    } elseif ($grauDeterioracao >= 7) {
                                        $rowClass = 'bg-danger text-white';
                                        $statusText = 'Risco alto';
                                    }
                                @endphp

                                <tr class="{{ $rowClass }}">
                                    <td data-title='Foto'>
                                        <img class="img-profile rounded-circle" src="storage/{{ $atendimento->paciente->thumbnail }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    </td>
                                    <td data-title='Nome'>
                                        <div>
                                            <strong>{{ $atendimento->paciente->nome }}</strong><br>
                                            <small>Entrada: {{ $atendimento->created_at->format('d/m/Y H:i:s') }}</small>
                                        </div>{{-- $atendimento->paciente->nome --}}
                                    </td>
{{--                                    <td data-title='Data de Entrada'>{{ date('d/m/Y', strtotime($atendimento->data_entrada)) }}</td>--}}
{{--                                    <td data-title='Hora de Entrada'>{{ $atendimento->hora_entrada }}</td>--}}
                                    <td data-title='Nome do Profissional'>{{ $atendimento->entradaUser->profissional->nome }}</td>
                                    <td data-title='Status'>
                        <span class="badge {{ $grauDeterioracao === null ? 'bg-secondary' : ($grauDeterioracao >= 7 ? 'bg-danger' : ($grauDeterioracao >= 5 ? 'bg-warning' : ($grauDeterioracao >= 3 ? 'bg-success' : 'bg-primary'))) }}">
                            {{ $statusText }}
                        </span>
                                    </td>
                                    <td data-title="Tempo">
                                        @if($grauDeterioracao === null)
                                            <div class="tempo-espera-container" data-registro="{{ $atendimento->created_at->format('Y-m-d H:i:s') }}">
                                                <h5 class="tempo-espera text-danger display-6">00:00:00</h5>
                                                <small>Em espera</small>
                                            </div>
                                        @elseif($grauDeterioracao >= 7)
                                            <div class="alerta-critico">
                                                <h5 class="blinking"><strong>INTERVENÇÃO IMEDIATA</strong></h5>
                                            </div>
                                        @else
                                            <div class="proxima-verificacao-container"
                                                 data-tempo="{{ $tempoProximaVerificacao }}"
                                                 data-registro="{{ $ultimaEvolucao->created_at->format('Y-m-d H:i:s') }}">
                                                <h5 class="tempo-restante display-6">00:00:00</h5>
                                                <small>Próxima verificação</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td data-title='Local'>{{ $atendimento->evolucoes->first()->local->nome ?? 'Não informado' }}</td>
                                    <td data-title="Ações" class="coluna-acoes" style='text-align:right; background: #FFFFFF'>
                                        <!-- Seus botões de ação aqui -->
                                        <a href='{{route('incluirEvolucao', $atendimento->id) }}'><button type='button' class='btn btn-sm btn-warning' title="Incluir Anamnese"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                        <a href='{{ route('evolucao.ultima', $atendimento->id) }}'><button type='button'
                                                                                                           class='btn btn-sm btn-primary' title="Visualizar evolução"><i class="fa-solid fa-eye"></i></button></a>

{{--                                        <a href='{{ route('evolucao.listar', $atendimento->id) }}'><button type='button'--}}
{{--                                                                                                           class='btn btn-sm btn-info' title="Evoluções"><i class="fa-solid fa-list"></i></button></a>--}}
                                        <a href='{{ route('evolucoes.grafico', $atendimento->id) }}'><button type='button'
                                                                                                             class='btn btn-sm btn-info' title="Gráficos"><i class="fa-solid fa-chart-simple"></i></button></a>
                                        <a href='{{route('altaPaciente.index', $atendimento->id) }}'><button type='button'
                                                                                               class='btn btn-sm btn-success' title="Dar Alta"><i class="fa-solid fa-circle-up"></i></button></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </div>
                    </table>

                    <!-- Fim da Tabela de Atendimentos -->
                    @if ($atendimentos->isEmpty())
                        <p style="text-align: center;"> Não existe pacientes em atendimento</p>
                    @endif
                </div>
            </div>
            <!-- Paginação -->
{{--            <div class="d-flex justify-content-center">--}}
{{--                {{ $pacientes->links('pagination::bootstrap-5') }}--}}
{{--            </div>--}}
        </div>
    </div>

@endsection
@push('listAtendimentosJs')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Contador para pacientes sem atendimento (progressivo)
            document.querySelectorAll('.tempo-espera-container').forEach(container => {
                const registroTime = new Date(container.dataset.registro).getTime();
                updateProgressTimer(container, registroTime);
            });

            // Contador regressivo para próximas verificações
            document.querySelectorAll('.proxima-verificacao-container').forEach(container => {
                const registroTime = new Date(container.dataset.registro).getTime();
                const tempoVerificacao = parseInt(container.dataset.tempo);
                setupCountdownTimer(container, registroTime, tempoVerificacao);
            });
        });

        function updateProgressTimer(container, startTime) {
            function update() {
                const now = new Date().getTime();
                const diff = now - startTime;

                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                container.querySelector('.tempo-espera').textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }

            update();
            setInterval(update, 1000);
        }

        function setupCountdownTimer(container, startTime, duration) {
            const timerElement = container.querySelector('.tempo-restante');
            const labelElement = container.querySelector('small');
            let progressTimerInterval = null;
            let blinkInterval = null;

            function updateCountdown() {
                const now = new Date().getTime();
                const endTime = startTime + duration;
                let diff = endTime - now;

                // Timer expirado - inicia contador progressivo
                if (diff <= 0) {
                    clearInterval(countdownInterval);

                    // Remove qualquer classe de cor existente
                    timerElement.classList.remove('text-warning', 'text-danger');

                    // Adiciona efeito de piscar
                    timerElement.classList.add('blinking');

                    // Toca alerta sonoro (implemente conforme sua necessidade)
                    playAlertSound();

                    // Inicia contador progressivo
                    const overdueStartTime = endTime;
                    progressTimerInterval = setInterval(() => {
                        const overdueDiff = new Date().getTime() - overdueStartTime;
                        const hours = Math.floor(overdueDiff / (1000 * 60 * 60));
                        const minutes = Math.floor((overdueDiff % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((overdueDiff % (1000 * 60)) / 1000);

                        timerElement.textContent =
                            `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                        timerElement.classList.add('text-danger');
                        labelElement.textContent = "Verificar Paciente URGENTE!";
                    }, 1000);

                    return;
                }

                // Atualiza contador regressivo
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                timerElement.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                // Muda para amarelo quando faltar menos de 10 minutos
                if (diff < 10 * 60 * 1000) {
                    timerElement.classList.add('text-warning');
                    timerElement.classList.remove('text-danger');
                }

                // Muda para vermelho quando faltar menos de 2 minutos
                if (diff < 2 * 60 * 1000) {
                    timerElement.classList.remove('text-warning');
                    timerElement.classList.add('text-danger');
                }
            }

            // Inicia o contador regressivo
            let countdownInterval = setInterval(updateCountdown, 1000);
            updateCountdown(); // Chamada inicial

            // Função para alerta sonoro (implementação básica)
            function playAlertSound() {
                // Implemente com seu sistema de notificação sonora preferido
                console.log("ALERTA: Verificação atrasada!");
                // Exemplo: new Audio('/sounds/alert.mp3').play();
            }
        }

    </script>
    <script>
        // Variável para controlar o tempo de atualização
        let intervaloAtualizacao = 30000; // 30 segundos
        let timerAtualizacao;

        // Função principal de atualização
        function atualizarAtendimentos(showNotification = false) {
            $.ajax({
                url: "{{ route('listarAtendimentos.index') }}?_partial=1&_=" + new Date().getTime(),
                type: "GET",
                dataType: "html",
                beforeSend: function() {
                    if(showNotification) {
                        mostrarNotificacao('Atualizando dados...', 'info');
                    }
                },
                success: function(data) {
                    // Atualiza a tabela
                    const $novaTabela = $(data).find('.table-responsive').first();
                    if($novaTabela.length) {
                        $('.table-responsive').html($novaTabela.html());
                    }

                    // Atualiza contadores
                    const $novosContadores = $(data).find('.card-counter').first();
                    if($novosContadores.length) {
                        $('.card-counter').html($novosContadores.html());
                    }

                    // Atualiza hora da última atualização
                    $('#ultima-atualizacao').text(new Date().toLocaleTimeString());

                    if(showNotification) {
                        mostrarNotificacao('Dados atualizados com sucesso!', 'success');
                    }
                },
                error: function(xhr, status, error) {
                    if(showNotification) {
                        mostrarNotificacao('Erro ao atualizar: ' + error, 'error');
                    }
                    console.error("Erro na atualização:", status, error);
                },
                complete: function() {
                    // Reinicia o timer após cada atualização
                    reiniciarTimer();
                }
            });
        }

        // Função para mostrar notificações
        function mostrarNotificacao(mensagem, tipo = 'info') {
            // Implemente sua notificação preferida (Toastr, SweetAlert, etc)
            console.log(`[${tipo}] ${mensagem}`);
            // Exemplo com Toastr:
            // toastr[tipo](mensagem);
        }

        // Função para reiniciar o timer
        function reiniciarTimer() {
            clearTimeout(timerAtualizacao);
            timerAtualizacao = setTimeout(atualizarAtendimentos, intervaloAtualizacao);
        }

        // Inicialização quando o DOM estiver pronto
        $(document).ready(function() {
            // Primeira atualização
            atualizarAtendimentos();

            // Atualiza quando a janela ganha foco
            $(window).on('focus', function() {
                atualizarAtendimentos(true);
            });

            // Botão manual de atualização
            $('#btn-atualizar').on('click', function() {
                atualizarAtendimentos(true);
            });
        });
    </script>
@endpush
