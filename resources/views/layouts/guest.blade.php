<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Sjaboss Systems - Especialistas en Asesorías y Desarrollo Web</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Desarrollo de páginas web profesionales y sistemas a medida. Expertos en Laravel, PHP, WordPress y aplicaciones web empresariales. Soluciones digitales que impulsan tu negocio.">
    <meta name="keywords" content="desarrollo web, sistemas a medida, aplicaciones web, desarrollo laravel, desarrollo php, diseño web profesional, tiendas online, páginas web corporativas, sistemas empresariales, desarrollo de software, aplicaciones móviles, consultoría IT">
    <meta name="author" content="Sjaboss Systems">
    <meta name="robots" content="index, follow">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Sjaboss Systems | Desarrollo Web Profesional y Sistemas Empresariales">
    <meta property="og:description" content="Creamos sitios web y sistemas que transforman tu negocio. Desarrollo profesional, diseño moderno y soluciones tecnológicas a medida.">
    <meta property="og:image" content="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    <meta property="og:site_name" content="Sjaboss Systems">
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Sjaboss Systems - Especialistas en Asesorías y Desarrollo Web">
    <meta name="twitter:description" content="Servicios profesionales de asesoría y desarrollo web. Agenda con especialistas.">
    <meta name="twitter:image" content="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    
    <!-- LinkedIn -->
    <meta property="linkedin:card" content="summary_large_image">
    <meta property="linkedin:title" content="Sjaboss Systems - Especialistas en Asesorías y Desarrollo Web">
    <meta property="linkedin:description" content="Servicios profesionales de asesoría y desarrollo web. Agenda con especialistas.">
    <meta property="linkedin:image" content="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    
    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ProfessionalService",
        "name": "Sjaboss Systems",
        "description": "Desarrollo profesional de páginas web y sistemas empresariales",
        "url": "{{ url()->current() }}",
        "logo": "{{ asset('assets/images/sjaboss/logosjaboss.png') }}",
        "priceRange": "$$",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "Argentina"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "sales",
            "email": "info@sjaboss.com",
            "availableLanguage": ["Spanish"]
        },
        "sameAs": [
            "https://www.facebook.com/sjaboss",
            "https://www.linkedin.com/company/sjaboss",
            "https://twitter.com/sjaboss"
        ],
        "offers": {
            "@type": "AggregateOffer",
            "offerCount": "3",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "name": "Desarrollo Web",
                    "description": "Sitios web profesionales y modernos"
                },
                {
                    "@type": "Offer",
                    "name": "Sistemas Empresariales",
                    "description": "Software a medida para empresas"
                },
                {
                    "@type": "Offer",
                    "name": "Consultoría IT",
                    "description": "Asesoramiento tecnológico profesional"
                }
            ]
        }
    }
    </script>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/sjaboss/logosjaboss.png') }}">
    
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
<!-- Toastify css -->
<link href="{{ asset('assets/libs/toastify-js/src/toastify.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .auth-one-bg {
            background-image: url('/assets/images/sjaboss/15.jpg') !important;
            background-position: center;
            background-size: cover;
            filter: brightness(1.2) contrast(1.1);
        }

        .bg-overlay {
            background: linear-gradient(to right, rgba(0,0,0,0.3), rgba(0,0,0,0.2)) !important;
        }
    </style>
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="50">

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        @yield('content')
        <!-- end auth page content -->

        <!-- footer -->

        @include('layouts.footer')
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                   {{--          <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Sjaboss. Sistemas <i class="mdi mdi-heart text-danger"></i>
                            </p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <!-- Toastify js -->
    <script src="{{ asset('assets/libs/toastify-js/src/toastify.js') }}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>

        <!-- particles js -->
        <script src="{{ asset('assets/libs/particles.js/particles.js') }}"></script>
        <!-- particles app js -->
        <script src="{{ asset('assets/js/pages/particles.app.js') }}"></script>
    @stack('scripts')
</body>
</html>
