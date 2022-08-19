@extends('layouts.app')

@section('content')
<div id="class_logo">
    <img type="image" src='https://i.postimg.cc/HsJtmDk0/logo.jpg' alt="Sistemas a al mano" width="150" height="170" /></a>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Bienvenido!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection