<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Sjaboss | Systems</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sjaboss | Systems">
    <meta property="og:description" content="Venta de sitemas">
    <meta property="og:site_name" content="Sjaboss">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
</head>

<body data-bs-spy="scroll">

    <!-- Begin page -->
    <div class="layout-wrapper landing col-12">
        @include('layouts.menufrente')
        <section class="section pb-0 hero-section" id="hero">
            <div class="bg-overlay bg-overlay-pattern"></div>
            <div class="main-content">




                {{--                    <div class="text-center mt-1">
                                    <h5 class="fs-20">Nos acompañan <span class="text-primary ">desde</span> Siempre
                                    </h5>
                                    <!-- Swiper -->
                                    <div class="swiper trusted-client-slider mt-lg-2 mt-3 mb-sm-2 mb-2" dir="ltr">
                                        <div class="swiper-wrapper">
                                            @foreach ($publicidades as $publicidad)
                                                <div class="swiper-slide">
                                                    <div>
                                                        <img src="{{ asset('storage') . '/' . $publicidad->foto }}"
                                                            alt="client-img"
                                                            style="width: 150px; height: 300px; object-fit: contain;"
                                                            class="mx-auto img-fluid d-block">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div> --}}




                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Sjaboss Sistemas</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item active">{{ $seccion_obj->seccion }}</li>
                                        </ol>
                                    </div>
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
                                                                    <a
                                                                        href="{{ route('noticias.show', $noticia->id) }}">
                                                                        <img class="img-fluid w-100 h-200 object-cover"
                                                                            src="{{ asset('storage') . '/' . $noticia->foto }}"
                                                                            alt=""
                                                                            class="object-cover d-block" />
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


                                                            <!-- end row -->

                                                            <div class="card-body">
                                                                <a href="{{ route('noticias.show', $noticia->id) }}">
                                                                    <p class="card-text mb-2"
                                                                        style="font-family: 'Roboto', sans-serif; font-weight: 400; line-height: 1.6; font-size: 1.1rem;">
                                                                        {!! nl2br(strip_tags($noticia->bajada)) !!}</p>
                                                                    <p class="card-text"><small class="text-muted"
                                                                            style="font-family: 'Roboto', sans-serif; font-weight: 300; line-height: 1.5; font-size: 0.95rem;">{!! nl2br(strip_tags($noticia->nota)) !!}</small>
                                                                    </p>
                                                                </a>
                                                            </div>
                                                            <div class="d-flex justify-content-end mt-2"><a
                                                                    href="#"
                                                                    class="text-primary">{{ $noticia->autor }}</a>
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
                                        {{ $noticias->appends(['lang' => 'es'])->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </div>

    <!-- Modal de Contacto -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalContent">
                    <!-- El contenido del formulario se cargará aquí -->
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
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/nft-landing.init.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function openContactModal() {
            fetch('/contact', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    new bootstrap.Modal(document.getElementById('contactModal')).show();

                    // Agregar el event listener al formulario después de cargarlo
                    const form = document.getElementById('contactForm');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();

                            const formData = new FormData(form);

                            fetch('/contact', {
                                    method: 'POST',
                                    body: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute('content'),
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: '¡Éxito!',
                                            text: 'Tu mensaje ha sido enviado correctamente.',
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        });

                                        // Cerrar el modal
                                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                                            'contactModal'));
                                        if (modal) {
                                            modal.hide();
                                        }

                                        // Limpiar el formulario
                                        form.reset();
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Hubo un problema al enviar tu mensaje.',
                                            icon: 'error',
                                            confirmButtonText: 'Ok'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Hubo un problema al enviar tu mensaje.',
                                        icon: 'error',
                                        confirmButtonText: 'Ok'
                                    });
                                });
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>
