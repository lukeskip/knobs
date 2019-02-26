@extends('layouts.main',['body_class' => 'profile'])
@section('styles')
<link rel="stylesheet" href="{{asset('/plugins/dropzone/dropzone.css')}}">
@endsection
@section('content')


	
<div class="form-items">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<br>
				<h2 class="text-center">
					Para poder registrarte como crítico proporciona los siguientes datos.
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form id="upload-files" class="dropzone" class="dark">
					{{csrf_field()}}
					<div class="dz-message">
					<label for="">
						Sube una foto de perfil arrastándola o dando click aquí
					</label>
					</div>

				</form>
			</div>
		</div>
		
		<form id="fields" action="" class="dark" >
			<input class="picture" type="hidden" name="picture" value="">
			<div class="row">
				<div class="col-md-4">
					<label for="">Área de Expertice</label>
					<select name="expertice" id="" class="form-control required">
						<option value="production">Productor</option>
						<option value="engineering">Ingenieria en audio</option>
						<option value="production">Músico de Estudio</option>
						<option value="composition">Compositor</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Género preferido</label>
					<select name="genre" id="" class="form-control required">
						<option value="rock">Rock</option>
					<option value="pop">Pop</option>
					<option value="metal">Metal</option>
					<option value="latin">Ritmos Latinos</option>
					<option value="blues">Blues</option>
					<option value="soul">Soul</option>
					<option value="jazz">Jazz</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Teléfono celular</label>
					<input class="form-control" type="phone" name="phone">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<label for="">Describe tu experiencia y logros de manera breve</label>
					<textarea name="summary" class="form-control required"></textarea>
				</div>
			</div>
		
			<div class="row">
				<div class="col-md-12 text-center">
					
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
                conection('POST', $('form').serialize(),'/profiles',true).then(function(data){
					if(data.success == 1){
						show_message('success','¡Listo!',data.message,data.redirect);
					}else{
						show_message('error','Error!',data.message);
					}
				
				});
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
			    
			},
			
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				var myDropzone = Dropzone.forElement(".dropzone");
    			myDropzone.processQueue();

			}
		});
		

	});
</script>
@endsection
	
		


