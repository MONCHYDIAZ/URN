@extends('layouts.app')

@section('template_title')
{{ $categorium->name ?? 'Show Categorium' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Error</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-secondary" href="{{ route('categoria.index') }}"> Regresar</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $categorium->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $categorium->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $categorium->descripcion }}
                    </div>
                    <div class="form-group">
                        <strong>Status:</strong>
                        {{ $categorium->status }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection