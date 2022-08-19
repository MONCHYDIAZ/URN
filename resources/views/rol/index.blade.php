@extends('layouts.app')

@section('template_title')
Rol
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Rol') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('rol.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear Rol') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Uuid</th>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Descripcion</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rols as $rol)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $rol->uuid }}</td>
                                    <td>{{ $rol->nombre }}</td>
                                    <td>{{ $rol->tipo }}</td>
                                    <td>{{ $rol->descripcion }}</td>

                                    <td>
                                        <form action="{{ route('rol.destroy',$rol->uuid)}}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('rol.show',$rol->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('rol.edit',$rol->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $rols->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection