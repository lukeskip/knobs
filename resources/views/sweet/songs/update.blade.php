@extends('layouts.main',['body_class' => 'song-create'])

@section('content')

<div class="container">
	<form action="" class="dark">
		<div class="row">
			<div class="col-md-12">
				<br><br>
				<h1 class="text-center">Edita tu canción</h1>
				<p class="text-center">
					Un productor experto te dirá su opinión, lo que está bien y lo que está mal, además de consejos de hacia donde deberías de ir para conseguir tu objetivo. Todos los campos son requeridos.
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<label class="title">Nombre de la canción:</label>
				<input name="title" required type="text" class="form-control" value="{{$song->title}}">
			</div>
			<div class="col-md-4">
				<label class="title">Género:</label>
				<select name="genre" required id="" class="form-control">
					<option @if($song->genre == "rock") selected @endif value="rock">Rock</option>
					<option @if($song->genre == "pop") selected @endif value="pop">Pop</option>
					<option @if($song->genre == "metal") selected @endif value="metal">Metal</option>
					<option @if($song->genre == "latin") selected @endif value="latin">Ritmos Latinos</option>
					<option @if($song->genre == "blues") selected @endif value="blues">Blues</option>
					<option @if($song->genre == "soul") selected @endif value="soul">Soul</option>
					<option @if($song->genre == "jazz") selected @endif value="jazz">Jazz</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label class="title">Link de la canción <span class="hastooltip icon" title="Pega el link de spotify o soundcloud"><i class="fas fa-question-circle"></i></span>:</label>
				<input name="link" required type="text" class="form-control" value="{{$song->link}}">
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="title">Nombre de la banda o solista:</label>
					<input name="author" required type="text" class="form-control" value="{{$song->author}}">
				</div>
			</div>

			<div class="col-md-6">
				<label class="title">Aceptas críticas en inglés:</label>
				<select name="english" id="" class="form-control required">
					<option value="">Selecciona...</option>
					<option @if($song->english == 1) selected @endif value="1">Sí</option>
					<option @if($song->english == 0) selected @endif value="0">No</option>
				</select>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<label class="title">Descripción:</label>
				<textarea required name="description" id="" cols="30" rows="10" class="form-control">{{$song->description}}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<br>
				<button class="btn btn-success btn-lg submit">Actualizar Canción</button>
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
				Swal({
					type: 'error',
					title: 'Oops...',
					text: 'Tienes que llenar todos los campos marcados',
				});
			},
			submitHandler: function(form) {
				conection('PUT', $('form').serialize(),'/songs/{{$song->id}}',true).then(function(data){
					if(data.success == 1){
						show_message('success','¡Listo!',data.message,data.redirect);
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