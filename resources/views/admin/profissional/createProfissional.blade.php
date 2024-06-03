@extends('layouts.app')

@section('title', 'Cadastro Profissional')
@section('conteudo')
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Adicionar Novo Profissional</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <div class="row">
                        <div class="col-sm-2 form-group text-center align-self-center">
                            <img class="img-thumbnail" src="img/logo/user-admin.jpg" width="150px" height="130px" id="foto_thumbnail">
                            <button id="upload_foto" type="button" class="btn btn-sm btn-primary mt-2 mb-0 w-100" title="Fazer upload da foto" data-toggle="modal" data-target=".modal-lg">
                                <i class="fa fa-camera"></i>
                                <span>Carregar Foto</span>
                            </button>
                                <div class="checkbox clip-check check-primary mt-2">
                                    <input type="checkbox" id="deletar_foto" name="deletar_foto" title="Deletar foto">
                                    <label for="deletar_foto">Excluir a foto?</label>
                                </div>
                        </div>

                        <div class="col-md-10">
                            <div class="col-md-12">
                                <p class="help-block" style="text-align: right;"><h11 class="text-danger">*</h11> Campo Obrigatório </p>
                            </div>

                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome" class="form-label">Nome<h11 class="text-danger">*</h11> </label>
                                    <input type="text" class="form-control" id="nome">
                                </div>
                                <div class="col-md-3">
                                    <label for="sexo" class="form-label">Sexo<h11 class="text-danger">*</h11> </label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecione</option>
                                        <option value="1">Feminino</option>
                                        <option value="2">Masculino</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="dtNasc" class="form-label">Data Nascimento<h11 class="text-danger">*</h11> </label>
                                    <input type="date" class="form-control" id="dtNasc">
                                </div>

                                <div class="col-md-4">
                                    <label for="cpf" class="form-label">CPF<h11 class="text-danger">*</h11> </label>
                                    <input type="text" class="form-control" id="cpf">
                                </div>
                                <div class="col-md-4">
                                    <label for="formacao" class="form-label">Formação</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecione</option>
                                        <option value="16">Acompanhante Terapêutica</option>
                                        <option value="7">Assistente Social</option>
                                        <option value="8">Bio Médico</option>
                                        <option value="10">Enfermeiro</option>
                                        <option value="5">Fisioterapeuta</option>
                                        <option value="9">Fonoaudiólogo</option>
                                        <option value="1">Médico</option>
                                        <option value="6">Nutricionista</option>
                                        <option value="17">Pedagogo</option>
                                        <option value="4">Psicologo</option>
                                        <option value="20">Psicomotricista</option>
                                        <option value="15">Psicopedagogo</option>
                                        <option value="11">Téc. Enfermagem</option>
                                        <option value="12">Téc. Radiologia</option>
                                        <option value="14">Terapeuta Ocupacional</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="cargo" class="form-label">Cargo<h11 class="text-danger">*</h11> </label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecione</option>
                                        <option value="16">Acompanhante Terapêutica</option>
                                        <option value="7">Assistente Social</option>
                                        <option value="8">Bio Médico</option>
                                        <option value="10">Enfermeiro</option>
                                        <option value="5">Fisioterapeuta</option>
                                        <option value="9">Fonoaudiólogo</option>
                                        <option value="1">Médico</option>
                                        <option value="6">Nutricionista</option>
                                        <option value="17">Pedagogo</option>
                                        <option value="4">Psicologo</option>
                                        <option value="20">Psicomotricista</option>
                                        <option value="15">Psicopedagogo</option>
                                        <option value="11">Téc. Enfermagem</option>
                                        <option value="12">Téc. Radiologia</option>
                                        <option value="14">Terapeuta Ocupacional</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="conselho" class="form-label">Conselho<h11 class="text-danger">*</h11> </label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Selecione</option>
                                        <option value="COREN">COREN</option>
                                        <option value="CRAS">CRAS</option>
                                        <option value="CRBM">CRBM</option>
                                        <option value="CREFITO">CREFITO</option>
                                        <option value="CRF">CRF</option>
                                        <option value="CRFA">CRFA</option>
                                        <option value="CRM" selected="">CRM</option>
                                        <option value="CRN">CRN</option>
                                        <option value="CRO">CRO</option>
                                        <option value="CRP">CRP</option>
                                        <option value="CRTR">CRTR</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="registro" class="form-label">Registro Profissional<h11 class="text-danger">*</h11> </label>
                                    <input type="text" class="form-control" id="registro">
                                </div>
                                <div class="col-md-4">
                                    <label for="rqe" class="form-label">Registro de qualificação de especialista (RQE)</label>
                                    <input type="text" class="form-control" id="rqe">
                                </div>

                                <div class="col-md-12">
                                    <p style="text-align: right;">
                                        <a href="#" class="btn btn-primary btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check-square"></i>
                                            </span>
                                            <span class="text">Gravar</span>
                                        </a>
                                        <a href="{{route('index')}}" class="btn btn-warning btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-arrow-left"></i>
                                            </span>
                                            <span class="text">Voltar</span>
                                        </a>
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
