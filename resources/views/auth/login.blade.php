@extends('layouts.guest')

@section('content')
    @php
        use App\Models\Logo;
        $logos = Logo::all();
    @endphp

    <div class="auth-page-content">
        <div class="container">

            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <p class="mt-3 fs-15 fw-medium">Sistema de Noticias</p>
                                <div class="pb-2">
                                    <a href="{{ route('home') }}" class="d-inline-block auth-logo">
                                        @foreach ($logos as $logo)
                                            <div>
                                                <img src="{{ asset('storage') . '/' . $logo->foto }}" alt="logo light" height="90">
                                            </div>
                                        @endforeach
                                    </a>


                                </div>
                                <h5 class="text-primary">Bienvenido !</h5>
                                <p class="text-muted">Inicie Sesion para continuar .</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                        <input type="email" id="email" name="email"
                                            placeholder="Ingrese Correo Electrónico" value="{{ old('email') }}"
                                            class="form-control pe-5 @error('email') is-invalid @enderror" required
                                            autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">{{ __('Contraseña') }}</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" id="password" name="password"
                                                placeholder="Ingrese Contraseña"
                                                class="form-control pe-5 @error('email') is-invalid @enderror" required>
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                type="button" id="tooglePassword"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100"
                                            type="submit">{{ __('Iniciar Sesión') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">No, tienes una cuenta? <a href="{{ route('register') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Registrate </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tooglePasswordButton = document.querySelector('#tooglePassword');
                const passwordInput = document.querySelector('#password');

                tooglePasswordButton.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                });
            });
        </script>
    @endpush
@endsection