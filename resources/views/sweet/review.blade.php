@extends('layouts.main',['body_class' => 'review'])

@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song_profile">
		<div class="container ">
			<div class="row ">
				<div class="col-md-8">
					<h1>El hipster del ocho</h1>
					<h2 class="author">Por Lagartos en el Abismo</h2>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
				<div class="col-md-4 button_box">
					<button class="btn btn-success btn-block">Reproducir</button>
				</div>
				
			</div>

		</div>
	</div>
	<div class="knobs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>
						Califica
					</h2>
					<p>Cada banda tiene su propio sonido, toma en cuenta esto y reproduce su canción las veces que sea necesario, recuerda que su autor espera con ansias una opinión profesional para poder seguir creciendo. <strong>Se constructivo y profesional</strong></p>
					<div class="alert alert-dark" role="alert">
  						Arrastra el punto rojo del knob para calificar en base 10.
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="3" class="slider"></div>	
						</div>
						<div class="title">Creatividad</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="5" class="slider"></div>	
						</div>
						<div class="title">Letra</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="7" class="slider"></div>	
						</div>
						<div class="title">Arreglos</div>
					</div>
				</div>
			</div>

			<div class="row ">
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="8" class="slider"></div>	
						</div>
						<div class="title">Grabación</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master"  class="slider"></div>	
						</div>
						<div class="title">Mezcla</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="knob_item">
						<div class="slider-wrapper">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="5" class="slider"></div>	
						</div>
						<div class="title">Masterización</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="knob_item">
						<div class="slider-wrapper big">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="6" class="slider big"></div>	
						</div>
						<div class="title">Potencial Comercial</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="knob_item">
						<div class="slider-wrapper big">
							<div class="knob"></div>
							<div class="score"></div>
							<div id="slider_master" data-score="7" class="slider big"></div>	
						</div>
						<div class="title">Potencial Artístico</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="comments">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<h2 class="text-center">
					Describe...
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h3 class="text-center">Lo bueno</h3>
				<label for="" class="text-center">
					Resalta aquello que tiene potencial en la canción, no existe material que no tenga absolutamente nada de pontencial.
				</label>
				<textarea name="" id="" cols="30" rows="10"></textarea>
			</div>
			<div class="col-md-6">
				<h3 class="text-center">Lo malo</h3>
				<label for="" class="text-center">
					A nadie le gusta que le digan cosas malas de sus creaciones así que se respetuoso, firm y directo.
				</label>
				<textarea name="" id="" cols="30" rows="10"></textarea>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<br>
				<h2 class="text-center">Aconseja...</h2>
				<h3 class="text-center">¿Qué hacer ahora?</h3>
				<label for="" class="text-center">
					Diles cómo pueden mejorar, esta es una parte básica y es lo que la banda está esperando de ti, comparte tu experiencia
				</label>
				<textarea name="" id="" cols="30" rows="10"></textarea>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-centered">
				<div class="status-group">
					<select name="" id="" class="form-control group-item">
						<option value="">Selecciona...</option>
						<option value="publish">En revisión</option>
						<option value="draft">Borrador</option>
					</select>
					<button class="btn btn-success group-item">Guardar Crítica</button>
				</div>
			</div>
			
		</div>
		

	</div>
	</div>
	








	
@section('variables')
<script>
	mode = 'create';
</script>
@endsection

@section('knobs')
<script src="{{asset('/js/knobs.js')}}"></script>
@endsection
	
		



@endsection