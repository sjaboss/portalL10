<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">


<head>
    <meta charset="utf-8" />
    <title>Sjaboss | Systems</title>
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="systems">
    <meta property="og:description" content="Venta de sitemas">
    <meta property="og:site_name" content="Sjaboss">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/sjaboss/11.png') }}">
    @vite(['resources/css/app.css'])

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


<!-- Begin page -->
<section class="section">
    <div class="bootstrap-only">
        @include('layouts.menufrente')
    </div>
</section>

<div class="layout-wrapper landing col-12">
    <section class="section">
        <!-- start publicidad section -->
        <div class="container ">
            <div class="row">
                <div class="col-xl-12">
                    <div class="text-center">
                        <h5 class="fs-1">Nos acompañan desde Siempre en <span class="text-primary ">Sjaboss</span></h5>
                                Populares</span>
                        </h5>
                        <!-- Swiper -->
                        <div class="swiper trusted-client-slider mt-lg-4 mt-3 mb-sm-2 mb-2" dir="ltr">
                            <div class="swiper-wrapper">
                                @foreach ($publicidades as $publicidad)
                                    <div class="swiper-slide">
                                        <div>
                                            <img src="{{ asset('storage') . '/' . $publicidad->foto }}" alt="client-img"
                                                style="width: 300px; height: 200px; object-fit: contain;"
                                                class="mx-auto img-fluid d-block">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        {{-- secion de videos  --}}
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <section class="d-flex justify-content-center">
                @if ($videos->count() > 0)
                    @foreach ($videos->sortBy('orden')->chunk(3) as $grupoVideos)
                        <div class="container">
                            <div class="row g-3">
                                <div class="row">
                                    @foreach ($grupoVideos as $video)
                                        <div class="col-lg-4">
                                            <div class="d-flex p-3 rounded-3 shadow-sm border">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-18">{{ $video->titulo }}</h5>
                                                    <div>
                                                        <iframe src="{{ $video['src'] }}" title="YouTube video player"
                                                            frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                            referrerpolicy="strict-origin-when-cross-origin"
                                                            allowfullscreen></iframe>
                                                    </div>
                                                    <p class="text-muted my-3 ff-secondary">{{ $video['pie'] }}</p>
                                                    <p class="card-text"><small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($video->fecha)->format('d/m/Y') }}</small>
                                                    </p>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </section>

            {{-- noticias --}}
            <div class="pt-1 mt-1">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="justify-content-between d-flex align-items-center mt-3 mb-4">
                                <h5 class="mb-0 pb-1 text-prima fw-semibold">Te lo contamos!</h5>
                            </div>
                            @if ($noticias->count() > 0)
                                @foreach ($noticias->chunk(3) as $grupoNoticias)
                                    <div class="row">
                                        @foreach ($grupoNoticias as $noticia)
                                            <div class="col-xxl-4">
                                                <div class="card">
                                                    <div class="row g-0">
                                                        <a href="{{ route('noticias.show', $noticia->id) }}">
                                                            <img class="rounded-start img-fluid w-100 h-100 object-cover"
                                                                src="{{ asset('storage') . '/' . $noticia->foto }}"
                                                                alt="Card image">
                                                        </a>
                                                        <div class="col-lg-12">
                                                            <div class="card-header">
                                                                <h5 class="card-title mb-0">
                                                                    <a href="{{ route('noticias.show', $noticia->id) }}"
                                                                        class="text-decoration-none text-dark">
                                                                        {{ $noticia->titulo }}
                                                                    </a>
                                                                </h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="card-text mb-2">
                                                                    {!! nl2br(strip_tags($noticia->bajada)) !!}
                                                                </p>
                                                                <p class="card-text"><small
                                                                        class="text-muted">{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small>
                                                                </p>
                                                            </div>
                                                            <div class="card-footer text-end">
                                                                <a href="{{ route('noticias.show', $noticia->id) }}"
                                                                    class="btn btn-soft-secondary btn-sm btn-rounded">Ver
                                                                    noticia <i class="mdi mdi-magnify ms-1"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- end card -->
                                            </div><!-- end col -->
                                        @endforeach
                                    </div><!-- end row -->
                                    <div class="clearfix"></div>
                                @endforeach
                            @else
                                <div class="alert alert-info">
                                    <h5>No hay noticias cargadas</h5>
                                    <p>Lo sentimos, no hay noticias disponibles en este momento.</p>
                                </div>
                            @endif
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>

</div>
</section>


<!-- Tarjeta moderna con la nueva paleta de colores -->
<div class="tailwind-component">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
        <!-- Encabezado con degradado -->
        <div class="bg-gradient-to-r from-primary-500 to-secondary-500 p-4">
            <h2 class="text-white text-xl font-bold">Título de la Tarjeta</h2>
            <p class="text-primary-50">Subtítulo descriptivo</p>
        </div>

        <!-- Contenido principal -->
        <div class="p-6">
            <p class="text-neutral-700">Contenido principal de la tarjeta con texto en color neutral.</p>

            <!-- Etiquetas de estado -->
            <div class="flex gap-2 mt-4">
                <span class="bg-success-100 text-success-700 px-2 py-1 rounded-full text-sm">Activo</span>
                <span class="bg-accent-100 text-accent-700 px-2 py-1 rounded-full text-sm">Destacado</span>
            </div>

            <!-- Sección de estadísticas -->
            <div class="grid grid-cols-3 gap-4 mt-6 p-4 bg-neutral-50 rounded-lg">
                <div class="text-center">
                    <p class="text-primary-600 font-bold">100+</p>
                    <p class="text-neutral-600 text-sm">Usuarios</p>
                </div>
                <div class="text-center">
                    <p class="text-secondary-600 font-bold">50k</p>
                    <p class="text-neutral-600 text-sm">Visitas</p>
                </div>
                <div class="text-center">
                    <p class="text-accent-600 font-bold">4.9</p>
                    <p class="text-neutral-600 text-sm">Rating</p>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex gap-3 mt-6">
                <button class="flex-1 bg-primary-500 hover:bg-primary-600 text-white py-2 px-4 rounded-lg transition-colors duration-200">
                    Aceptar
                </button>
                <button class="flex-1 border border-neutral-300 hover:border-neutral-400 text-neutral-700 py-2 px-4 rounded-lg transition-colors duration-200">
                    Cancelar
                </button>
            </div>
        </div>

        <!-- Pie de tarjeta -->
        <div class="border-t border-neutral-200 p-4 bg-neutral-50">
            <p class="text-sm text-neutral-600">Última actualización: <span class="text-primary-600">Hace 2 días</span></p>
        </div>
    </div>
</div>

{{-- banner --}}
@if ($baners->count() > 0)
    <section class="section bg-primary" id="reviews">
        <div class="bg-overlay bg-overlay-pattern"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center">
                        <!-- Swiper -->
                        <div class="swiper client-review-swiper rounded" dir="ltr">
                            <div class="swiper-wrapper">
                                @foreach ($baners->sortBy('orden') as $baner)
                                    <div class="swiper-slide">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <div class="text-white-50">
                                                    <p class="fs-20 ff-secondary mb-4">{{ $baner->titulo }}</p>
                                                    <div class="swiper-slide">
                                                        <div>
                                                            <img src="{{ asset('storage') . '/' . $baner->foto }}"
                                                                alt="client-img"
                                                                style="width: 600px; height: 300px; object-fit: contain;"
                                                                class="mx-auto img-fluid d-block">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="text-white">{{ $baner->pie }}</h5>
                                                        <p class="card-text"><small
                                                                class="text-muted">{{ \Carbon\Carbon::parse($baner->fecha)->format('d/m/Y') }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end slide -->
                                @endforeach
                            </div>
                            <div class="swiper-button-next bg-white rounded-circle"></div>
                            <div class="swiper-button-prev bg-white rounded-circle"></div>
                            <div class="swiper-pagination position-relative mt-2"></div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
@endif

@include('layouts.footer')

</section>
</div>
<!-- end layout wrapper -->

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
</body>



</html>
