@extends('layouts.app')

@section('template_title')
{{ $producto->name ?? 'Show Producto' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Producto</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('producto.index') }}"> Regresar</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $producto->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $producto->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Color:</strong>
                        <svg width="50" height="20" style="border:2px solid black;">
                            <rect width="50" height="20" style="fill: {{ $producto->color }}" />
                        </svg>
                    </div>
                    <div class="form-group">
                        <strong>Precio:</strong>
                        {{ $producto->precio }}
                    </div>
                    <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $producto->descripcion }}
                    </div>
                    <div class="form-group">
                        <strong> Categoria:</strong>
                        {{ $producto->categorium->nombre }}
                    </div>
                    <div class="form-group">
                        <strong> Tallas:</strong>
                        <ul>
                            @foreach ($producto->tallasProductos as $talla)
                            <li> {{ $talla->nombre}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection