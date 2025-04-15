<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('index')}}">
        <div class="sidebar-brand-icon">
            <img src="{{ URL::to('img/logo/logo.png') }}" alt="logo" width="50" height="50">
        </div>
        <div class="sidebar-brand-text mx-2">MEOWS DIGITAL</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('index')}}">
            <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
            <!-- <i class="fas fa-hospital-alt fa-fw"></i> -->
            <i class="fa-regular fa-hospital fa-fw"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Paciente
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <!-- <i class="fas fa-fw fa-user-injured"></i> -->
            <i class="fa-solid fa-person-breastfeeding fa-fw"></i>
            <!-- <i class="bi bi-people-fill fa-fw"></i> -->
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
            <!-- <i class="fa-solid fa-suitcase-medical"></i> -->
            <i class="fa-solid fa-fw fa-laptop-medical"></i>
            <!-- <i class="fas fa-fw fa-notes-medical fa-fw"></i> -->
            <span>Atendimentos</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Atendimentos:</h6>
                <a class="collapse-item" href="{{route('iniciarAtendimento.index')}}">Iniciar Atendimento</a>
                <a class="collapse-item" href="{{route('incluirAnamenese.index')}}">Incluir Anamnese</a>
                <a class="collapse-item" href="{{route('listarAtendimentos.index')}}">Listar Atendimentos</a>
                {{-- <a class="collapse-item" href="utilities-animation.html">Animations</a>--}}
                {{-- <a class="collapse-item" href="utilities-other.html">Other</a>--}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Configurações
    </div>

    <!-- Nav Item - Pacientes Collapse Menu -->
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
            <span>Equipe</span>
        </a>
        <div id="collapseEquipe" class="collapse" aria-labelledby="headingEquipe" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Profissional:</h6>
{{--                <a class="collapse-item" href="#">Cadastrar Cargo</a>--}}
                <a class="collapse-item" href="{{route('cadastroprofissional.index')}}">Cadastrar Profissional</a>
                <a class="collapse-item" href="{{route('listarprofissional.index')}}">Listar Profissionais</a>
            </div>
        </div>
    </li>

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
                <a class="collapse-item" href="{{route('cadastrarCargo.index')}}">Cadastrar Cargo</a>
                <a class="collapse-item" href="{{route('cadastrarFormacao.index')}}">Cadastrar Formação</a>
                <a class="collapse-item" href="{{route('cadastrarLocal.index')}}">Cadastrar Local</a>
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
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
