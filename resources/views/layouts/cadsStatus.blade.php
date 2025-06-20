<div class="row">
    @auth
        @if(auth()->user()->isSuperAdmin() || auth()->user()->isProfissional())
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pessoas Atendidas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAtendimentos }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-fill-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pessoas deram Alta</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAltas }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-up fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Internadas
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalInternados }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Aguardando Atendimento</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pacientesNaoAtendidos }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-person-lines-fill fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

        @endif
    @endauth
    @auth
        @if(auth()->user()->isAdmin())
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Usuários Ativos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsersAtivos }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-fill-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
{{--                <div class="col-xl-3 col-md-6 mb-4">--}}
{{--                    <div class="card border-left-success shadow h-100 py-2">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col mr-2">--}}
{{--                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">--}}
{{--                                        Pessoas deram Alta</div>--}}
{{--                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAltas }}</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-auto">--}}
{{--                                    <i class="bi bi-person-up fa-2x text-gray-300"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Usuários Inativos
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalUsersInativos }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-person-down fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
{{--                <div class="col-xl-3 col-md-6 mb-4">--}}
{{--                    <div class="card border-left-warning shadow h-100 py-2">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="row no-gutters align-items-center">--}}
{{--                                <div class="col mr-2">--}}
{{--                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                        Aguardando Atendimento</div>--}}
{{--                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pacientesNaoAtendidos }}</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-auto">--}}
{{--                                    <i class="bi bi-person-lines-fill fa-2x text-gray-300"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
        @endif
    @endauth

</div>
