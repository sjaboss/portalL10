@extends('layouts.app')

@section('content')
    <style>
        #usuariosTable th,
        #usuariosTable td {
            font-size: 18px;
            /* Ajusta este valor al tamaño deseado */
            text
        }
    </style>

@php
$color = 'primary';
$color2 = 'danger';
@endphp

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Mantenimiento de Secciones</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Secciones</a></li>
                        <li class="breadcrumb-item active">Mantenimiento</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Listado de Secciones</h5>
                </div>
                <div class="card-body">

                    <a href="{{ route('secciones.create') }}" class="btn btn-primary waves-effect waves-light">Nuevo Registro</a>

                    <br>
                    <br>
                    <table id="SecionesTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Sección</th>
                                <th class="text-center">Orden</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($secciones as $seccion)
                                <tr>
                                    <td class="text-center">{{ $seccion->id }}</td>
                                    <td class="text-center">{{ $seccion->seccion }}</td>
                                    <td class="text-center">{{ $seccion->orden }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="color-preview me-2"
                                                 style="width: 20px; height: 20px; border-radius: 50%; background-color: {{ $seccion->color ?? '#000000' }}; border: 1px solid #ddd;">
                                            </div>
                                            {{ $seccion->color ?? '#000000' }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('secciones.edit', $seccion->id) }}" class="btn btn-{{ $color }} btn-sm rounded-pill shadow-sm">Editar</a>
                                        <button type="button" class="btn btn-{{ $color2 }} btn-sm rounded-pill shadow-sm"
                                            onclick="confirmarEliminacion({{ $seccion->id }})">Eliminar</button>
                                        <form id="delete-form-{{ $seccion->id }}"
                                            action="{{ route('secciones.destroy', $seccion->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#SecionesTable').DataTable({
                "destroy": true, // Destruir instancia existente, si la hay
                "order": [[2, "asc"]], // Ordenar por la primera columna (ID) de forma descendente
                "columnDefs": [
                    { "targets": 0, "visible": false } // Ocultar la columna de ID
                ]
            });
        });
    </script>
    <script>
        function confirmarEliminacion(secionesId) {
            Swal.fire({
                title: "¿Estás Seguro?",
                text: "No podrás revertir esta acción!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + secionesId).submit();
                }
            });
        }
    </script>
@endpush
