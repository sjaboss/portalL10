<div class="modal-header">
    <h5 class="modal-title">{{ $noticia->titulo }}</h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            @if($noticia->foto)
                <img src="{{ asset('storage/' . $noticia->foto) }}" 
                     class="img-fluid rounded" 
                     alt="{{ $noticia->titulo }}"
                     style="width: 100%; height: 300px; object-fit: cover;">
            @else
                <img src="{{ asset('assets/images/placeholder.svg') }}" 
                     class="img-fluid rounded" 
                     alt="Imagen no disponible"
                     style="width: 100%; height: 300px; object-fit: cover;">
            @endif
        </div>
        <div class="col-md-6">
            <p class="text-muted mb-3">
                <small>{{ \Carbon\Carbon::parse($noticia->fecha)->format('d/m/Y') }} | {{ $seccionObj->seccion }}</small>
            </p>
            <div class="mb-4">
                <h5>Resumen</h5>
                <p>{!! nl2br(e($noticia->bajada)) !!}</p>
            </div>
            <div>
                <h5>Detalles</h5>
                <p>{!! nl2br(e($noticia->nota)) !!}</p>
            </div>
            <div class="text-end mt-4">
                <p class="text-muted mb-0">
                    <small>Por {{ $noticia->autor }}</small>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>
