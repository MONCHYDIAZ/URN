@extends('layouts.app')

@section('template_title')
Factura
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Factura') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('factura.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
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
                                    <th>Cliente Id</th>
                                    <th>Total</th>
                                    <th>Subtotal</th>
                                    <th>Iva</th>
                                    <th>Status</th>
                                    <th>User Creator</th>
                                    <th>User Last Update</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($facturas as $factura)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $factura->uuid }}</td>
                                    <td>{{ $factura->cliente_id }}</td>
                                    <td>{{ $factura->total }}</td>
                                    <td>{{ $factura->subtotal }}</td>
                                    <td>{{ $factura->iva }}</td>
                                    <td>{{ $factura->status }}</td>
                                    <td>{{ $factura->user_creator }}</td>
                                    <td>{{ $factura->user_last_update }}</td>

                                    <td>
                                        <form action="{{ route('factura.destroy',$factura->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('factura.show',$factura->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('factura.edit',$factura->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $facturas->links() !!}
        </div>
    </div>
</div>
@endsection