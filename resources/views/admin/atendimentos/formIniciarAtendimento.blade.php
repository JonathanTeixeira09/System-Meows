@extends('layouts.app')

{{--@section('title', $title)--}}
@section('title', 'Iniciar Atendimento')
@section('conteudo')
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Iniciar Atendimento</h6>
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

                            <!-- Home Form -->
                            <form class="row g-2" action="#" method="POST"
                                  name="formCadastro" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <label for="nomeDaPaciente" class="form-label">Nome da Parturiente:</label>
                                    <input type="text" class="form-control @error('nomeDaPaciente') is-invalid @enderror"
                                           name="nomeDaPaciente" placeholder="" tabindex="1" id="nomeDaPaciente">
                                    <div id="nomeDaPacienteFeedback" class="form-text"></div>
                                    @error('nomeDaPaciente')
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
                                </span><span class="text">Iniciar Atendimento</span>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
