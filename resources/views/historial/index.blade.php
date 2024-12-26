<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Sjaboss | Systems</title>
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sjaboss | Systems">
    <meta property="og:description" content="Venta de sitemas">
    <meta property="og:site_name" content="Sjaboss">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/sjaboss/11.png') }}">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
</head>

<body data-bs-spy="scroll">

    <!-- Begin page -->
    <div class="layout-wrapper landing col-12">
        @include('layouts.menufrente')
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">


                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <form action="{{ route('historiales.index') }}" method="get"
                                        class="d-inline-flex">
                                        <input type="month" style="width: 200px" class="form-control flex" id="fecha" name="fecha"
                                        placeholder="Fecha" value="{{ request()->fecha ? request()->fecha : '' }}">
                                        <button type="submit" class="btn btn-primary">Buscar</button>
                                    </form>
                                    @if ( request()->fecha)
                                        <div class="page-title-right">
                                            <p>Resultados para:
                                                @if (request()->fecha)
                                                    Fecha: {{ \Carbon\Carbon::parse(request()->fecha)->format('M/Y') }}
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($noticias as $noticia)
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
                                                                    <a href="{{ route('noticias.show', $noticia->id) }}">
                                                                    <img class="img-fluid w-100 h-100 object-cover"  src="{{ asset('storage') . '/' . $noticia->foto }}"
                                                                        alt="" class="object-cover d-block" />
                                                                    </a>
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
                                                             <a href="{{ route('noticias.show', $noticia->id) }}">
                                                            <h4>{{ $noticia->titulo }}</h4>
                                                             </a>

                                                            <div class="hstack gap-3 flex-wrap">
                                                                <div><a href="#"
                                                                        class="text-primary d-block">{{ $noticia->autor }}</a>
                                                                </div>
                                                                <div class="vr"></div>
                                                                <div class="text-muted">Publicado : <span
                                                                        class="text-body fw-medium">{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                                        <div class="text-muted fs-16">
                                                            <span class="mdi mdi-star text-warning"></span>
                                                            <span class="mdi mdi-star text-warning"></span>
                                                            <span class="mdi mdi-star text-warning"></span>
                                                            <span class="mdi mdi-star text-warning"></span>
                                                            <span class="mdi mdi-star text-warning"></span>
                                                        </div>
                                                        <div class="text-muted">(Review)</div>
                                                    </div>

                                                    <!-- end row -->

                                                    <div class="card-body">
                                                         <a href="{{ route('noticias.show', $noticia->id) }}">
                                                        <p class="card-text mb-2">{!! nl2br(strip_tags($noticia->bajada)) !!}</p>
                                                         </a>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <a href="{{ route('noticias.show', $noticia->id) }}"
                                                            class="btn btn-soft-secondary btn-sm btn-rounded">Ver
                                                            noticia <i class="mdi mdi-magnify ms-1"></i></a>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Paginación -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center flex-wrap">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination pagination-lg d-inline-flex">
                                       {{ $noticias->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </div>
    <!-- Agregar un contenedor alrededor del footer -->
    <div class="footer-container">
        @include('layouts.footer')
    </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- landing init -->
    <script src="{{ asset('assets/js/pages/landing.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarE1 = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarE1, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                },
                events: '{{ route('welcome.fullcalendar') }}',
                eventDidMount: function(info) {
                    if (info.event.backgroundColor) {
                        info.el.style.backgroundColor = info.event.backgroundColor;
                    }

                    if (info.event.borderColor) {
                        info.el.style.borderColor = info.event.borderColor;
                    }
                }
            });

            calendar.render();
        });
    </script>

<script>
    function clearForm() {
        document.getElementById("titulo").value = "";
        document.getElementById("fecha").value = "";
    }
</script>
</body>

</html>

