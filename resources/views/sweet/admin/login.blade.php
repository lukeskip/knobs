@extends('layouts.admin')
@section('content')
<section class="row">
	<div class="col-md-12 text-center">
		<br><br>
		
		<a href="/login/spotify"  class="btn btn-primary btn-lg spotify" role="button" aria-pressed="true">
				<img src="{{asset('img/spotify-logo.png')}}" alt=""> Entrar con Spotify</a> 
	</div>
</section>


@endsection