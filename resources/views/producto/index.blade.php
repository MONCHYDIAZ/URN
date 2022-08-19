@extends('layouts.app')

@section('template_title')
Producto
@endsection

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('search_product')}}" id="search-form">
        @csrf
        <div class="grid grid-cols-12 gap-6">
            <div class="form-group">
                {{ Form::label('categoria') }}
                {{ Form::select('id_categoria',$categorias ,[], ['class' => 'form-control' . ($errors->has('id_categoria') ? ' is-invalid' : ''), 'placeholder' => 'seleccionar']) }}
            </div>
        </div>
        <br>
        <a class="btn btn-sm btn-primary " href="{{ route('producto.index')}}"><i class="fa fa-fw fa-eye"></i> Limpiar</a>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-fw fa-trash"></i> Buscar</button>

    </form>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Producto') }}
                        </span>
                        @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                        <div class="float-right">
                            <a href="{{ route('producto.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear') }}
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
                                    <th>Color</th>
                                    <th>Precio</th>
                                    <th>Descripcion</th>
                                    <th> Categoria</th>
                                    <th> Cantidad</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $producto->uuid }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td style="background-color: {{ $producto->color }}"></td>
                                    <td>{{ $producto->precio }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>{{ $producto->categorium->nombre }}</td>
                                    <td>{{ $producto->cantidad }}</td>
                                    <td>
                                        <form action="{{ route('producto.destroy',$producto->uuid) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('producto.show',$producto->uuid) }}"><i class="fa fa-fw fa-eye"></i> ver</a>
                                            @if ((int)Auth::user()->rol_id == (int)\App\Models\User::PROFILES['admin'])
                                            <a class="btn btn-sm btn-success" href="{{ route('producto.edit',$producto->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $productos->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection