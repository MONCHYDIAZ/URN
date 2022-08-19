<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tipoDocumento->nombre??'', ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('abreviatura') }}
            {{ Form::text('abreviatura', $tipoDocumento->abreviatura??'', ['class' => 'form-control' . ($errors->has('abreviatura') ? ' is-invalid' : ''), 'placeholder' => 'Abreviatura']) }}
            {!! $errors->first('abreviatura', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>

    </div>
    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('tipo-documento.index') }}"> Regresar</a>

        @if (Route::currentRouteName() =='tipo-documento.create' || !empty($tipoDocumento->nombre) )
        <button type="submit" class="btn btn-primary">Enviar</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
        @endif
    </div>
</div>