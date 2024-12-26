@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Nueva Noticia</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Noticia</a></li>
                    <li class="breadcrumb-item active">Nuevo Registro</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Nueva Noticia</h4>
            </div>
            <div class="card-body">
                <form class="row gy-1" method="POST" action="{{ route('noticias.update',$noticias->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="fecha" class="form-label">{{ __('Fecha de la Noticia') }}</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha" value="{{ old('fecha',$noticias->fecha) }}"required autofocus>
                            @error('fecha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="seccion_id" class="form-label">{{ __('Seccion') }}</label>
                            <select class="form-select @error('seccion_id') is-invalid @enderror" id="seccion_id" name="seccion_id" required>
                                <option value=""selected disabled>Selecione una sección</option>
                                @foreach ($secciones as $seccion )
                                <option value="{{ $seccion->id }}" {{ $noticias->seccion_id == $seccion->id ? 'selected' : '' }}>{{ $seccion->seccion }}</option> -
                                @endforeach
                            </select>
                            @error('seccion_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="titulo" class="form-label">{{ __('Titulo') }}</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('fecha',$noticias->titulo) }}" required >
                            @error('titulo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-12 col-md-6">
                        <div>
                            <label for="bajada" class="form-label">{{ __('Bajada') }}</label>
                            <textarea cols="30" rows="2" type="text" class="form-control @error('bajada') is-invalid @enderror" id="bajada" name="bajada" required>{{ old('bajada', $noticias->bajada) }}</textarea>
                            @error('bajada')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-12 col-md-6">
                        <div>
                            <label for="nota" class="form-label">{{ __('Nota') }}</label>
                            <textarea cols="30" rows="15" type="text" class="form-control @error('nota') is-invalid @enderror" id="nota" name="nota" required>{{ old('nota', $noticias->nota) }}</textarea>

                            @error('nota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="foto" class="form-label">{{ __('Foto (Opcional)') }}</label>
                            <input type="file" id="foto"
                            accept="image/*"
                            name="foto" class="form-control pe-5 @error('foto') is-invalid @enderror">
                            <img id="preview" class="img-thumbnail mt-2" src="{{ asset('storage').'/'.$noticias->foto }}">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="autor" class="form-label">{{ __('Autor') }}</label>
                            <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" name="autor" value="{{ old('autor',$noticias->autor) }}" required>
                            @error('autor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xxl-12 col-md-6 text-start">
                        <div>
                            <br>
                            <a href="{{ route('noticias.index') }}" class="btn btn-danger">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar Registro') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
