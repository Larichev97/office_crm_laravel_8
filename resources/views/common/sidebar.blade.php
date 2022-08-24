<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-money"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Мой Офис</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fa fa-home"></i>
            <span>Главная</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Клиенты
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDownLeads"
           aria-expanded="true" aria-controls="taTpDropDownLeads">
            <i class="fa fa-list-ul"></i>
            <span>Управление клиентами</span>
        </a>
        <div id="taTpDropDownLeads" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('client-list')
                    <a class="collapse-item" href="{{ route('clients.index') }}">Все клиенты</a>
                @endcan

                @can('client-create')
                    <a class="collapse-item" href="{{ route('clients.create') }}">Добавить клиента</a>
                @endcan

                @can('client-import')
                    <a class="collapse-item" href="{{ route('clients.import') }}">Импортировать лиды</a>
                @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Общее
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDownParticipant"
            aria-expanded="true" aria-controls="taTpDropDownParticipant">
            <i class="fa fa-users"></i>
            <span>Сотрудники</span>
        </a>
        <div id="taTpDropDownParticipant" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('user-list')
                <a class="collapse-item" href="{{ route('users.index') }}">Все сотрудники</a>
                @endcan

                @can('user-create')
                    <a class="collapse-item" href="{{ route('users.create') }}">Добавить сотрудника</a>
                @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">


    @hasanyrole('Admin|Director')
    <!-- Heading -->
    <div class="sidebar-heading">
        Настройки
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
           aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-cog"></i>
            <span>Управление</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @can('role-list')
                    <a class="collapse-item" href="{{ route('roles.index') }}">Роли</a>
                @endcan

                @can('permission-list')
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Доступы</a>
                @endcan
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @endhasanyrole

    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            <span>Выйти</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
