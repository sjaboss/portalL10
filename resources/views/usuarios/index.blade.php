@extends('layouts.app')

@section('content')

<style>
    #usuariosTable th, #usuariosTable td {
        font-size: 18px; /* Ajusta este valor al tamaño deseado */
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
            <h4 class="mb-sm-0">Mantenimiento de Usuarios</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Usuarios</a></li>
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
                <h5 class="card-title mb-0">Listado de Usuarios</h5>
            </div>
            <div class="card-body">
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary waves-effect waves-light">Nuevo Registro</a>
                <br>
                <br>
                <table id="usuariosTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100% size: 100% ">
                    <thead>
                        <tr>
                            <th>foto</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo Electronico</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr class>
                            <td class="text-center">
                            <img class="rounded-circle avatar-lg" src="{{ asset('storage').'/'.$usuario->foto }}">
                            </td>
                            <td>{{ $usuario->nombres }}</td>
                            <td>{{ $usuario->apellidos }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->role->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuarios.edit',$usuario->id) }}" class="btn btn-{{ $color }} btn-sm rounded-pill shadow-sm">Editar</a>
                                <button type="button" class="btn btn-{{ $color2 }} btn-sm rounded-pill shadow-sm" onclick="confirmarEliminacion({{ $usuario->id }})">Eliminar</button>
                                <form id="delete-form-{{ $usuario->id }}" action="{{ route('usuarios.destroy',$usuario->id) }}" method="POST" style="display: none;">
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
    $(document).ready(function(){
        $('#usuariosTable').DataTable();
    })
</script>

@if(session('success'))
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
    function confirmarEliminacion(usuarioId){
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
document.getElementById('delete-form-' + usuarioId).submit();
                }
        });
    }
</script>
@endpush
