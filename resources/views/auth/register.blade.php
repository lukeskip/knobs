@extends('layouts.no_menu')

@section('content')
<div class="container">
    <div class="row justify-content-center login">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Regístrate</h1>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="dark">
                        @csrf

                        <div class="form-group row">
                            
                            

                            <div class="col-md-12">
                                <label for="name">Nombre</label>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-md-12">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            

                            <div class="col-md-6">
                                <label for="password">Contraseña</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                       
                            

                            <div class="col-md-6">
                                <label for="password-confirm">Confirmar contraseña</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">
                                    Registrar
                                </button>
                            </div>

                            <div class="col-md-6">
                               <a href="/login/facebook" type="submit" class="btn btn-lg btn-block facebook">
                                    Entrar con facebook
                                </a >
                            </div>
                        </div>

                        <input type="hidden" name="role" value="{{$role}}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
