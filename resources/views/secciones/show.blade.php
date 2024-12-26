@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{ $seccion->seccion }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">{{ $seccion->seccion }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach($noticias as $noticia)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if($noticia->foto)
                            <img src="{{ asset('storage/' . $noticia->foto) }}" class="card-img-top" alt="{{ $noticia->titulo }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $noticia->titulo }}</h5>
                                <p class="card-text">{{ Str::limit($noticia->bajada, 150) }}</p>
                                <a href="{{ route('noticias.show', $noticia) }}" class="btn btn-primary">Leer más</a>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $noticia->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
