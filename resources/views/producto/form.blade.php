    <div class="box box-info padding-1">
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('nombre') }}
                {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('color') }}
                {{ Form::color('color', $producto->color, ['class' => 'form-control' . ($errors->has('color') ? ' is-invalid' : ''), 'placeholder' => 'Color']) }}
                {!! $errors->first('color', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('precio') }}
                {{ Form::number('precio', $producto->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('descripcion') }}
                {{ Form::text('descripcion', $producto->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('categoria') }}
                {{ Form::select('id_categoria',$categorias ,$producto->id_categoria, ['class' => 'form-control' . ($errors->has('id_categoria') ? ' is-invalid' : ''), 'placeholder' => ' seleccionar']) }}
                {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}
            </div>

            <div class="form-group">
                {{ Form::label('Cantidad') }}
                {{ Form::number('cantidad',$producto->cantidad, ['class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''), 'placeholder' => ' cantidad']) }}
                {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group ">
                {{ Form::label('Tallas') }}
                <br>
                @foreach ($tallas as $talla)
                <input type="checkbox" class="form-check-input " id="check{{$talla->id}}" name="tallas[]" value="{{ $talla->id }} " @if (!empty($producto->tallas) && in_array($talla->id, $producto->tallas))checked @endif />

                <label class="btn-btn-online-primary" for="check{{ $talla->id }}">
                    <p class="serv-text"> {{ $talla->nombre }} </p>
                </label>
                @endforeach

            </div>
            <br>
        </div>
        <div class="box-footer mt20">
            <a class="btn btn-secondary" href="{{ route('producto.index') }}"> Regresar</a>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </div>