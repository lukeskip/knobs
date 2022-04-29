@extends('layouts.main',['body_class' => 'song-create'])
@section('styles')
<link rel="stylesheet" href="{{asset('/plugins/dropzone/dropzone.css')}}">
<link rel="stylesheet" href="{{asset('/css/profiles.css')}}">
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
		<input type="hidden" name="profile" class="profile-selection">
		<div class="row">
			<div class="col-md-8">
				<label class="title">Nombre de la canción:</label>
				<input name="title" required type="text" class="form-control" placeholder="Escribe el nombre de la canción">
				<input type="hidden" name="song_file" class="song-file">
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
			<div class="col-md-6">
				<div class="form-group">
					<label class="title">Nombre de la banda o solista:</label>
					<input name="author" required type="text" class="form-control" placeholder="Escribe el nombre de la banda o solista">
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
				<textarea required name="description" id="" cols="30" rows="10" class="form-control" placeholder="Describe tus intenciones en la canción y tus dudas con aspectos específicos"></textarea>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<label class="title">Elige al productor que más se acerque a tus necesidades:</label>
				@if($profiles)
					<div class="owl-carousel owl-theme profiles-list">
						@foreach($profiles as $profile)
						<div class="item profile" data-id="{{$profile->id}}">
							<h3 class="text-center">{{$profile->name}}</h3>
							<img class="image" src="{{$profile->image_url}}" alt="">
							<h4 class="text-center">{{$profile->genre}}</h4>
							<p>
								{{$profile->summary}}
							</p>
							<div class="pricing">
								costo: ${{$profile->pricing}}
							</div>

						</div>
						@endforeach
						
					</div>
				@endif


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
<script src="{{asset('/js/songs_create_functions.js')}}"></script>

@endsection