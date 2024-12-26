<footer class="custom-footer py-5 position-relative w-100">
    <style>
        #particles-js {
            position: absolute;
            width: 100vw;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
            pointer-events: none;
            background-color: #1a1a1a; /* Fondo oscuro sólido */
        }
        .footer-content {
            position: relative;
            z-index: 2;
            background: transparent; /* Aseguramos que el contenido sea transparente */
            width: 100%;
        }
        .custom-footer {
            min-height: 300px;
            overflow: hidden;
            background: transparent !important; /* Forzamos transparencia */
            position: relative;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 100%;
            width: 100%;
            margin: 0 auto;
        }
    </style>
    <div id="particles-js"></div>
    <div class="footer-content">
        <div class="container">
            <div class="row">

                @php
                    use App\Models\Red;
                    use App\Models\Logo;
                    $redes = Red::all(); // o cualquier otra forma de obtener los datos
                    $logos = Logo::all();
                @endphp



                <div class="col-lg-4 mt-4">
                    <div>
                        @foreach ($logos as $logo)
                            <div>
                                <img src="{{ asset('storage') . '/' . $logo->foto }}" alt="logo light" height="90">
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="row text-center text-sm-start align-items-center mt-5">
                <div class="col-sm-6">

                    <div>
                        <p class="copy-rights mb-0">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Sjaboss - Sistema de Sistemas
                        </p>
                    </div>


                </div>



                <div class="col-sm-6">
                    <div class="text-sm-end mt-3 mt-sm-0">
                        <ul class="list-inline mb-0 footer-social-link">
                            @foreach ($redes->sortBy('orden')->chunk(10) as $grupoVideos)
                                @foreach ($grupoVideos as $red)
                                    <li class="list-inline-item">
                                        <a href="{{ $red->pie }}"target="_blank" class="avatar-xs d-block">
                                            <div class="avatar-title rounded-circle">
                                                @if ($red->foto)
                                                    <i class="ri-image"
                                                        style="background-image: url('{{ asset('storage') . '/' . $red->foto }}'); width: 30px; height: 30px; background-size: cover;"></i>
                                                @else
                                                    <i class="ri-github-fill"></i>
                                                @endif
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endforeach{{-- grupoRedes --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
