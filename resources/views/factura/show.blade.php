@extends('layouts.app')

@section('template_title')
    {{ $factura->name ?? 'Show Factura' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Factura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('facturas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Uuid:</strong>
                            {{ $factura->uuid }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $factura->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $factura->total }}
                        </div>
                        <div class="form-group">
                            <strong>Subtotal:</strong>
                            {{ $factura->subtotal }}
                        </div>
                        <div class="form-group">
                            <strong>Iva:</strong>
                            {{ $factura->iva }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $factura->status }}
                        </div>
                        <div class="form-group">
                            <strong>User Creator:</strong>
                            {{ $factura->user_creator }}
                        </div>
                        <div class="form-group">
                            <strong>User Last Update:</strong>
                            {{ $factura->user_last_update }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
