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
                <h4 class="mb-sm-0">Mantenimiento de Videos</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">videos</a></li>
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
                    <h5 class="card-title mb-0">Listado de videos</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('videos.create') }}" class="btn btn-primary waves-effect waves-light">Nuevo
                        Registro</a>
                    <br>
                    <br>
                    <table id="VideosTable" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100% size: 100% ">
                        <thead>
                            <tr>
                                <th class="d-none">ID</th> <!-- Columna ID oculta -->
                                <th>Fecha</th>
                                <th>Titulo</th>
                                <th>pie</th>
                                <th>Orden</th>
                                <th>src</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr>
                                    <td class="d-none">{{ $video->id }}</td> <!-- Campo ID -->
                                    <td>{{ $video->fecha }}</td>
                                    <td>{{ $video->titulo }}</td>
                                    <td>{{ $video->pie }}</td>
                                    <td class="text-center">{{ $video->orden }}</td>
                                    <td class="text-center">
                                        <iframe width="230" height="115" src="{{ $video->src }}" title="YouTube video player"
                                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </td>
                                    <td class="text-center">
                                        <a  href="{{ route('videos.edit', $video->id) }}" 
                                            class="btn btn-{{ $color }} btn-sm rounded-pill shadow-sm">Editar</a>
                                        <button type="button" class="btn btn-{{ $color2 }} btn-sm rounded-pill shadow-sm"
                                            onclick="confirmarEliminacion({{ $video->id }})">Eliminar</button>
                                        <form id="delete-form-{{ $video->id }}"
                                            action="{{ route('videos.destroy', $video->id) }}" method="POST"
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
            $('#VideosTable').DataTable();
        })
    </script>

    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 2000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
            }).showToast();
        </script>
    @endif

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
   <script>
    $(document).ready(function() {
        $('#VideosTable').DataTable({
            "destroy": true, // Destruir instancia existente, si la hay
            "order": [[4, "asc"]], // Ordenar por la primera columna (ID) de forma descendente
            "columnDefs": [
                { "targets": 0, "visible": false } // Ocultar la columna de ID
            ]
        });
    });
</script>
@endpush
