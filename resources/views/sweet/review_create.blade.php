@extends('layouts.main',['body_class' => 'review'])

@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song-profile {{$song->genre}}">
		<div class="container ">
			<div class="row ">
				<div class="col-md-8">
					<h1>{{$song->title}}</h1>
					<h2 class="author">{{$song->author}}</h2>
					<p>{{$song->description}}</p>

					<audio src="{{asset('storage/song_files/'.$song->file)}}" controls></audio>
				</div>
				<div class="col-md-4 button_box ">
					
				</div>
				
			</div>

		</div>
	</div>
	<form action="" class="dark">
		<input name="song_id" type="hidden" value="{{$song->id}}">
		<div class="knobs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h2>
							Califica
						</h2>
						<p>Cada banda tiene su propio sonido, toma en cuenta esto y reproduce su canción las veces que sea necesario, recuerda que su autor espera con ansias una opinión profesional para poder seguir creciendo. <strong>Se constructivo y profesional</strong></p>
						<div class="alert alert-dark" role="alert">
	  						Arrastra el punto metálico del knob para calificar en base 10. Si foco rojo se prende siginifica que hay un error de validación
						</div>
					</div>
				</div>
				<div class="row">
					@foreach($knobs as $knob)
					<!-- Knob small -->
					<div class="@if($knob->importance == 1) col-md-6 @else col-md-4 @endif">
						<div class="knob_item">
							<div class="slider-wrapper @if($knob->importance == 1) big @endif">
								<div class="error_light"></div>
								<div class="knob"></div>
								<div class="score"></div>
								<div id="{{$knob->slug}}" data-score="{{$knob->score}}" class="slider required @if($knob->importance == 1) big @endif"></div>	
							</div>
							<label class="title">{{$knob->label}}</label>
						</div>
					</div>
					<!-- Knob small -->
					@endforeach
		
				</div>
			</div>		
		</div>
		
		<div class="form-items">
			<div class="container ">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">
							Describe...
						</h2>
					</div>
				</div>
				<div class="row">
					@foreach($form_items as $item)
						<div class="col-md-12">
							<div class="text-center"><h3 class="title">{{$item->label}}</h3></div>
							<p for="" class="text-center">
								{{$item->instructions}}
							</p>
							<textarea placeholder="Escribe..." name="{{$item->slug}}" id="" cols="30" rows="10"></textarea>
						</div>
					@endforeach
				</div>
				
				<div class="row">
					<div class="col-md-6 col-centered">
						<div class="status-group">
							<select name="status" id="" class="form-control group-item status">
								<option value="">Selecciona...</option>
								<option value="revision">En revisión</option>
								<option value="draft">Borrador</option>
							</select>
							<button class="btn btn-success group-item submit">Guardar Crítica</button>
						</div>
					</div>
					
				</div>
				

			</div>
		</div>
	</form>
	

@endsection






	
@section('variables')
<script>
	mode = 'create';
</script>
@endsection

@section('knobs')
<script src="{{asset('/js/knobs.js')}}"></script>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){

		
		$('form').validate({
			ignore: "",
			rules: {
				@foreach($knobs as $knob)
					{{$knob->slug}}: {
						required: function(element){
							return $(".status").val()!= "draft";
						},
						min: function(element){
							if ($(".status").val()!= "draft"){
								return 1;
							}else{
								return 0;
							}
							
						},
					},
				@endforeach
				@foreach($form_items as $item)
					{{$item->slug}}: {
						required: function(element){
							return $(".status").val()!= "draft";
						}
					},
				@endforeach
			},
			highlight:function(element){
				
				$(element).parent().parent().find('.error_light').addClass('active');
				$(element).addClass('error');
			},
			unhighlight:function(element){
				$(element).parent().parent().find('.error_light').removeClass('active');
				$(element).removeClass('error');
			},
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				conection('POST', $('form').serialize(),'/reviews',true).then(function(data){
					if(data.success == 1){
						show_message('success','¡Listo!','Tu knob fue registrado',data.redirect);
					}else{
						show_message('error','Error!',data.message);
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
	
		


