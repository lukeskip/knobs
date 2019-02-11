@extends('layouts.no_menu')
@section('content')
<div class="container h-80">
<div class="row align-items-center h-00">
    <div class="col-5 mx-auto login-box">
        <div class="text-center">
            <img id="profile-img" class="profile-img-card" src="{{asset('img/logo_big.png')}}" width="200px" />
            <p id="profile-name" class="profile-name-card"></p>
            <form  class="form-signin">
                
                <button class="btn btn-lg btn-primary btn-block btn-signin facebook" type="submit"><i class="fab fa-facebook-f"></i> | Entrar con Facebook</button>
            </form><!-- /form -->
        </div>
    </div>
</div>
</div>
@endsection