@extends('layouts.main',['body_class' => 'landing fixed'])
@section('styles')
<link rel="stylesheet" href="{{asset('/css/profiles.css')}}">
@endsection
@section('menu-items-first')
<li><a href='#about'>Qué es Knobs</a></li>
<li><a href='#process'>Cómo funciona</a></li>
@endsection
@section('content')
<div id="level" class="image-level level image_1 first-level landing">
	<div class="container">
				<h1>
					Conoce tu verdadero nivel
				</h1>
				<div class="handwriting">
					Conoce la opinión sincera de un experto sobre tu proyecto musical
				</div>
				<br>
				<a href="/register" class="btn btn-lg btn-success">Regístrate</a>
	</div>
	
	
</div>
<div id="about" class="fourth-level level">
<div class="container">
		<div class="row">
			<div class="col-md-10 columns-center">
		
				<h2>¿Qué es Knobs?</h2>
				<p>Knobs es una plataforma que muestra tu música a expertos de  Rey Decibel, para que escuchen tus canciones y te den consejos de cómo mejorar tu proyecto.</p>
				<p>Es una plataforma que busca el intercambio de experiencia y el alza en la calidad de la música independiente.</p>
				<br><br>
			</div>
		</div>	
	</div>
</div>
<div class="second-level level">
	<div class="container">
		<div class="row">
			<div class="col-md-10 columns-center">
				<h2>Necesitas Dirección</h2>
				<p>Spotify y iMusic están llenos de canciones de calidad "demo", pues las bandas independientes las lanzan sin filtros al público, motivados por la emoción del momento, pero sin la destreza y el olfato de un profesional.</p>
				<p>Lanzar canciones sin la calidad debida retrasará tu proyecto, hacer una fanbase cargando con malas grabaciones o arreglos que no aportan, será una tarea difícil.</p>
				<br><br><br>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center">Calificamos tu...</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="knob_item">
					<div class="slider-wrapper">
						<div class="knob"></div>
						<div class="score"></div>
						<div data-score="10" class="slider disable"></div>	
					</div>
					<label class="title">Composición</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="knob_item">
					<div class="slider-wrapper">
						<div class="knob"></div>
						<div class="score"></div>
						<div data-score="6" class="slider disable"></div>	
					</div>
					<label class="title">Ejecución</label>
				</div>
			</div>
			<div class="col-md-4">
				<div class="knob_item">
					<div class="slider-wrapper">
						<div class="knob"></div>
						<div class="score"></div>
						<div data-score="5" class="slider disable"></div>	
					</div>
					<label class="title">Grabación</label>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="process" class="fifth-level level process">
	<div class="container">
		
		<div class="row">
			<div class="col-md-6 columns-center">
				<h2 class="text-center">Como funciona</h2>
				<ol class="handwriting process-list">
					<li>Te registras con un click</li>
					<li>Registras tu canción</li>
					<li>Cubres el costo desde ${{$price}} MXN por canción registrada, en OXXO o Paypal </li>
					<li>En menos de 48hrs. recibirás tu Knob</li>
				</ol>
				<br>
				<a href="/register" class="btn btn-block btn-success btn-lg">
					Registra tu primera canción
				</a>
				<br><br>
			</div>
		</div>
		
	</div>
</div>




@endsection

@section('scripts')
<script>
	var mode = 'show';
</script>
<script src="{{asset('/js/knobs.js')}}"></script>
<script src="{{asset('/js/profiles-carousel.js')}}"></script>

@endsection