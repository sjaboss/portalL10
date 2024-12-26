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

                                <a href="{{ route('home') }}" class="d-inline-block auth-logo">
                                    @foreach ($logos as $logo)
                                        <div>
                                            <img src="{{ asset('storage') . '/' . $logo->foto }}" alt="logo light"
                                                height="90">
                                        </div>
                                    @endforeach
                                </a>

                                <h5 class="text-primary">Crear Nueva Cuenta !</h5>
                                <p class="text-muted">Registrese para continuar.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" method="POST" action="{{ route('register') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nombres" class="form-label">{{ __('Nombres') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="nombres" name="nombres" placeholder="Ingrese Nombres"
                                            value="{{ old('nombres') }}"
                                            class="form-control pe-5 @error('nombres') is-invalid @enderror" required
                                            autofocus>
                                        @error('nombres')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="apellidos" class="form-label">{{ __('Apellidos') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="apellidos" name="apellidos"
                                            placeholder="Ingrese Apellidos" value="{{ old('apellidos') }}"
                                            class="form-control pe-5 @error('apellidos') is-invalid @enderror" required>
                                        @error('apellidos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">{{ __('Teléfono') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="telefono" name="telefono" placeholder="Ingrese Teléfono"
                                            value="{{ old('telefono') }}"
                                            class="form-control pe-5 @error('telefono') is-invalid @enderror" required>
                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Correo Electrónico') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="email" id="email" name="email"
                                            placeholder="Ingrese Correo Electrónico" value="{{ old('email') }}"
                                            class="form-control pe-5 @error('email') is-invalid @enderror" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto" class="form-label">{{ __('Foto (Opcional)') }}</label>
                                        <input type="file" id="foto" name="foto"
                                            class="form-control pe-5 @error('foto') is-invalid @enderror">
                                        <img id="preview" class="img-thumbnail mt-2" src="" alt="">

                                        @error('foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password">{{ __('Contraseña') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="password" id="password" name="password"
                                            placeholder="Ingrese Contraseña"
                                            class="form-control pe-5 @error('email') is-invalid @enderror" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">{{ __('Confirmar Contraseña') }}
                                            <span class="text-danger">*</span></label>
                                        <input type="password" id="password-confirm" name="password_confirmation"
                                            placeholder="Confirmar Contraseña" class="form-control" required>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100"
                                            type="submit">{{ __('Registrate') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="mb-0">Ya tienes una cuenta? <a href="{{ route('login') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Iniciar Sesion </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

    @push('scripts')
        <script>
            // mostrar imagen seleccionada
            document.addEventListener('DOMContentLoaded', function() {
                const photoInput = document.querySelector('#foto');
                const photoPreview = document.querySelector('#preview');
                photoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.addEventListener('load', function() {
                            photoPreview.src = reader.result;
                        })
                        reader.readAsDataURL(file);
                    }
                })
            })
        </script>
    @endpush
@endsection
