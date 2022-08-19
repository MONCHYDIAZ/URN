@extends('layouts.app')

@section('template_title')
User
@endsection

@section('content')
<div class="container-fluid">
    <form method="POST" action="{{ route('search_user')}}" id="search-form">
        @csrf
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-3 sm:col-span-3">
                <input type="text" name="email" placeholder="email..." value="{{ request('email') }}" autocomplete="off" class="bg-white h-10 px-5 pr-10 rounded text-sm focus:outline-none w-full" />
            </div>
        </div>
        <br>
        <a class="btn btn-sm btn-primary " href="{{ route('user.index')}}"><i class="fa fa-fw fa-eye"></i> Limpiar</a>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-fw fa-trash"></i> Buscar</button>

    </form>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('User') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Tipo Documento</th>
                                    <th>Documento</th>
                                    <th>Telefono</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $user->uuid }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->rol->nombre }}</td>
                                    <td>{{ $user->TipoDocumento->abreviatura }}</td>
                                    <td>{{ $user->documento }}</td>
                                    <td>{{ $user->telefono }}</td>
                                    <td>
                                        <form action="{{ route('user.destroy',$user->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('user.show',$user->uuid) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('user.edit',$user->uuid) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
            {!! $users->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection