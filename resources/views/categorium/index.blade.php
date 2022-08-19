@extends('layouts.app')

@section('template_title')
Categorium
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Categorias') }}
                        </span>

                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <div class="float-right">
                            <a href="{{ route('categoria.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear Categoria') }}
                            </a>
                        </div>
                        @endif
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
                                    <th>Descripcion</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoria as $categorium)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $categorium->uuid }}</td>
                                    <td>{{ $categorium->nombre }}</td>
                                    <td>{{ $categorium->descripcion }}</td>

                                    <td>
                                        <form action="{{ route('categoria.destroy',$categorium->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('categoria.show',$categorium->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('categoria.edit',$categorium->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $categoria->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection