@inject('storage', 'Illuminate\Support\Facades\Storage')
@extends('layouts.guest')

@section('content')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .card:hover img {
            opacity: 0.9;
        }
        .hover-primary:hover {
            color: var(--bs-success) !important;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .transition-all {
            transition: all 0.3s ease;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7));
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("{{ asset('assets/images/sjaboss/logosjaboss.png') }}") center/cover no-repeat;
            opacity: 0.15;
            z-index: -1;
        }

        /* Estilos para cards clickeables */
        .card-clickable {
            cursor: pointer;
        }
        .card-clickable:hover .btn-outline-primary {
            background-color: var(--bs-primary);
            color: white;
        }
        .card-clickable .card-title {
            color: var(--bs-primary);
        }
    </style>

    <div class="layout-wrapper landing">
        @include('layouts.menufrente')
    </div>

    <main class="main-content" data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="0" tabindex="0">
        <div class="container">
            <div class="demo-carousel mt-5 pt-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-12 col-xxl-10">
                        <div class="text-center p-4 p-lg-5 rounded hero-section">
                            <h1 class="display-6 display-lg-5 fw-bold mb-4 lh-base text-white text-shadow fs-3 fs-lg-2">La mejor manera de
                                gestionar tus asesorías con <span class="text-success fw-bolder">nuestros especialistas</span></h1>
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-10 col-xl-8">
                                    <p class="lead text-white-75 lh-base fw-medium fs-6 fs-lg-5">Ofrecemos plataformas totalmente
                                        responsivas, donde podrás agendar reuniones con especialistas en diferentes áreas a un costo accesible
                                        por hora.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sección Te Proponemos --}}
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center align-items-center min-vh-75">
                    <div class="col-lg-10 col-xl-8 text-center">
                        <h2 class="display-5 fw-bold mb-4 text-primary">Te proponemos...</h2>
                        <p class="lead mb-4">Transformar tu visión en una presencia digital extraordinaria. Creamos sitios web que no solo se ven increíbles, sino que también <span class="text-primary">impulsan tu negocio</span> hacia el éxito.</p>

                        <div class="row g-4 mt-3">
                            @if ($noticias->count() > 0)
                                @foreach ($noticias->take(3) as $noticia)
                                    <article class="col-md-6 col-lg-4">
                                        <div onclick="openNoticiaModal({{ $noticia->id }})" class="card h-100 shadow-sm border transition-all card-clickable">
                                            <div class="card-img-wrapper position-relative" style="padding-top: 56.25%;">
                                                @php
                                                    $imagePath = $noticia->foto ? url('storage/' . $noticia->foto) : asset('assets/images/placeholder.svg');
                                                    // Verificar si el archivo existe
                                                    if ($noticia->foto && !Storage::disk('public')->exists($noticia->foto)) {
                                                        $imagePath = asset('assets/images/placeholder.svg');
                                                    }
                                                @endphp
                                                <img class="card-img-top position-absolute top-0 start-0 w-100 h-100"
                                                     src="{{ $imagePath }}"
                                                     alt="{{ $noticia->titulo }}"
                                                     loading="lazy"
                                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/placeholder.svg') }}'"
                                                     style="object-fit: cover;">
                                            </div>
                                            <div class="card-body" style="background-color: rgba(25, 135, 84, 0.03);">
                                                <h5 class="card-title">
                                                    <span class="text-decoration-none text-dark hover-primary" style="transition: color 0.3s ease;">
                                                        {{ $noticia->titulo }}
                                                    </span>
                                                </h5>
                                                <p class="card-text">
                                                    {!! nl2br(strip_tags($noticia->bajada)) !!}
                                                </p>
                                            </div>
                                            <div class="card-footer text-end" style="background-color: rgba(25, 135, 84, 0.05);">
                                                <span class="btn btn-outline-success btn-sm rounded-pill hover-scale" style="transition: transform 0.3s ease, background-color 0.3s ease;">
                                                    Ver más <i class="mdi mdi-arrow-right ms-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5>No hay noticias cargadas</h5>
                                        <p>Lo sentimos, no hay noticias disponibles en este momento.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-5">
                            <a href="javascript:void(0);" onclick="openContactModal()" class="btn btn-primary btn-lg rounded-pill px-5">¡Comencemos tu Proyecto!</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal de Noticia -->
    <div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticiaModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="noticiaModalContent">
                    <!-- El contenido de la noticia se cargará aquí -->
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
@endsection

@push('scripts')
    <!--Swiper slider js-->
    <script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}" defer></script>
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

        function openNoticiaModal(noticiaId) {
            fetch(`/noticias/${noticiaId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('noticiaModalContent').innerHTML = html;
                const modal = new bootstrap.Modal(document.getElementById('noticiaModal'));
                modal.show();
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
                    Swal.fire({
                        title: '¡Éxito!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('contactModal'));
                        if (modal) {
                            modal.hide();
                        }
                        form.reset();
                    });
                } else {
                    throw new Error(data.message || 'Error al enviar el mensaje');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: error.message || 'Hubo un problema al enviar el mensaje. Por favor, intente nuevamente.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            });
        }

        // Código que se ejecuta cuando la página se carga
        window.addEventListener('load', function() {
            // Inicializar ScrollSpy
            if (typeof bootstrap !== 'undefined') {
                const scrollSpyElement = document.querySelector('[data-bs-spy="scroll"]');
                if (scrollSpyElement) {
                    try {
                        const scrollSpy = new bootstrap.ScrollSpy(document.body, {
                            target: '#navbar',
                            offset: 50
                        });
                    } catch (error) {
                        console.log('ScrollSpy initialization error:', error);
                    }
                }
            }

            // Lazy loading de imágenes de fondo
            var lazyBackgrounds = [].slice.call(document.querySelectorAll("[data-bg]"));
            if ("IntersectionObserver" in window) {
                let lazyBackgroundObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.style.backgroundImage = `url(${entry.target.dataset.bg})`;
                            entry.target.classList.add('loaded');
                            entry.target.removeAttribute('data-bg');
                            lazyBackgroundObserver.unobserve(entry.target);
                        }
                    });
                });

                lazyBackgrounds.forEach(function(lazyBackground) {
                    lazyBackgroundObserver.observe(lazyBackground);
                });
            }

            // Precarga de imágenes
            const images = document.querySelectorAll('img[loading="lazy"]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const preloadImage = new Image();
                        preloadImage.src = img.src;
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px'
            });

            images.forEach(img => imageObserver.observe(img));
        });
    </script>
@endpush
