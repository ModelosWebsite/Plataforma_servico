<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("admin.index")}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Painel Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{(Route::current()->getName() == "admin.index") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.index") ? "text-primary" : ""}}" href="{{route("admin.index")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item {{(Route::current()->getName() == "admin.view.hero") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.view.hero") ? "text-primary" : ""}}" href="{{route("admin.view.hero")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicial Hero</span>
        </a>
    </li>

    <li class="nav-item {{(Route::current()->getName() == "admin.about") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.about") ? "text-primary" : ""}}" href="{{route("admin.about")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sobre</span>
        </a>
    </li>
    
    <li class="nav-item {{(Route::current()->getName() == "admin.view.services") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.view.services") ? "text-primary" : ""}}" href="{{route("admin.view.services")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Serviços</span>
        </a>
    </li>

    <li class="nav-item {{(Route::current()->getName() == "admin.footer") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.footer") ? "text-primary" : ""}}" href="{{route("admin.footer")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Footer</span>
        </a>
    </li>

    <li class="nav-item {{(Route::current()->getName() == "admin.detail") ? "bg-white" : ""}}">
        <a class="nav-link {{(Route::current()->getName() == "admin.detail") ? "text-primary" : ""}}" href="{{route("admin.detail")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Secção Start</span>
        </a>
    </li>

        
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{Route::current()->getName() == "anuncio.management.view.color" ? "bg-white" : ""}}">
        <a class="nav-link {{Route::current()->getName() == "anuncio.management.view.color" ? "text-primary" : ""}}" href="{{route("anuncio.management.view.color")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Cores</span>
        </a>
    </li>

    <!-- Nav Item - Account -->
    <li class="nav-item {{Route::current()->getName() == "admin.account.view" ? "bg-white" : ""}}">
        <a class="nav-link {{Route::current()->getName() == "admin.account.view" ? "text-primary" : ""}}" href="{{route("admin.account.view")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Minha Conta</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route("anuncio.logout")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sair</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>