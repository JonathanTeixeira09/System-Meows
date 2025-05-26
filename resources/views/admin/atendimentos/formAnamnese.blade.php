@extends('layouts.app')

@section('title', 'Cadastrar Anamnese da Parturiente')
@section('conteudo')
    @push('scoreMeowsCSS')
        <style>
            /* Cores das bordas */
            .border-left-primary { border-left-color: #007bff !important; } /* Azul */
            .border-left-success { border-left-color: #28a745 !important; } /* Verde */
            .border-left-warning { border-left-color: #ffc107 !important; } /* Amarelo */
            .border-left-danger { border-left-color: #dc3545 !important; } /* Vermelho */
            .border-left-secondary { border-left-color: #6c757d !important; } /* Cinza */

            /* Espessura e transição */
            .border-left {
                border-left-width: 4px !important;
                transition: border-left-color 0.3s ease;
            }
        </style>
    @endpush
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Ficha de anamnese da Parturiente</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Inicio do Form -->
                            <form class="row g-2" action="{{ route('incluirEvolucao.store') }}" method="POST"
                                  name="formCadastro" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="atendimento_id" value="{{ $atendimento_id }}">
                                <div class="col-md-8 mb-3">
                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <input class="form-control" name="nomeDaPaciente" value="{{ $nome_paciente }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="local" class="form-label">Local:</label>
                                    <select class="form-select" name="local_id">
                                        <option selected>Selecione</option>
                                        @foreach($locals as $local)
{{--                                            <option value="{{ $local->id }}" {{ old('$local_id') == $local->id ? 'selected' : '' }}>{{ $local->nome }}</option>--}}
                                            <option value="{{ $local->id }}" {{ $ultimo_local == $local->id ? 'selected' : '' }}>
                                                {{ $local->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('local_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- FREQUÊNCIA CARDÍACA -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <div class="form-group">
                                        <label for="frequenciaCardiaca" class="form-label">Frequência Cardíaca:</label>

                                        @php $oldFc = old('fc'); @endphp

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_1" value="1" {{ $oldFc == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_1">&lt; 50</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_2" value="2" {{ $oldFc == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_2">50 - 59</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_3" value="3" {{ $oldFc == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_3">60 - 99</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_4" value="4" {{ $oldFc == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_4">100 - 109</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_5" value="5" {{ $oldFc == '5' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_5">110 - 129</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_6" value="6" {{ $oldFc == '6' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fc_6">&gt;= 130</label>
                                        </div>

                                        @error('fc')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- FREQUÊNCIA RESPIRATÓRIA -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <div class="form-group">
                                        <label for="frequenciaRespiratoria" class="form-label">Frequência
                                            Respiratória:</label>

                                        @php $oldFr = old('fr'); @endphp

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_1" value="1" {{ $oldFr == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_1">&lt;= 12</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_2" value="2" {{ $oldFr == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_2">13 - 15</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_3" value="3" {{ $oldFr == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_3">16 - 20</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_4" value="4" {{ $oldFr == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_4">21 - 24</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_5" value="5" {{ $oldFr == '5' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_5">25 - 30</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fr"
                                                   id="fr_6" value="6" {{ $oldFr == '6' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="fr_6">&gt;= 31</label>
                                        </div>

                                        @error('fr')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- PRESSÃO ARTERIAL SISTÓLICA -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <label for="pressaoArterialSistolica" class="form-label">Pressão Arterial
                                        Sistólica:</label>

                                    @php $oldPa = old('PA'); @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_1" value="1" {{ $oldPa == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_1">
                                            < 70
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_2" value="2" {{ $oldPa == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_2">
                                            70 - 89
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_3" value="3" {{ $oldPa == '3' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_3">
                                            90 - 139
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_4" value="4" {{ $oldPa == '4' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_4">
                                            140 - 149
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_5" value="5" {{ $oldPa == '5' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_5">
                                            150 - 159
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="Pas_6" value="6" {{ $oldPa == '6' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pas_6">
                                            >= 160
                                        </label>
                                    </div>

                                    @error('PA')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- PRESSÃO ARTERIAL DIASTÓLICA -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <label for="pressaoArterialDiastolica" class="form-label">Pressão Arterial
                                        Diastólica:</label>

                                    @php $oldPad = old('PAD'); @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="Pad_1" value="1" {{ $oldPad == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pad_1">
                                            < 45
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="Pad_2" value="2" {{ $oldPad == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pad_2">
                                            45 - 89
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="Pad_3" value="3" {{ $oldPad == '3' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pad_3">
                                            90 - 99
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="Pad_4" value="4" {{ $oldPad == '4' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pad_4">
                                            100 - 109
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="Pad_5" value="5" {{ $oldPad == '5' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Pad_5">
                                            >= 110
                                        </label>
                                    </div>
                                    @error('PAD')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- TEMPERATURA -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <label for="temperatura" class="form-label">Temperatura:</label>

                                    @php $oldTemp = old('Temp'); @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="Temp_1" value="1" {{ $oldTemp == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Temp_1">
                                            < 35.0
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="Temp_2" value="2" {{ $oldTemp == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Temp_2">
                                            35.0 - 37.4
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="Temp_3" value="3" {{ $oldTemp == '3' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Temp_3">
                                            37.5 - 37.9
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="Temp_4" value="4" {{ $oldTemp == '4' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Temp_4">
                                            38.0 - 38.9
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="Temp_5" value="5" {{ $oldTemp == '5' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Temp_5">
                                            >= 39.0
                                        </label>
                                    </div>
                                    @error('Temp')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- SATURAÇÃO DE OXIGÊNIO -->
                                <div class="col-md-2 border-left border-left-secondary" id="fc-container">
                                    <label for="saturacaoOxigenio" class="form-label">Saturação de Oxigênio:</label>

                                    @php $oldSo = old('SO'); @endphp

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="So_1" value="1" {{ $oldSo == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="So_1">
                                            < 92
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="So_2" value="2" {{ $oldSo == '2' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="So_2">
                                            92 - 95
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="So_3" value="3" {{ $oldSo == '3' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="So_3">
                                            >= 96
                                        </label>
                                    </div>

                                    @error('SO')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- <div class="col-md-1 border-left-secondary">
                                    <label for="diurese" class="form-label">Diurese:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Di"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 10
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Di"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            11 - 20
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Di"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            21 - 29
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Di"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 30
                                        </label>
                                    </div>

                                </div> -->

                                <div class="col-md-12 mb-3">
                                    <label for="obs" class="form-label">Observações:</label>
                                    <input class="form-control" placeholder="Descreva observações caso exista"
                                           name="obs">
                                </div>

                                <!-- Botão de Enviar -->
                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <button type="submit" class="btn btn-success text-white" value="cadastrar">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check-square"></i>
                                            </span>
                                            <span class="text">Gravar</span>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.statusMeows')
    </div>
    @push('scoresJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Mapeamento de scores (igual ao seu controller)
                const scoreMap = {
                    'fc': { 1:3, 2:1, 3:0, 4:1, 5:2, 6:3 },
                    'fr': { 1:3, 2:2, 3:0, 4:1, 5:2, 6:3 },
                    'PA': { 1:3, 2:2, 3:0, 4:1, 5:2, 6:3 },
                    'PAD': { 1:2, 2:0, 3:1, 4:2, 5:3 },
                    'Temp': { 1:2, 2:0, 3:1, 4:2, 5:3 },
                    'SO': { 1:3, 2:2, 3:0 }
                };

                // Função para atualizar a borda
                function updateBorder(radio) {
                    const container = radio.closest('.border-left');
                    const param = radio.name;
                    const value = radio.value;

                    // Remove todas as classes de cor
                    container.classList.remove(
                        'border-left-primary',
                        'border-left-success',
                        'border-left-warning',
                        'border-left-danger',
                        'border-left-secondary'
                    );

                    // Se estiver marcado, aplica a cor correspondente
                    if (radio.checked) {
                        const score = scoreMap[param][value];

                        switch(score) {
                            case 0: container.classList.add('border-left-primary'); break; // Azul
                            case 1: container.classList.add('border-left-success'); break; // Verde
                            case 2: container.classList.add('border-left-warning'); break; // Amarelo
                            case 3: container.classList.add('border-left-danger'); break;  // Vermelho
                            default: container.classList.add('border-left-secondary');
                        }
                    } else {
                        container.classList.add('border-left-secondary');
                    }
                }

                // Adiciona eventos a todos os radios
                document.querySelectorAll('input[type="radio"]').forEach(radio => {
                    // Atualiza quando muda
                    radio.addEventListener('change', function() {
                        updateBorder(this);
                    });

                    // Atualiza estado inicial
                    updateBorder(radio);
                });
            });
        </script>
    @endpush
@endsection
