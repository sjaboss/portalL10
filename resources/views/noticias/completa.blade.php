<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sjaboss | {{ $seccionObj->seccion }}">
    <meta property="og:description" content="Noticias de {{ $seccionObj->seccion }}">
    @if ($noticias->isNotEmpty() && $noticias->first()->foto)
        <meta property="og:image"
            content="https://sjaboss.com/storage/{{ $noticias->first()->foto }}?resize=200,200&format=jpg">
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
                                <h4 class="mb-sm-0">Sjaboss Sistemas</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">{{ $seccionObj->seccion }}</li>
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
                                        @foreach ($noticias as $noticia)
                                            <div class="col-xl-4 col-md-8 mx-auto mb-4">
                                                <div class="product-img-slider sticky-side-div">
                                                    <div class="swiper product-nav-slider mt-2">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide">
                                                                <div class="nav-slide-item">
                                                                    @if ($noticia->foto)
                                                                        <img class="img-fluid w-100 h-200 object-cover"
                                                                            src="{{ asset('storage/' . $noticia->foto) }}"
                                                                            alt="{{ $noticia->titulo }}" />
                                                                    @else
                                                                        <img class="img-fluid w-100 h-200 object-cover"
                                                                            src="{{ asset('assets/images/placeholder.svg') }}"
                                                                            alt="Imagen no disponible" />
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <h3 class="mb-3">{{ $noticia->titulo }}</h3>
                                                    <p class="text-muted">{{ $noticia->bajada }}</p>
                                                    <div class="d-flex flex-column align-items-center gap-3">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center w-100">
                                                            <small
                                                                class="text-muted">{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }}</small>
                                                            <a href="{{ route('noticias.show', $noticia->id) }}"
                                                                class="btn btn-primary btn-sm">Leer más</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <!-- Botón de contacto centralizado -->
                                    <div class="row mt-5">
                                        <div class="col-12 text-center">
                                            <a href="javascript:void(0);" onclick="openContactModal()"
                                                class="btn btn-primary btn-lg rounded-pill px-5">¡Comencemos tu
                                                Proyecto!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Botón de contacto centralizado -->
                    <div class="row mt-4">
                        <div class="col-12 text-center">
                            <a href="javascript:void(0);" onclick="openContactModal()"
                                class="btn btn-primary btn-lg rounded-pill px-5">¡Comencemos tu Proyecto!</a>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
        <!-- Sweet Alerts js -->
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

        <script>
            // Funciones globales para los modales
            function openContactModal() {
                fetch('{{ route('contact.create') }}', {
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
                                submitContactForm();
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function submitContactForm() {
                const form = document.getElementById('contactForm');
                const formData = new FormData(form);

                // Mostrar que se está procesando
                Swal.fire({
                    title: 'Enviando...',
                    text: 'Por favor espere',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Resetear estados de error previos
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                form.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');

                fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cerrar el modal
                            bootstrap.Modal.getInstance(document.getElementById('contactModal')).hide();

                            // Mostrar mensaje de éxito
                            Swal.fire({
                                title: '¡Éxito!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });

                            // Limpiar el formulario
                            form.reset();
                        } else {
                            // Mostrar errores en el formulario
                            Swal.close();
                            Object.keys(data.errors).forEach(field => {
                                const input = form.querySelector(`[name="${field}"]`);
                                const feedback = input.nextElementSibling;
                                input.classList.add('is-invalid');
                                if (feedback) {
                                    feedback.textContent = data.errors[field][0];
                                }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al enviar el formulario',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });
            }
        </script>
</body>

</html>
