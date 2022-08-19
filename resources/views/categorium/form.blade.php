<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $categorium->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion') }}
            {{ Form::text('descripcion', $categorium->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <br>
    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('categoria.index') }}"> Regresar</a>

        @if (Route::currentRouteName() =='categoria.create' || !empty($categorium->nombre))
        <button type="submit" class="btn btn-primary">Enviar</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Enviar</button>

        @endif
    </div>
</div>