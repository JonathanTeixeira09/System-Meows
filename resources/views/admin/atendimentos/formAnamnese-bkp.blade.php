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

    <div class="col-xl-12 col-lg-12">
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
                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <input type="text"
                                           class="form-control @error('nomeDaPaciente') is-invalid @enderror"
                                           name="nomeDaPaciente" placeholder="" tabindex="1" id="nomeDaPaciente">
                                    <div id="nomeDaPacienteFeedback" class="form-text"></div>
                                    @error('nomeDaPaciente')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="frequenciaCardiaca" class="form-label">Frequência Cardíaca:</label>
                                    <input type="text"
                                           class="form-control @error('frequenciaCardiaca') is-invalid @enderror"
                                           name="frequenciaCardiaca" placeholder="FC(bat/min)" tabindex="2"
                                           id="frequenciaCardiaca">
                                    <div id="frequenciaCardiacaFeedback" class="form-text"></div>
                                    @error('frequenciaCardiaca')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="frequenciaRespiratoria" class="form-label">Frequência
                                        Respiratória:</label>
                                    <input type="text"
                                           class="form-control @error('frequenciaRespiratoria') is-invalid @enderror"
                                           name="frequenciaRespiratoria" placeholder="FR(inc/min)" tabindex="3"
                                           id="frequenciaRespiratoria">
                                    <div id="frequenciaRespiratoriaFeedback" class="form-text"></div>
                                    @error('frequenciaRespiratoria')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="pressaoArterialSistolica" class="form-label">Pressão Arterial
                                        Sistólica:</label>
                                    <input type="text"
                                           class="form-control @error('pressaoArterialSistolica') is-invalid @enderror"
                                           name="pressaoArterialSistolica" placeholder="PAS(mmHg)" tabindex="4"
                                           id="pressaoArterialSistolica">
                                    <div id="pressaoArterialSistolicaFeedback" class="form-text"></div>
                                    @error('pressaoArterialSistolica')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="pressaoArterialDiastolica" class="form-label">Pressão Arterial
                                        Diastólica:</label>
                                    <input type="text"
                                           class="form-control @error('pressaoArterialDiastolica') is-invalid @enderror"
                                           name="pressaoArterialDiastolica" placeholder="PAD(mmHg)" tabindex="5"
                                           id="pressaoArterialDiastolica">
                                    <div id="pressaoArterialDiastolicaFeedback" class="form-text"></div>
                                    @error('pressaoArterialDiastolica')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="temperatura" class="form-label">Temperatura:</label>
                                    <input type="text" class="form-control @error('temperatura') is-invalid @enderror"
                                           name="temperatura" placeholder="°C" tabindex="6" id="temperatura">
                                    <div id="temperaturaFeedback" class="form-text"></div>
                                    @error('temperatura')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="condicaoNeurologica" class="form-label">Condição Neurológica
                                        (AVPU):</label>
                                    <input type="text"
                                           class="form-control @error('condicaoNeurologica') is-invalid @enderror"
                                           name="condicaoNeurologica" placeholder="Nível de Consciência" tabindex="7"
                                           id="condicaoNeurologica">
                                    <div id="condicaoNeurologicaFeedback" class="form-text"></div>
                                    @error('condicaoNeurologica')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="saturacaoOxigenio" class="form-label">Saturação de Oxigênio:</label>
                                    <input type="text"
                                           class="form-control @error('saturacaoOxigenio') is-invalid @enderror"
                                           name="saturacaoOxigenio" placeholder="SpO2(%)" tabindex="8"
                                           id="saturacaoOxigenio">
                                    <div id="saturacaoOxigenioFeedback" class="form-text"></div>
                                    @error('saturacaoOxigenio')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="diurese" class="form-label">Diurese:</label>
                                    <input type="text" class="form-control @error('diurese') is-invalid @enderror"
                                           name="diurese" placeholder="ml/h" tabindex="9" id="diurese">
                                    <div id="diureseFeedback" class="form-text"></div>
                                    @error('diurese')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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


                            {{--                            <form class="row g-2" action="{{ route('incluirAnamenese.store') }}" method="POST"--}}
                            {{--                                  name="formCadastro"--}}
                            {{--                                  enctype="multipart/form-data">--}}
                            {{--                                @csrf--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('nomeDaPaciente') is-invalid @enderror"--}}
                            {{--                                           name="nomeDaPaciente"--}}
                            {{--                                           placeholder="" tabindex="1" id="nomeDaPaciente">--}}
                            {{--                                    <div id="nomeDaPacienteFeedback" class="form-text"></div>--}}
                            {{--                                    @error('nomeDaPaciente')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="frequenciaCardiaca" class="form-label">Frequência Cardíaca:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('frequenciaCardiaca') is-invalid @enderror"--}}
                            {{--                                           name="frequenciaCardiaca"--}}
                            {{--                                           placeholder="FC(bat/min)" tabindex="1" id="frequenciaCardiaca">--}}
                            {{--                                    <div id="frequenciaCardiacaFeedback" class="form-text"></div>--}}
                            {{--                                    @error('frequenciaCardiaca')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="pressaoArterial" class="form-label"> Pressão Arterial:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('pressaoArterial') is-invalid @enderror"--}}
                            {{--                                           name="pressaoArterial"--}}
                            {{--                                           placeholder="PA(mmHg)" tabindex="2">--}}
                            {{--                                    @error('pressaoArterial')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="frequenciaRespiratoria" class="form-label"> Pressão Arterial:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('frequenciaRespiratoria') is-invalid @enderror"--}}
                            {{--                                           name="frequenciaRespiratoria"--}}
                            {{--                                           placeholder="FR(inc/min)" tabindex="3">--}}
                            {{--                                    @error('frequenciaRespiratoria')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="temperatura" class="form-label"> Temperatura:</label>--}}
                            {{--                                    <input type="text" class="form-control @error('temperatura') is-invalid @enderror"--}}
                            {{--                                           name="temperatura"--}}
                            {{--                                           placeholder="°C" tabindex="4">--}}
                            {{--                                    @error('temperatura')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <label for="nivelConsciencia" class="form-label"> Nível de Consciência:</label>--}}
                            {{--                                    <input type="text"--}}
                            {{--                                           class="form-control @error('nivelConsciencia') is-invalid @enderror"--}}
                            {{--                                           name="nivelConsciencia"--}}
                            {{--                                           placeholder="Nível de Consciência" tabindex="5">--}}
                            {{--                                    @error('nivelConsciencia')--}}
                            {{--                                    <div class="invalid-feedback">--}}
                            {{--                                        {{ $message }}--}}
                            {{--                                    </div>--}}
                            {{--                                    @enderror--}}
                            {{--                                </div>--}}

                            {{--                                <!-- Botão de Enviar -->--}}
                            {{--                                <div class="col-md-12">--}}
                            {{--                                    <p style="text-align: right;">--}}
                            {{--                                        <button type="submit" class="btn btn-success text-white" value="cadastrar">--}}
                            {{--                                                <span class="icon text-white-50">--}}
                            {{--                                                    <i class="fas fa-check-square"></i>--}}
                            {{--                                                </span>--}}
                            {{--                                            <span class="text">Gravar</span>--}}
                            {{--                                        </button>--}}
                            {{--                                    </p>--}}
                            {{--                                </div>--}}
                            {{--                            </form>--}}
                            <!-- Fim -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
