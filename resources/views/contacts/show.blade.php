@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Mensaje de Contacto</span>
                        <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-secondary">Volver</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>Fecha:</strong>
                        <p>{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p>{{ $contact->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p>{{ $contact->email }}</p>
                    </div>

                    @if($contact->phone)
                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        <p>{{ $contact->phone }}</p>
                    </div>
                    @endif

                    <div class="mb-3">
                        <strong>Mensaje:</strong>
                        <p>{{ $contact->message }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Estado:</strong>
                        <p>
                            @if($contact->status === 'pending')
                                <span class="badge bg-warning">Pendiente</span>
                            @elseif($contact->status === 'read')
                                <span class="badge bg-info">Leído</span>
                            @else
                                <span class="badge bg-success">Respondido</span>
                            @endif
                        </p>
                    </div>

                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
