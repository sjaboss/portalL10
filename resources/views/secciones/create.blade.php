@extends('layouts.app')

@section('content')
<!-- Toast para notificación de icono seleccionado -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="iconToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Icono Seleccionado</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Has seleccionado el icono: <strong id="selectedIconName"></strong>
        </div>
    </div>
</div>

<!-- Modal de selección de iconos -->
<div class="modal fade" id="iconModal" tabindex="-1" aria-labelledby="iconModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="iconModalLabel">Seleccionar Icono</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" id="iconSearch"
                               placeholder="Buscar iconos... (ejemplo: home, user, etc)">
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="iconGrid">
                    <!-- Los iconos se cargarán aquí dinámicamente -->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Crear Sección') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('secciones.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="seccion" class="form-label">{{ __('Sección') }}</label>
                                    <input type="text" class="form-control @error('seccion') is-invalid @enderror"
                                        id="seccion" name="seccion" value="{{ old('seccion') }}" required>
                                    @error('seccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="orden" class="form-label">{{ __('Orden') }}</label>
                                    <input type="number" class="form-control @error('orden') is-invalid @enderror"
                                        id="orden" name="orden" value="{{ old('orden') }}" required>
                                    @error('orden')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="color" class="form-label">{{ __('Color') }}</label>
                                    <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror"
                                        id="color" name="color" value="{{ old('color', '#000000') }}">
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-6">
                                <div>
                                    <label for="icon" class="form-label">{{ __('Icono') }}</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control @error('icon') is-invalid @enderror"
                                            id="icon" name="icon" accept="image/*" onchange="previewImage(this)">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#iconModal">
                                            <i class="fas fa-icons"></i> Elegir de Font Awesome
                                        </button>
                                    </div>
                                    @error('icon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="preview" src="#" alt="Vista previa" 
                                             class="img-thumbnail" style="max-width: 100px; display: none;">
                                        <div id="icon-preview" style="display: none;"></div>
                                    </div>
                                    <!-- Campo oculto para el icono de Font Awesome -->
                                    <input type="hidden" id="font_awesome_icon" name="font_awesome_icon" value="">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" id="submitButton">
                                    {{ __('Crear Sección') }}
                                </button>
                                <a href="{{ route('secciones.index') }}" class="btn btn-secondary">
                                    {{ __('Cancelar') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Mostrar imagen seleccionada
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.querySelector('#icon');
        const photoPreview = document.querySelector('#preview');
        const iconPreview = document.querySelector('#icon-preview');
        
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    photoPreview.src = reader.result;
                    photoPreview.style.display = 'block';
                    iconPreview.style.display = 'none';
                    // Limpiar el campo de Font Awesome
                    document.getElementById('font_awesome_icon').value = '';
                });
                reader.readAsDataURL(file);
            }
        });
    });

    const commonIcons = [
        'home', 'user', 'envelope', 'phone', 'calendar', 'image', 'video',
        'music', 'book', 'map', 'camera', 'shopping-cart', 'heart', 'star',
        'file', 'folder', 'cog', 'wrench', 'chart-bar', 'database', 'cloud',
        'link', 'globe', 'desktop', 'mobile', 'tablet', 'laptop', 'server',
        'users', 'comments', 'bell', 'flag', 'bookmark', 'print', 'search',
        'lock', 'key', 'shield', 'check', 'times', 'plus', 'minus', 'edit',
        'trash', 'download', 'upload', 'sync', 'clock', 'calendar-alt'
    ];

    function loadIcons(searchTerm = '') {
        const grid = document.getElementById('iconGrid');
        grid.innerHTML = '';

        const filteredIcons = searchTerm
            ? commonIcons.filter(icon => icon.toLowerCase().includes(searchTerm.toLowerCase()))
            : commonIcons;

        filteredIcons.forEach(icon => {
            const div = document.createElement('div');
            div.className = 'col text-center';
            div.innerHTML = `
                <div class="p-3 border rounded icon-item" style="cursor: pointer;" onclick="selectIcon('${icon}')">
                    <i class="fas fa-${icon} fa-2x"></i>
                    <div class="small mt-2">${icon}</div>
                </div>
            `;
            grid.appendChild(div);
        });

        if (filteredIcons.length === 0) {
            grid.innerHTML = '<div class="col-12 text-center py-4">No se encontraron iconos que coincidan con la búsqueda</div>';
        }
    }

    function selectIcon(iconName) {
        console.log('Selecting icon:', iconName); // Debug log
        
        // Actualizar el campo oculto
        const faInput = document.getElementById('font_awesome_icon');
        faInput.value = iconName;
        console.log('Updated font_awesome_icon value:', faInput.value); // Debug log
        
        // Limpiar la vista previa de imagen
        const photoPreview = document.querySelector('#preview');
        photoPreview.src = '#';
        photoPreview.style.display = 'none';
        
        // Mostrar el icono seleccionado
        const iconPreview = document.querySelector('#icon-preview');
        iconPreview.innerHTML = `<i class="fas fa-${iconName} fa-3x"></i>`;
        iconPreview.style.display = 'block';

        // Limpiar el campo de archivo
        const fileInput = document.getElementById('icon');
        fileInput.value = '';

        // Cerrar el modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('iconModal'));
        modal.hide();

        // Mostrar mensaje de éxito
        const toast = new bootstrap.Toast(document.getElementById('iconToast'));
        document.getElementById('selectedIconName').textContent = iconName;
        toast.show();

        // Debug: Mostrar todos los campos del formulario
        const formData = new FormData(document.querySelector('form'));
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }
    }

    // Manejar la búsqueda en tiempo real
    document.getElementById('iconSearch').addEventListener('input', function(e) {
        loadIcons(e.target.value);
    });

    // Cargar iconos cuando se abre el modal
    document.getElementById('iconModal').addEventListener('shown.bs.modal', function() {
        loadIcons();
        document.getElementById('iconSearch').focus();
    });

    // Limpiar búsqueda cuando se cierra el modal
    document.getElementById('iconModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('iconSearch').value = '';
    });

    // Prevenir múltiples envíos del formulario
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
    });
</script>
@endpush
