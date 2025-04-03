@extends('layouts.app')

@section('title', 'Cadastro de Usuário')
@section('conteudo')

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Criar Novo Usuário</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <!-- Formulario -->
                    <form class="row g-3" action="{{route('register.store')}}" method="POST" name="formCadastroUser"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <p class="help-block" style="text-align: right;">
                                            <h11 class="text-danger">*</h11>
                                            Campo Obrigatório
                                        </p>
                                    </div>

                                    <!-- Campo Nome (com datalist de profissionais) -->
                                    <div class="col-md-6">
                                        <label for="nome_profissional" class="form-label">Nome do Profissional
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                               class="form-control @error('nome_profissional') is-invalid @enderror"
                                               id="nome_profissional"
                                               name="nome_profissional"
                                               list="profissionais-list"
                                               placeholder="Digite o nome do profissional"
                                               autocomplete="off"
                                               value="{{ old('nome_profissional') }}"
                                        >
                                        <datalist id="profissionais-list">
                                            @foreach($profissional as $profissionals)
                                                <option value="{{ $profissionals->nome }}"
                                                        data-id="{{ $profissionals->id }}">
                                            @endforeach
                                        </datalist>
                                        <input type="hidden" name="profissional_id" id="profissional_id"
                                               value="{{ old('profissional_id') }}">
                                        @error('nome_profissional')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                        >
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Senha -->
                                    <div class="col-md-4">
                                        <label for="password" class="form-label">
                                            Senha <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                        <input
                                            type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password"
                                            name="password"
                                            minlength="8"
                                        >
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">
                                            Mínimo de 8 caracteres
                                        </small>

                                    </div>

                                    <!-- Confirmação de Senha -->
                                    <div class="col-md-4">
                                        <label for="password_confirmation" class="form-label">
                                            Confirmar Senha <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="password"
                                            class="form-control"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                        >
                                    </div>

                                    <!-- Permissão (Role) -->
                                    <div class="col-md-4">
                                        <label for="permissao" class="form-label">
                                            Permissão de acesso <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            class="form-select @error('permissao') is-invalid @enderror"
                                            id="permissao"
                                            name="permissao"
                                        >
                                            <option value="" disabled selected>Selecione...</option>
                                            <option value="admin" {{ old('permissao') == 'admin' ? 'selected' : '' }}>
                                                Administrador
                                            </option>
                                            <option value="profissional" {{ old('permissao') == 'profissional' ? 'selected' : '' }}>
                                                Profissional
                                            </option>
                                            <option
                                                value="superadmin" {{ old('permissao') == 'superadmin' ? 'selected' : '' }}>
                                                Super Administrador
                                            </option>
                                        </select>
                                        @error('permissao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-md-12">
                                        <p style="text-align: right;">
                                            <a href="{{route('index')}}" class="btn btn-warning btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text">Voltar</span>
                                            </a>
                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check-square"></i>
                                                </span>
                                                <span class="text">Gravar</span>
                                            </button>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('createUserJS')
    <script>
        // Atualiza o campo hidden com o ID do profissional selecionado
        document.getElementById('nome_profissional').addEventListener('input', function () {
            const input = this;
            const datalist = document.getElementById('profissionais-list');
            const options = datalist.getElementsByTagName('option');

            for (let option of options) {
                if (option.value === input.value) {
                    document.getElementById('profissional_id').value = option.dataset.id;
                    return;
                }
            }
            // Limpa o ID se não encontrar correspondência
            document.getElementById('profissional_id').value = '';
        });
    </script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endpush
