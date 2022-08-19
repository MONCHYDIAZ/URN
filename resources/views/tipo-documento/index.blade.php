@extends('layouts.app')

@section('template_title')
Tipo Documento
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Tipo Documento') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('tipo-documento.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Crear') }}
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
                                    <th>Abreviatura</th>
                                    <th>Status</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipoDocumentos as $tipoDocumento)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $tipoDocumento->uuid }}</td>
                                    <td>{{ $tipoDocumento->nombre }}</td>
                                    <td>{{ $tipoDocumento->abreviatura }}</td>

                                    <td>
                                        <form action="{{ route('tipo-documento.destroy',$tipoDocumento->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('tipo-documento.show',$tipoDocumento->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('tipo-documento.edit',$tipoDocumento->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $tipoDocumentos->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection