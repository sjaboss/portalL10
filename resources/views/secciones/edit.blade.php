@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Nueva Sección</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Sección</a></li>
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
                <h4 class="card-title mb-0 flex-grow-1">Nueva Sección</h4>
            </div>
            <div class="card-body">
                <form class="row gy-1" method="POST" action="{{ route('secciones.update',$seccion->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="seccion" class="form-label">{{ __('Sección') }}</label>
                            <input type="text" class="form-control @error('seccion') is-invalid @enderror" id="seccion" name="seccion" value="{{ old('seccion',$seccion->seccion) }}" required autofocus>
                            @error('seccion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xxl-1 col-md-6">
                        <div>
                            <label for="orden" class="form-label">{{ __('orden') }}</label>
                            <input type="number" class="form-control @error('orden') is-invalid @enderror"
                                id="orden" name="orden" value="{{ old('orden',$seccion->orden) }}" required>
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
                                id="color" name="color" value="{{ old('color', $seccion->color ?? '#000000') }}">
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
                                <img id="preview" src="{{ $seccion->icon_medium ? asset('storage/icons/' . basename($seccion->icon_medium)) : '#' }}" 
                                     alt="Vista previa" class="img-thumbnail" style="max-width: 100px; {{ $seccion->icon_medium ? '' : 'display: none;' }}">
                                <div id="icon-preview" style="display: {{ $seccion->font_awesome_icon ? 'block' : 'none' }};">
                                    @if($seccion->font_awesome_icon)
                                    <i class="fas fa-{{ $seccion->font_awesome_icon }} fa-3x"></i>
                                    @endif
                                </div>
                                <input type="hidden" id="font_awesome_icon" name="font_awesome_icon" value="{{ $seccion->font_awesome_icon }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 col-md-6">
                        <div>
                            <br>
                            <a href="{{ route('secciones.index') }}" class="btn btn-danger">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                {{ __('Editar Registro') }}
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
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
                    <input type="text" class="form-control" id="iconSearch" placeholder="Buscar iconos...">
                </div>
                <div class="row row-cols-2 row-cols-md-4 row-cols-lg-6 g-3" id="iconGrid">
                    <!-- Los iconos se cargarán aquí dinámicamente -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast para notificar la selección de icono -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="iconToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Icono Seleccionado</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Se ha seleccionado el icono: <span id="selectedIconName"></span>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.querySelector('#icon');
        const photoPreview = document.querySelector('#preview');
        const iconPreview = document.querySelector('#icon-preview');
        const faInput = document.getElementById('font_awesome_icon');
        
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    photoPreview.src = reader.result;
                    photoPreview.style.display = 'block';
                    iconPreview.style.display = 'none';
                    iconPreview.innerHTML = '';
                    faInput.value = '';
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
        const faInput = document.getElementById('font_awesome_icon');
        faInput.value = iconName;
        
        // Limpiar y ocultar la vista previa de imagen
        const photoPreview = document.querySelector('#preview');
        photoPreview.src = '#';
        photoPreview.style.display = 'none';
        
        // Actualizar la vista previa del icono
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
</script>
@endpush
