@extends('layouts.no_menu',['body_class' => 'login'])


@section('content')
<div class="container">
    <div class="row justify-content-center login">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <h1 class="text-center">Conoce tu verdadero nivel</h1>
                    <form method="POST" action="{{ route('login') }}" class="dark">
                        @csrf
                        @if(isset($_GET['producer']) && $_GET['producer'])
                            <input type="hidden" name="producer" value=1>
                        @endif
                        <div class="form-group row">
                            <div class="col-md-12"><label for="email" class="">Email</label></div>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12"><label for="password" class="">Contraseña</label></div>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Recuerdame
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Entrar
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu password?
                                    </a>
                                @endif

                                <a class="" href="/register">¿No tienes cuenta?, regístrate!</a>
                            </div>
                            <!-- <div class="col-md-6">
                                <a href="/login/facebook" class="btn btn-primary btn-lg btn-block facebook">
                                    Entrar con facebook
                                </a >
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
