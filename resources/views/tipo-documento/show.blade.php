@extends('layouts.app')

@section('template_title')
{{ $tipoDocumento->nombre ?? 'Show Tipo Documento' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Tipo Documento</span>
                    </div>
                    <br>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('tipo-documento.index') }}"> Regresar</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <strong>UUID:</strong>
                        {{ $tipoDocumento->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $tipoDocumento->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Abreviatura:</strong>
                        {{ $tipoDocumento->abreviatura }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection