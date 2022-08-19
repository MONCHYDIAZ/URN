@extends('layouts.app')

@section('template_title')
{{ $user->name ?? 'Show User' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Ver Usuario</span>
                    </div>
                    <br>
                    <div class="float-right">
                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Regresar</a>
                        @else
                        <a class="btn btn-primary" href="{{ route('home') }}"> Regresar</a>
                        @endif
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Uuid:</strong>
                        {{ $user->uuid }}
                    </div>
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group">
                        <strong>Rol:</strong>
                        {{ $user->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Tipo Documento:</strong>
                        {{ $user->abreviatura }}
                    </div>
                    <div class="form-group">
                        <strong>Documento:</strong>
                        {{ $user->documento }}
                    </div>
                    <div class="form-group">
                        <strong>Direccion:</strong>
                        {{ $user->direccion }}
                    </div>
                    <div class="form-group">
                        <strong>Telefono:</strong>
                        {{ $user->telefono }}
                    </div>

                    <div class="form-group">
                        <strong>Fecha Nacimiento:</strong>
                        {{ $user->fecha_nacimiento }}
                    </div>

                    <div class="form-group">
                        <strong>Edad:</strong>
                        {{ $user->edad }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection