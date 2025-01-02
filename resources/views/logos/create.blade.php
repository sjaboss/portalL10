@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Nueva Logo</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Logos</a></li>
                    <li class="breadcrumb-item active">Nuevo Logo</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Nuevo Logo</h4>
            </div>
            <div class="card-body">
                <form class="row gy-1" method="POST" action="{{ route('logos.store') }}" enctype="multipart/form-data" id="logoForm">
                    @csrf
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="foto" class="form-label">{{ __('Foto') }}</label>
                            <div class="dropzone-container position-relative">
                                <input type="file" id="foto" name="foto" class="form-control pe-5 @error('foto') is-invalid @enderror" accept="image/*">
                                <input type="hidden" name="image_urls" id="image_urls">

                                <div class="image-preview-container mt-3">
                                    <img id="preview" class="img-thumbnail mt-2" src="" alt="" style="max-width: 300px; display: none;">

                                    <!-- Contenedor de miniaturas -->
                                    <div class="thumbnails-container mt-2" style="display: none;">
                                        <div class="d-flex gap-2">
                                            <div class="thumbnail-preview">
                                                <small class="d-block text-muted">Miniatura</small>
                                                <img id="preview-thumb" class="img-thumbnail" style="max-width: 150px;">
                                            </div>
                                            <div class="thumbnail-preview">
                                                <small class="d-block text-muted">Mediana</small>
                                                <img id="preview-medium" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Barra de progreso -->
                                    <div class="progress mt-2" style="display: none;">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xxl-12 col-md-6">
                        <div>
                            <br>
                            <div class="row mb-0">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" id="submitButton">
                                        {{ __('Crear Logo') }}
                                    </button>
                                    <a href="{{ route('logos.index') }}" class="btn btn-secondary">
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitButton = document.getElementById('submitButton');
        let isSubmitting = false;

        form.addEventListener('submit', function(e) {
            if (isSubmitting) {
                e.preventDefault();
                return;
            }

            isSubmitting = true;
            submitButton.disabled = true;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creando...';
        });

        // Vista previa de la imagen
        const photoInput = document.querySelector('#foto');
        const photoPreview = document.querySelector('#preview');

        photoInput.addEventListener('change', function(e) {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    photoPreview.src = e.target.result;
                    photoPreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>

<style>
.dropzone-container {
    border: 2px dashed #ddd;
    padding: 20px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.dropzone-container:hover {
    border-color: #0d6efd;
}
</style>
@endpush
