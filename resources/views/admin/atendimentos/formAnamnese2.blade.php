@extends('layouts.app')

{{--@section('title', $title)--}}
@section('title', 'Incluir Anamnese')
@section('conteudo')
    @push('meowsCss')
        <style>
            .green {
                border-color: green !important;
            }

            .yellow {
                border-color: yellow !important;
            }

            .orange {
                border-color: orange !important;
            }

            .red {
                border-color: red !important;
            }

            .green-text {
                color: green !important;
            }

            .yellow-text {
                color: yellow !important;
            }

            .orange-text {
                color: orange !important;
            }

            .red-text {
                color: red !important;
            }
        </style>
    @endpush

    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Incluir Anamnese da Parturiente</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-12">
                                <p class="help-block" style="text-align: right;">
                                    <h11 class="text-danger">*</h11>
                                    Campo Obrigatório
                                </p>
                            </div>

                            <!-- Inicio do Form -->


                            <form class="row g-2" action="{{ route('incluirAnamenese.store') }}" method="POST"
                                  name="formCadastro" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-12">
                                    <!-- <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <input type="text"
                                           class="form-control @error('nomeDaPaciente') is-invalid @enderror"
                                           name="nomeDaPaciente" placeholder="" tabindex="1" id="nomeDaPaciente">
                                    <div id="nomeDaPacienteFeedback" class="form-text"></div>
                                    @error('nomeDaPaciente')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Informe nome da Parturiente">
                                    <datalist id="datalistOptions">
                                        <option value="Maria 1">
                                        <option value="Maria 2">
                                        <option value="Maria 3">
                                        <option value="Maria 4">
                                        <option value="Maria 5">
                                    </datalist>
                                </div>

                                <div class="col-md-1 border-left-secondary">
                                    <div class="form-group">
                                        <label for="frequenciaCardiaca" class="form-label">Frequência Cardíaca:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_1" value="1">
                                            <label class="form-check-label" for="fc_1">
                                                <= 30
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_2" value="2">
                                            <label class="form-check-label" for="fc_2">
                                                31 - 40
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_3" value="3">
                                            <label class="form-check-label" for="fc_3">
                                                41 - 50
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_4" value="4">
                                            <label class="form-check-label" for="fc_4">
                                                51 - 90
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_5" value="5">
                                            <label class="form-check-label" for="fc_5">
                                                91 - 100
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_6" value="6">
                                            <label class="form-check-label" for="fc_6">
                                                101 - 120
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fc"
                                                   id="fc_7" value="7">
                                            <label class="form-check-label" for="fc_7">
                                                >= 121
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1 border-left-secondary">
                                    <label for="frequenciaRespiratoria" class="form-label">Frequência
                                        Respiratória:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 4
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            5 - 8
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            9 - 10
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            11 - 20
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            21 - 24
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            25 - 29
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fr"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 30
                                        </label>
                                    </div>

                                </div>

                                <div class="col-md-2 border-left-secondary">
                                    <label for="pressaoArterialSistolica" class="form-label">Pressão Arterial
                                        Sistólica:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 80
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            81 - 90
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            91 - 100
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            101 - 150
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            151 - 160
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            161 - 170
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PA"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 171
                                        </label>
                                    </div>

                                </div>

                                <div class="col-md-2 border-left-secondary">
                                    <label for="pressaoArterialDiastolica" class="form-label">Pressão Arterial
                                        Diastólica:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 30
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            31 - 40
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            41 - 50
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            51 - 90
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            91 - 100
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            100 - 110
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="PAD"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 111
                                        </label>
                                    </div>

                                </div>

                                <div class="col-md-1 border-left-secondary">
                                    <label for="temperatura" class="form-label">Temperatura:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 35.0
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            35.1 - 36.0
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            36.1 - 37.9
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            38.0 - 38.4
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            38.5 - 38.9
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Temp"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 39.0
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-2 border-left-secondary">
                                    <label for="condicaoNeurologica" class="form-label">Condição Neurológica
                                        (AVPU):</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="CN"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Alerta (A)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="CN"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Responde a voz (V)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="CN"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Responde à dor (P)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="CN"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Inconsciente (U)
                                        </label>
                                    </div>

                                </div>

                                <div class="col-md-1 border-left-secondary">
                                    <label for="saturacaoOxigenio" class="form-label">Saturação de Oxigênio:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <= 91
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            92 - 93
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            94 - 95
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="SO"
                                               id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            >= 96
                                        </label>
                                    </div>

                                </div>

                                <div class="col-md-1 border-left-secondary">
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

    @push('scriptMeows')
        <script>
            $(document).ready(function () {
                // Função para lidar com a resposta AJAX
                function handleResponse(response, inputId, feedbackId) {
                    var input = $(inputId);
                    var feedback = $(feedbackId);

                    // Remove as classes de cor anteriores
                    input.removeClass('green yellow orange red');
                    feedback.removeClass('green-text yellow-text orange-text red-text');

                    // Adiciona as classes de cor novas
                    input.addClass(response.status);
                    feedback.addClass(response.status + '-text');

                    // Atualiza a mensagem de feedback
                    feedback.text(response.message);
                }

                // Função para enviar os dados AJAX
                function sendAjaxRequest() {
                    $.ajax({
                        url: '{{ route("incluirAnamenese.store") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            frequenciaCardiaca: $('#frequenciaCardiaca').val(),
                            frequenciaRespiratoria: $('#frequenciaRespiratoria').val(),
                            pressaoArterialSistolica: $('#pressaoArterialSistolica').val(),
                            pressaoArterialDiastolica: $('#pressaoArterialDiastolica').val(),
                            temperatura: $('#temperatura').val(),
                            condicaoNeurologica: $('#condicaoNeurologica').val(),
                            saturacaoOxigenio: $('#saturacaoOxigenio').val(),
                            diurese: $('#diurese').val()
                        },
                        success: function (response) {
                            handleResponse({
                                status: response.scores.frequenciaCardiaca,
                                message: response.messages.frequenciaCardiaca
                            }, '#frequenciaCardiaca', '#frequenciaCardiacaFeedback');
                            handleResponse({
                                status: response.scores.frequenciaRespiratoria,
                                message: response.messages.frequenciaRespiratoria
                            }, '#frequenciaRespiratoria', '#frequenciaRespiratoriaFeedback');
                            handleResponse({
                                status: response.scores.pressaoArterialSistolica,
                                message: response.messages.pressaoArterialSistolica
                            }, '#pressaoArterialSistolica', '#pressaoArterialSistolicaFeedback');
                            handleResponse({
                                status: response.scores.pressaoArterialDiastolica,
                                message: response.messages.pressaoArterialDiastolica
                            }, '#pressaoArterialDiastolica', '#pressaoArterialDiastolicaFeedback');
                            handleResponse({
                                status: response.scores.temperatura,
                                message: response.messages.temperatura
                            }, '#temperatura', '#temperaturaFeedback');
                            handleResponse({
                                status: response.scores.condicaoNeurologica,
                                message: response.messages.condicaoNeurologica
                            }, '#condicaoNeurologica', '#condicaoNeurologicaFeedback');
                            handleResponse({
                                status: response.scores.saturacaoOxigenio,
                                message: response.messages.saturacaoOxigenio
                            }, '#saturacaoOxigenio', '#saturacaoOxigenioFeedback');
                            handleResponse({
                                status: response.scores.diurese,
                                message: response.messages.diurese
                            }, '#diurese', '#diureseFeedback');
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }

                // Adiciona evento blur para todos os campos
                $('#frequenciaCardiaca, #frequenciaRespiratoria, #pressaoArterialSistolica, #pressaoArterialDiastolica, #temperatura, #condicaoNeurologica, #saturacaoOxigenio, #diurese').blur(function () {
                    sendAjaxRequest();
                });
            });
        </script>

    @endpush

@endsection
