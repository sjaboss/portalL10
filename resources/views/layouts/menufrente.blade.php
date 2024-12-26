<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<style>
    .btn-custom {
        color: white;
        transition: all 0.3s ease;
        border: none;
        margin: 0 2px;
        padding: 8px 15px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    /* Estilos para el logo */
    .logo-container {
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .logo-image {
        height: 100px;
        max-width: 240px;
        object-fit: contain;
        filter: drop-shadow(2px 2px 4px rgba(0, 0, 0, 0.2));
        transition: all 0.3s ease;
    }

    .logo-image:hover {
        transform: scale(1.02);
        filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.3));
    }

    /* Estilos responsive para el menú */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            position: fixed;
            top: 80px;
            left: 0;
            right: 0;
            background: white;
            padding: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .navbar-nav {
            width: 100%;
        }

        .navbar-nav .nav-item {
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .navbar-nav .btn {
            width: 100%;
            text-align: left;
            padding: 0.75rem 1rem;
            margin: 2px 0;
        }

        .navbar-nav .btn i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
    }
</style>
<div class="layout-wrapper landing col-12">
    <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
        <div class="container">

            @php
                use App\Models\Red;
                use App\Models\Logo;
                $redes = Red::all(); // o cualquier otra forma de obtener los datos
                $logos = Logo::all();
            @endphp
            <a class="navbar-brand" href="{{ route('home') }}" aria-label="Inicio - SJABoss Systems">
                @foreach ($logos as $logo)
                    <div class="logo-container">
                        <img class="logo-image" 
                             src="/storage/logos/{{ basename($logo->foto_medium) }}"
                             alt="Logo SJABoss - Desarrollo Web y Sistemas"
                             width="240"
                             height="100">
                    </div>
                @endforeach
            </a>
            <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="mdi mdi-menu" aria-hidden="true"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav aria-label="Navegación principal">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        @foreach ($secciones->sortBy('orden') as $seccion)
                            <li class="nav-item">
                                <a href="{{ route('seccion', $seccion->seccion) }}" 
                                   class="btn btn-custom"
                                   title="Ver sección {{ $seccion->seccion }}"
                                   style="background: linear-gradient(45deg, {{ $seccion->color }} 0%, rgb(192, 192, 192) 100%);">
                                    @if ($seccion->font_awesome_icon)
                                        <i class="fas fa-{{ $seccion->font_awesome_icon }} me-1" aria-hidden="true"></i>
                                    @endif
                                    <span>{{ $seccion->seccion }}</span>
                                </a>
                            </li>
                        @endforeach
                        
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ url('/dashboard') }}" 
                                       class="btn btn-primary"
                                       title="Ir al panel de control">Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}"
                                       class="btn btn-danger fw-medium text-decoration-none text-dark"
                                       title="Iniciar sesión">Acceder</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" 
                                           class="btn btn-primary"
                                           title="Crear una cuenta nueva">Registrate</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>

        </div>
    </nav>
</div>
