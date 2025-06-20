<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
        <div class="sidebar-brand-icon">
            <img src="{{ URL::to('img/logo/logo.png') }}" alt="logo" width="50" height="50">
        </div>
        <div class="sidebar-brand-text">MEOWS DIGITAL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('index')}}">
            <i class="fa-regular fa-hospital fa-fw"></i>
            <span>Dashboard</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    @auth
        @if(auth()->user() && (auth()->user()->isProfissional() || auth()->user()->isSuperAdmin()))
    <!-- Heading -->
    <div class="sidebar-heading">
        Paciente
    </div>

    <!-- Nav Item - Pacientes Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-person-breastfeeding fa-fw"></i>
            <span>Pacientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pacientes:</h6>
                <a class="collapse-item" href="{{route('cadastrarpaciente.index')}}">Cadastrar novo paciente</a>
                <a class="collapse-item" href="{{route('listarpaciente.index')}}">Listar Pacientes</a>
                <a class="collapse-item" href="#">Prontuário</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Atendimento
    </div>

    <!-- Nav Item - Atendimentos Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-fw fa-laptop-medical"></i>
            <span>Atendimentos</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Atendimentos:</h6>
                <a class="collapse-item" href="{{route('iniciarAtendimento.index')}}">Iniciar Atendimento</a>
{{--                <a class="collapse-item" href="{{route('incluirEvolucao.index')}}">Incluir Anamnese</a>--}}
                <a class="collapse-item" href="{{route('listarAtendimentos.index')}}">Listar Atendimentos</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
       @endif
    @endauth
    @auth
        @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
    <!-- Heading -->
    <div class="sidebar-heading">
        Configurações
    </div>

    <!-- Nav Item - Usuários Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <!-- <i class="fas fa-fw fa-user-md"></i> -->
            <i class="fa-solid fa-users-gear fa-fw"></i>
            <span>Usuários</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Usuários:</h6>
                <a class="collapse-item" href="{{route('register.index')}}">Cadastrar Usuário</a>
                <a class="collapse-item" href="{{route('listarusuarios.index')}}">Listar Usuários</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEquipe" aria-expanded="true" aria-controls="collapseEquipe">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Profissional</span>
        </a>
        <div id="collapseEquipe" class="collapse" aria-labelledby="headingEquipe" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Profissional:</h6>
                <a class="collapse-item" href="{{route('cadastroprofissional.index')}}">Cadastrar Profissional</a>
                <a class="collapse-item" href="{{route('listarprofissional.index')}}">Listar Profissionais</a>
            </div>
        </div>
    </li>
        @endif
    @endauth


    <!-- Heading -->
    <div class="sidebar-heading">
        Adminstração
    </div>

    <!-- Nav Item - Administração Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdministrativo" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <span>Administração</span>
        </a>
        <div id="collapseAdministrativo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administração:</h6>
                @auth
                    @if(auth()->user()->isAdmin() || auth()->user()->isSuperAdmin())
                <a class="collapse-item" href="{{route('cadastrarCargo.index')}}">Cadastrar Cargo</a>
                <a class="collapse-item" href="{{route('cadastrarFormacao.index')}}">Cadastrar Formação</a>
                    @endif
                @endauth
                @auth
                    @if(auth()->user()->isProfissional() || auth()->user()->isSuperAdmin())
                <a class="collapse-item" href="{{route('cadastrarLocal.index')}}">Cadastrar Local</a>
                    @endif
                @endauth
{{--                <a class="collapse-item" href="#">Cadastrar Procedimentos <br>de Deterioração</a>--}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Sobre Mim -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('sobremim.index')}}">
            <i class="fa-solid fa-address-card"></i>
            <span>Sobre Mim</span>
        </a>
    </li>

    <!-- Divider -->
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
