<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $rol->nombre??'', ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $rol->tipo??'', ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $rol->descripcion??'', ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('rol.index') }}"> Regresar</a>
        @if ( Route::currentRouteName() =='rol.create' ||!empty($rol->nombre))
        <button type="submit" class="btn btn-primary">Enviar</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Enviar</button>
        @endif
    </div>
</div>