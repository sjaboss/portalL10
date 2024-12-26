@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Nuevo Video</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Video</a></li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Nuevo Video</h4>
                </div>
                <div class="card-body">
                    <form class="row gy-1" method="POST" action="{{ route('videos.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="fecha" class="form-label">{{ __('Fecha del video') }}</label>
                                <input type="date" class="form-control @error('fecha') is-invalid @enderror"
                                    id="fecha" name="fecha" value="{{ old('fecha') }}" required autofocus>
                                @error('fecha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-8 col-md-6">
                            <div>
                                <label for="titulo" class="form-label">{{ __('Titulo') }}</label>
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror"
                                    id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                                @error('titulo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-1 col-md-6">
                            <div>
                                <label for="orden" class="form-label">{{ __('orden') }}</label>
                                <input type="number" class="form-control @error('orden') is-invalid @enderror"
                                    id="orden" name="orden" value="{{ old('orden') }}" required>
                                @error('orden')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-xxl-12 col-md-6">
                            <div>
                                <label for="src" class="form-label">{{ __('Src') }}</label>
                                <input type="text" class="form-control @error('src') is-invalid @enderror" id="src"
                                    name="src" value="{{ old('src') }}" required></input>
                                @error('src')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xxl-12 col-md-6">
                            <div>
                                <label for="pie" class="form-label">{{ __('Pie') }}</label>
                                <input type="text" class="form-control @error('pie') is-invalid @enderror" id="pie"
                                    name="pie" value="{{ old('pie') }}" required></input>
                                @error('pie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="col-xxl-12 col-md-6 text-end">
                            <div>
                                <br>
                                <a href="{{ route('noticias.index') }}" class="btn btn-danger">
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Guardar Registro') }}
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
            document.getElementById('orden').addEventListener('input', function() {
                var valor = this.value;
                if (!/^\d+$/.test(valor)) {
                    this.value = '';
                    alert('Solo se permiten números');
                }
            });
        @endpush
    @endsection
