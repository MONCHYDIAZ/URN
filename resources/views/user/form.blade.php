<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Rol') }}
            {{ Form::select('rol_id', $rols,$user->rol_id, ['class' => 'form-control' . ($errors->has('rol_id') ? ' is-invalid' : ''), 'placeholder' => 'Rol']) }}
            {!! $errors->first('rol_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Tipo documento') }}
            {{ Form::select('tipo_documento_id', $tipo_documentos,$user->tipo_documento_id, ['class' => 'form-control' . ($errors->has('tipo_documento_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Documento']) }}
            {!! $errors->first('tipo_documento_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('documento') }}
            {{ Form::number('documento', $user->documento, ['class' => 'form-control' . ($errors->has('documento') ? ' is-invalid' : ''), 'placeholder' => 'Documento']) }}
            {!! $errors->first('documento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direccion') }}
            {{ Form::text('direccion', $user->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Direccion']) }}
            {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('telefono') }}
            {{ Form::number('telefono', $user->telefono, ['class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''), 'placeholder' => 'Telefono']) }}
            {!! $errors->first('telefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha de nacimiento') }}
            {{ Form::date('fecha_nacimiento', $user->fecha_nacimiento, ['class' => 'form-control' . ($errors->has('fecha_nacimiento') ? ' is-invalid' : ''), 'placeholder' => 'fecha de nacimiento']) }}
            {!! $errors->first('fecha_nacimiento', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <a class="btn btn-secondary" href="{{ route('user.index') }}"> Regresar</a>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</div>