<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @auth
                    @php
                        // Dados seguros com fallback
                        $user = Auth::user();
                        $nome = optional($user->profissional)->nome ?? $user->name;
                    @endphp
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$nome}}</span>
{{--                <img class="img-profile rounded-circle" src="Authstorage/{{ Auth::user()->profissional->thumbnail }}" style="object-fit: cover; object-position: center center; /* Foco no centro */">--}}
                <img class="img-profile rounded-circle" src="{{ asset('storage/' . Auth::user()->profissional->thumbnail) }}" style="object-fit: cover; object-position: center center; /* Foco no centro */">
                @endauth
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configurações
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Log de Atividade
                </a>
            </div>
        </li>
        <li class="nav-item d-flex align-items-center">
            <a href="{{route('logout')}}" class="nav-link">
                <i class="fas fa-sign-out-alt fa-1x mr-1 text-gray-600"></i>
                <span class="text-gray-600">Sair </span>
            </a>
        </li>

    </ul>

</nav>
