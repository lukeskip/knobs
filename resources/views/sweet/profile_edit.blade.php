@extends('layouts.main',['body_class' => 'profile'])
@section('styles')
<link rel="stylesheet" href="{{asset('/plugins/dropzone/dropzone.css')}}">
@endsection
@section('content')


	
<div class="form-items">
	<div class="container ">
		
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="picture inline" style="background-image:url({{asset('storage/profile_images/'.$profile->picture)}}) ">
					
				</div>
			</div>
			<div class="col-md-12">
				<form id="upload-files" class="dropzone" class="dark">
					{{csrf_field()}}
					<div class="dz-message">
					<label for="">
						Si subes una nueva foto sustituirá a la anterior
					</label>
					</div>

				</form>
			</div>
		</div>
		
		<form id="fields" action="" class="dark" >
			<input class="picture" type="hidden" name="picture" value="">
			<div class="row">
				<div class="col-md-12">
					<label for="">Nombre o Apodo:</label>
					<input type="text" name="name" class="form-control" value="{{$profile->name}}">
				</div>
				<div class="col-md-4">
					<label for="">Área de Expertice</label>
					<select name="expertice" id="" class="form-control required">
						<option value="">Selecciona...</option>
						<option @if($profile->expertice == 'production')selected @endif value="production">Productor</option>
						<option @if($profile->expertice == 'engineering')selected @endif value="engineering">Ingenieria en audio</option>
						<option @if($profile->expertice == 'musician')selected @endif value="musician">Músico de Estudio</option>
						<option @if($profile->expertice == 'composition')selected @endif value="composition">Compositor</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Género preferido</label>
					<select name="genre" id="" class="form-control required">
						<option value="">Selecciona...</option>
						<option @if($profile->genre == 'rock')selected @endif value="rock">Rock</option>
						<option  @if($profile->genre == 'pop')selected @endif value="pop">Pop</option>
						<option  @if($profile->genre == 'metal')selected @endif value="metal">Metal</option>
						<option  @if($profile->genre == 'latin')selected @endif value="latin">Ritmos Latinos</option>
						<option  @if($profile->genre == 'blues')selected @endif value="blues">Blues</option>
						<option  @if($profile->genre == 'soul')selected @endif value="soul">Soul</option>
						<option  @if($profile->genre == 'jazz')selected @endif value="jazz">Jazz</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Teléfono celular</label>
					<input class="form-control" type="phone" name="phone" value="{{$profile->phone}}">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label for="">Describe tu experiencia y logros de manera breve</label>
					<textarea name="summary" class="form-control required">{{$profile->summary}}</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h2>Datos de deposito</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label for="">Cuenta de Paypal </label>
					<input class="form-control" type="bank" name="paypal" value="{{$profile->paypal}}">
				</div>


			</div>
		
			<div class="row">
				<div class="col-md-12 text-center">
					<input type="hidden" name='profile' value="{{$profile->id}}">
					<button class="btn btn-success btn-lg" type="submit" id="submit">Guardar</button>
					
				</div>
			</div>
		</form>
		

	</div>
</div>
	



	

@endsection

@section('scripts')
<script src="{{asset('/plugins/dropzone/dropzone.js')}}"></script>
<script>
	Dropzone.autoDiscover = false;
	$(document).ready(function(){
		$('#upload-files').dropzone({	
	        url:'/upload/image',
			autoProcessQueue: false,
	        uploadMultiple: false,
	        maxFilezise: 10,
	        maxFiles: 1,
	        resizeWidth:500,
	        resizeMimeType:'image/jpeg',
	        success: function(file, response){
                $('.picture').val(response.file);
                submit();
            },
	        init: function () {
	      	           
	            this.on("maxfilesexceeded", function(file) {
		            this.removeAllFiles();
		            this.addFile(file);
	      		});
	        }
		});
		

		$.validator.setDefaults({ 
			ignore: [],
		});

		$.validator.messages.required = "";
		

		$('#fields').validate({
			rules: {
				file: {
					required: true,
				},
				genre: {
					required: true,
				},
				summary: {
					required: true,
				},
				expertice: {
					required: true,
				},
				phone: {
					required: true,
					// minlength: 10,
				},
				paypal: {
					email: true,
				},
			    
			},
			
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {

				var myDropzone = Dropzone.forElement(".dropzone");
    			

    			if(myDropzone.getQueuedFiles().length === 0){
    				submit();
    			}else{
    				myDropzone.processQueue();
    			}

			}
		});
		

		function submit(){
			conection('PUT', $('#fields').serialize(),'/profiles/{{$profile->id}}',true).then(function(data){
				if(data.success == 1){
					show_message('success','¡Listo!',data.message,data.redirect);
				}else{
					show_message('error','Error!',data.message);
				}
				
			});
		}

	});
</script>
@endsection
	
		


