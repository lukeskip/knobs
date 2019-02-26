@extends('layouts.main',['body_class' => 'song-create'])
@section('styles')
<link rel="stylesheet" href="{{asset('/plugins/dropzone/dropzone.css')}}">
@endsection
@section('content')

<div class="container">
	
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">Registra tu canción</h1>
			<p class="text-center">
				Un productor experto te dirá su opinión, lo que está bien y lo que está mal, además de consejos de hacia donde deberías de ir para conseguir tu objetivo. Todos los campos son requeridos.
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<form id="upload-files" class="dropzone box" class="dark">
					{{csrf_field()}}
					<div class="dz-message text-center">
					<label for="">
						Sube un archivo MP3 de hasta 10 mb
					</label>
					<h4 >Arrastra o da click</h4>
					</div>
					<input type="hidden" name="song_file_name" value="{{$song_file_name}}">

			</form>
		</div>
	</div>
	<form id="fields" action="" class="dark">
		
		<div class="row">
			<div class="col-md-8">
				<label class="title">Nombre de la canción:</label>
				<input name="title" required type="text" class="form-control" value="{{$song->title}}">
				<input type="hidden" name="song_file" class="song-file" value="{{$song->file}}">
			</div>
			<div class="col-md-4">
				<label class="title">Género:</label>
				<select name="genre" required id="" class="form-control">
					<option @if($song->genre == 'rock') selected @endif value="rock">Rock</option>
					<option @if($song->genre == 'pop') selected @endif value="rock" value="pop">Pop</option>
					<option @if($song->genre == 'metal') selected @endif value="rock" value="metal">Metal</option>
					<option @if($song->genre == 'latin') selected @endif value="latin">Ritmos Latinos</option>
					<option @if($song->genre == 'blues') selected @endif value="blues">Blues</option>
					<option @if($song->genre == 'soul') selected @endif value="soul">Soul</option>
					<option @if($song->genre == 'jazz') selected @endif value="jazz">Jazz</option>
				</select>
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
					<option value="1" @if($song->english == 1) selected @endif>Sí</option>
					<option value="0" @if($song->english == 0) selected @endif>No</option>
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
				<button class="btn btn-success btn-lg submit">Registrar Canción</button>
			</div>
		</div>
	</form>
</div>


@endsection

@section('scripts')
<script src="{{asset('/plugins/dropzone/dropzone.js')}}"></script>
<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){

		$('#upload-files').dropzone({	
	        url:'/upload/mp3',
			autoProcessQueue: false,
	        uploadMultiple: false,
	        maxFilezise: 10,
	        maxFiles: 1,
	        acceptedFiles:'audio/mp3',
	        success: function(file, response){
                $('.song-file').val(response.file);
                register();
                
            },


	        init: function () {       
	            this.on("maxfilesexceeded", function(file) {
		            this.removeAllFiles();
		            this.addFile(file);
	      		});
				
	        }
		});

		$('#fields').validate({
			ignore:".hidden",
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				
				var myDropzone = Dropzone.forElement(".dropzone");
				if (myDropzone.getQueuedFiles().length === 0) {
					register();
				}else{
					$('.loader').css('display','block');
					myDropzone.processQueue();
				}
					
				
				
			}
		});
		
		$("body").on('click', '.submit', function(e) {
			e.preventDefault();
    		$('#fields').submit();
    		
		});


		function register(){
			conection('PUT', $('#fields').serialize(),'/songs/{{$song->id}}',true).then(function(data){
				if(data.success == 1){
					show_message('success','¡Listo!','Tu canción fue registrada',data.redirect);
				}else{
					show_message('error','Error!',data.message);
				}
			});
		}

	});
</script>
@endsection