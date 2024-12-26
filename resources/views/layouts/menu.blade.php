<div class="app-menu navbar-menu">

    @php
        use App\Models\Logo;
        $logos = Logo::all();
    @endphp

    <div class="navbar-brand-box">
        <!-- Dark Logo-->

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                @if (Auth::user()->rol_id == 3)
                @endif

                @if (Auth::user()->rol_id == 2)
                    <li class="menu-title"><span>Asesor</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('secciones.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Secciones</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('noticias.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Noticias</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('publicidades.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Publicidades</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('videos.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Videos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('baner.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Baner</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('redes.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Redes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('logos.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Logo</span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->rol_id == 1)
                    <li class="menu-title"><span>Administrador</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('usuarios.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Usuario</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('secciones.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Secciones</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('noticias.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Noticias</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('publicidades.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Publicidades</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('videos.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Videos</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('baner.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Baner</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('redes.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Redes</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('logos.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Logo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('contacts.index') }}">
                            <i class="ri-dashboard-2-line"></i> <span>Mnt.Contactos</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
