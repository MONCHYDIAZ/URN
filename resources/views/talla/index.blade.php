@extends('layouts.app')

@section('template_title')
Talla
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Talla') }}
                        </span>

                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <div class="float-right">
                            <a href="{{ route('talla.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear talla') }}
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
                                @foreach ($tallas as $talla)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $talla->uuid }}</td>
                                    <td>{{ $talla->nombre }}</td>
                                    <td>{{ $talla->descripcion }}</td>

                                    <td>
                                        <form action="{{ route('talla.destroy',$talla->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('talla.show',$talla->uuid) }}"><i class="fa fa-fw fa-eye"></i> ver</a>
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('talla.edit',$talla->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $tallas->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection