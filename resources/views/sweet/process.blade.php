@extends('layouts.main')

@section('content')
<div class="item">
	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="step">
					<div class="description">Paso</div>
					<div class="number">1</div>
				</div>

				<div class="form-group">
			    	<label for="song">Pega el link de la rola que quieras promocionar.</label>
			    	<input type="text" class="form-control" id="song" aria-describedby="songHelp" placeholder="https://open.spotify.com/track/6YqGjribLfVylui4JsaWTR?si=w7J8EtqCRvqR3g_DcZTd6g">
			    	Encuéntralo en Spotfy, da click derecho sobre la canción deseada y en el submenú "compartir" da click en botón copiar link.
			  	</div>	
			</div>
		</div>
	</div>
	
	
	<a href="#"  class="btn btn-primary btn-lg spotify top step_1" role="button" aria-pressed="true">
	Siguiente</a>  
	
</div>

<div class="item">
	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="step">
					<div class="description">Paso</div>
					<div class="number">2</div>
				</div>
				<label for="">
					Sigue a Rey Decibel en Spotify.
				</label>
				<br>
				<img src="{{asset('img/logo_rey_spotify.png')}}" alt="" class="rey_user_img">
				<br>
				<a href="#"  class="btn btn-primary btn-lg spotify step_2" role="button" aria-pressed="true">Seguir a Rey Decibel</a>  
			</div>
		</div>
	</div>
	
	
	
	
</div>


<div class="item">
	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="container">
		<div class="step">
			<div class="description">Paso</div>
			<div class="number">3</div>
		</div>
		<label for="">De la siguiente lista elige al menos 2 playlist para seguir</label>
		<div class="owl-carousel-inner text-center">
			<img src="{{asset('img/loader.svg')}}" alt="">
		</div>
		<a href="#"  class="btn btn-primary btn-lg spotify top step_3" role="button" aria-pressed="true">
		Siguiente</a>
	</div>  
	
</div>

<div class="item">
	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="step">
					<div class="description">Paso</div>
					<div class="number">4</div>
				</div>
				<h2>Listo ahora a esperar</h2>
				<label for="">Disfruta la listas de reproducción con mucha música nueva. Te enviaremos un email cuando tu rola esté incluida, recuerda entre más veces sea solicitada en está plataforma, tiene más oportunidades y más pronto será incluida.</label>
				<br><br>
				<p class="text-center">

					<a href="#" target="_blank" class="btn btn-primary btn-lg spotify last_spotify" role="button" aria-pressed="true">
						<img src="{{asset('img/spotify-logo.png')}}" alt=""> 
						Reproducir Música Chingona
					</a>
				</p>

		
			</div>
		</div>
	</div>  
	
</div>




	

	
		



@endsection