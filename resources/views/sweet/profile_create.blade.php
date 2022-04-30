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
				<br>
				<div class="col-md-12">
					<label for="">Nombre o Apodo:</label>
					<input type="text" name="name" class="form-control">
				</div>
				<div class="col-md-4">
					<label for="">Área de Expertice</label>
					<select name="expertice" id="" class="form-control required">
						<option value="">Selecciona...</option>
						<option value="production">Productor</option>
						<option value="engineering">Ingenieria en audio</option>
						<option value="musician">Músico de Estudio</option>
						<option value="composition">Compositor</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="">Género preferido</label>
					<select name="genre" id="" class="form-control required">
						<option value="">Selecciona...</option>
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
				<div class="col-md-12">
					<label for="">Selecciona tu precio crítica</label>
					<select class="form-control" name="pricing" id="">
						<option value="600">$600 MXN</option>
						<option value="800">$800 MXN</option>
						<option value="800">$1,000 MXN</option>
						<option value="800">$,1200 MXN</option>
						<option value="800">$1,500 MXN</option>
						<option value="800">$1,800 MXN</option>
						<option value="800">$2,000 MXN</option>
					</select>
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
					<input class="form-control" type="bank" name="paypal">
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
				name: {
					required: true,
				},
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
				if (myDropzone.getQueuedFiles().length === 0) {
					show_message('error','¡Error!','Tienes que agregar un archivo');
				}else{
					$('.loader').css('display','block');
					myDropzone.processQueue();
				}

			}
		});
		

	});
</script>
@endsection
	
		


