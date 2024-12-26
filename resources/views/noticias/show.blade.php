<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sjaboss | {{ $seccionObj->seccion }}">
    <meta property="og:description" content="{{ $noticia->titulo }}">
    @if($noticia->foto)
        <meta property="og:image" content="https://sjaboss.com/storage/{{ $noticia->foto }}?resize=200,200&format=jpg">
    @endif
    <meta property="og:site_name" content="sjaboss">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    <!--Swiper slider css-->
    <link href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert css-->
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
</head>

<body data-bs-spy="scroll">
    <section class="section">
        @include('layouts.menufrente')
    </section>

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">{{ $noticia->titulo }}</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="{{ route('seccion', $seccionObj->seccion) }}">{{ $seccionObj->seccion }}</a></li>
                                        <li class="breadcrumb-item active">{{ $noticia->titulo }}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gx-lg-5">
                                        <div class="col-xl-4 col-md-8 mx-auto">
                                            <div class="product-img-slider sticky-side-div">
                                                <div class="swiper product-nav-slider mt-2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <div class="nav-slide-item">
                                                                @if($noticia->foto)
                                                                    <img class="img-fluid w-100 object-cover"
                                                                        src="{{ asset('storage/' . $noticia->foto) }}"
                                                                        alt="{{ $noticia->titulo }}" />
                                                                @else
                                                                    <img class="img-fluid w-100 object-cover"
                                                                        src="{{ asset('assets/images/placeholder.svg') }}"
                                                                        alt="Imagen no disponible" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-8">
                                            <div class="mt-xl-0 mt-5">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <div class="card-body">
                                                            <p class="card-text mb-4"
                                                                style="font-family: 'Roboto', sans-serif; font-weight: 400; line-height: 1.6; font-size: 1.2rem;">
                                                                {!! nl2br(strip_tags($noticia->bajada)) !!}
                                                            </p>
                                                            <p class="card-text"
                                                                style="font-family: 'Roboto', sans-serif; font-weight: 300; line-height: 1.5; font-size: 1rem;">
                                                                {!! nl2br(strip_tags($noticia->nota)) !!}
                                                            </p>
                                                            <div class="mt-4">
                                                                <small class="text-muted">Publicado el {{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-3">
                                                                <span class="text-primary">{{ $noticia->autor }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')

        <!-- JAVASCRIPT -->
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    </body>
</html>
