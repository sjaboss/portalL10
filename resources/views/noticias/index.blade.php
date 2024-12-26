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
                <h4 class="mb-sm-0">Mantenimiento de Noticias</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Noticias</a></li>
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
                    <h5 class="card-title mb-0">Listado de Noticias</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('noticias.create') }}" class="btn btn-primary waves-effect waves-light">Nuevo
                        Registro</a>
                    <br>
                    <br>
                    <table id="NoticiasTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100% size: 100% ">
                        <thead>
                            <tr>
                                <th class="d-none">ID</th> <!-- Columna ID oculta -->
                                <th>Fecha</th>
                                <th>Foto</th>
                                <th>Secciones</th>
                                <th>Titulo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($noticias as $noticia)
                                <tr>
                                    <td class="d-none">{{ $noticia->id }}</td> <!-- Campo ID -->
                                    <td>{{ $noticia->fecha }}</td>
                                    <td class="text-center">
                                        <img class="rounded-circle avatar-xl" src="{{ asset('storage').'/'.$noticia->foto }}">
                                    </td>
                                    <td>{{ $noticia->seccion->seccion }}</td>
                                    <td>{{ $noticia->titulo }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('noticias.edit', $noticia->id) }}"
                                            class="btn btn-{{ $color }} btn-sm rounded-pill shadow-sm">Editar</a>
                                        <button type="button" class="btn btn-{{ $color2 }} btn-sm rounded-pill shadow-sm"
                                            onclick="confirmarEliminacion({{ $noticia->id }})">Eliminar</button>
                                        <button type="button" class="btn btn-info btn-sm rounded-pill shadow-sm"
                                            data-noticia-id="{{ $noticia->id }}">Ver</button>
                                        <form id="delete-form-{{ $noticia->id }}"
                                            action="{{ route('noticias.destroy', $noticia->id) }}" method="POST"
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
</div>

<!-- Modal para mostrar la noticia -->
<div class="modal fade" id="noticiaModal" tabindex="-1" aria-labelledby="noticiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- El contenido del modal se cargará dinámicamente -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/noticias-modal.js'])
    <script>
        $(document).ready(function() {
            $('#NoticiasTable').DataTable({
                "destroy": true,
                "order": [[1, "desc"]],
                "columnDefs": [
                    { "targets": 0, "visible": false }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
                }
            });
        });

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
