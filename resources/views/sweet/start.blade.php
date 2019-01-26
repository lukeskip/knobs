@extends('layouts.main')
@section('content')
<div class="item">
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-center">
				<br>
				<img class="rock" src="{{asset('/img/rock.png')}}" alt="">  
			</div>
			<div class="col-md-6 text">

				<h1>
					Agrega tu música a las Playlists de Rey Decibel
				</h1>
				<p>Tu banda necesita un boost para ser escuchada, agrega tus canciones a nuestras playlists. Sólo <strong>requieres una cuenta en Spotify</strong></p>
				<a href="/login/spotify"  class="btn btn-primary btn-lg spotify" role="button" aria-pressed="true">
				<img src="{{asset('img/spotify-logo.png')}}" alt=""> Entrar con Spotify</a>  
			</div>
			
			
		</div>
	</div>
</div>
	

	
		



@endsection