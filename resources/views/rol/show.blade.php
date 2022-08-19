@extends('layouts.app')

@section('template_title')
{{ $rol->name ?? 'Show Rol' }}

@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Información de rol</span>
                    </div>
                    <div class="float-right">
                        @if (!empty($rol->nombre))
                        <form action="{{ route('rol.destroy',$rol->id??'') }}" method="POST">
                            <a class="btn  btn-secondary " href="{{ route('rol.index') }}"><i class="fa fa-fw fa-eye"></i> Regresar</a>
                            <a class="btn  btn-success" href="{{ route('rol.edit',$rol->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                        </form>
                        @endif

                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>UUID:</strong>
                        {{ $rol->uuid??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $rol->nombre??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo:</strong>
                        {{ $rol->tipo??'' }}
                    </div>
                    <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $rol->descripcion??'' }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection