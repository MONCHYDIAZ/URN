@extends('layouts.app')

@section('template_title')
{{ $talla->name ?? 'Show Talla' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">ver Talla</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('talla.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $talla->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $talla->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $talla->descripcion }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection