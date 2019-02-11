@extends('layouts.main',['body_class' => 'song-create'])

@section('content')

<div class="container">
	<form action="" class="dark">
		<div class="row">
			<div class="col-md-12">
				<br><br>
				<h1 class="text-center">Registra tu canción</h1>
				<p class="text-center">
					Un productor experto te dirá su opinión, lo que está bien y lo que está mal, además de consejos de hacia donde deberías de ir para conseguir tu objetivo. Todos los campos son requeridos.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<label class="title">Nombre de la canción:</label>
				<input name="title" required type="text" class="form-control">
			</div>
			<div class="col-md-4">
				<label class="title">Género:</label>
				<select name="genre" required id="" class="form-control">
					<option value="rock">Rock</option>
					<option value="pop">Pop</option>
					<option value="metal">Metal</option>
					<option value="latin">Ritmos Latinos</option>
					<option value="blues">Blues</option>
					<option value="soul">Soul</option>
					<option value="jazz">Jazz</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label class="title">Link de la canción <span class="hastooltip icon" title="Pega el link de spotify o soundcloud"><i class="fas fa-question-circle"></i></span>:</label>
				<input name="link" required type="text" class="form-control">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="title">Nombre de la banda o solista:</label>
					<input name="author" required type="text" class="form-control">
				</div>
			</div>

			<div class="col-md-6">
				<label class="title">Aceptas críticas en inglés:</label>
				<select name="english" id="" class="form-control required">
					<option value="">Selecciona...</option>
					<option value="1">Sí</option>
					<option value="0">No</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label class="title">Descripción:</label>
				<textarea required name="description" id="" cols="30" rows="10" class="form-control"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<br>
				<button class="btn btn-success btn-lg submit">Registrar Canción</button>
			</div>
		</div>
	</form>
</div>





@endsection

@section('scripts')
<script>
	$(document).ready(function(){

	
		$('form').validate({
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				conection('POST', $('form').serialize(),'/songs',true).then(function(data){
					if(data.success == 1){
						show_message('success','¡Listo!','Tu canción fue registrada',data.redirect);
					}
				});
			}
		});
		$("body").on('click', '.submit', function(e) {
			e.preventDefault();
    		$('form').submit();
    		
		});

		

	});
</script>
@endsection