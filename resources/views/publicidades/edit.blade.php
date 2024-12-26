@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Editar Publicidad</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Publicidad</a></li>
                    <li class="breadcrumb-item active">Editar Registro</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Editar Publicidad</h4>
            </div>
            <div class="card-body">
                <form class="row gy-1" method="POST" action="{{ route('publicidades.update',$publicidad->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-xxl-3 col-md-6">
                        <div>
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre',$publicidad->nombre) }}"  required autofocus>
                            @error('nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-xxl-6 col-md-6">
                        <div>
                            <label for="foto" class="form-label">{{ __('Foto (Opcional)') }}</label>
                            <input type="file" id="foto" name="foto" class="form-control pe-5 @error('foto') is-invalid @enderror">
                            <img id="preview" class="img-thumbnail mt-2" src="{{ asset('storage').'/'.$publicidad->foto }}" alt="">
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
                            <a href="{{ route('publicidades.index') }}" class="btn btn-danger">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Editar Registro') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // mostrar imagen seleccionada
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.querySelector('#foto');
        const photoPreview = document.querySelector('#preview');
        photoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    photoPreview.src = reader.result;
                })
                reader.readAsDataURL(file);
            }
        })
    })
</script>
@endpush
@endsection
