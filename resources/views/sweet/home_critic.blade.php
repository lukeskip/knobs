@extends('layouts.main',['body_class' => 'landing landing-critic fixed'])
@section('menu-items-first')
<li><a href='#about'>Qué es Knobs</a></li>
<li><a href='#process'>Cómo funciona</a></li>
@endsection
@section('content')
<div id="level" class="image-level level image_1 first-level">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>
					Complementa tus ingresos ayudando a músicos independientes.
				</h1>
				<div class="handwriting">
					Hay muchos músicos independientes buscando la opinión y la orientación de un experto, ayúdalos a llegar más allá con tu experiencia, y gana dinero con ello.
				</div>
				<br>
				<a href="{{route('profiles.create')}}" class="btn btn-lg btn-success">Regístrate</a>
			</div>
		</div>
	</div>
	
	
</div>
<div id="about" class="fourth-level level">
	<div class="container">
		<div class="row">
			<div class="col-md-10 columns-center">
				
				<br><br>
				<h2>¿Qué es Knobs?</h2>
				<p>Knobs es una plataforma que conecta a músicos independientes que comienzan su carrera, y productores y músicos experimentados, que con su experiencia ayudarán a llevar sus demos por el mejor camino.</p>
				<p>Es una plataforma que busca el intercambio de experiencia y el alza en la calidad de la música independiente.</p>
				<br><br>
				
				
			</div>
			<div class="col-md-12">
				<div class="text-center image">
					<img src="{{asset('img/back_3_rot.png')}}" alt="">
				</div>
			</div>
		</div>
		
	</div>
</div>
<div class="second-level level">
	<div class="container">
		<div class="row">
			<div class="col-md-10 columns-center">
				<h2>Necesitan Dirección</h2>
				<p>Spotify y iMusic están llenos de canciones de calidad "demo", pues las bandas independientes las lanzan sin filtros al público, motivados por la emoción del momento, pero sin la destreza y el olfato de un profesional.</p>
				<p>Este fenómeno genera un deterioro de las bandas y por lo tanto de la audiencia que busca nuevos sonidos en la escena independiente.</p>
				<br><br><br>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center">Calificarás su...</h2>
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
<div class="third-level level">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h2>Músicos necesitan tu olfato</h2>
				<p>Tus años de experiencia y éxitos te han dado la capacidad de encontrar el camino ideal para cada sonido y cada proyecto.</p>
				<p>Compárte tu conocimiento con otros músicos y dales una oportunidad a sus proyectos.</p>
				<br>
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
					<li>Te regístrate</li>
                    <li>Llena tu perfil</li>
                    <li>Tu perfil será aprobado en 48hrs.</li>
					<li>Eliges el costo que tendrá tu crítica</li>
					<li>Recibes tu pago semanalmente</li>
				</ol>
				<br>
				<a href="{{route('profiles.create')}}" class="btn btn-block btn-success btn-lg">
					Regístrate como crítico.
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

@endsection