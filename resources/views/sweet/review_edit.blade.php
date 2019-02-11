@extends('layouts.main',['body_class' => 'review'])

@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song_profile">
		<div class="container ">
			<div class="row ">
				<div class="col-md-8">
					<h1>{{$review->songs->title}}</h1>
					<h2 class="author">{{$review->songs->author}}</h2>
					<p>{{$review->songs->description}}</p>
					<a href="{{$review->songs->link}}" class="btn btn-success btn-lg" target="blank">
						{!! html_entity_decode($review->icon) !!} 
						Reproducir
					</a>
				</div>
				<div class="col-md-4 button_box">
					
				</div>
				
			</div>

		</div>
	</div>
	<form action="" class="dark">
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
					<div class="@if($knob->categories->importance == 1) col-md-6 @else col-md-4 @endif">
						<div class="knob_item">
							<div class="slider-wrapper @if($knob->categories->importance == 1) big @endif">
								<div class="error_light"></div>
								<div class="knob"></div>
								<div class="score"></div>
								<div id="{{$knob->categories->slug}}" data-score="{{$knob->score}}" class="slider required @if($knob->categories->importance == 1) big @endif"></div>	
							</div>
							<label class="title">{{$knob->categories->label}}</label>
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
						<div class="@if($item->categories->importance == 1) col-md-12 @elseif($item->categories->importance == 2) col-md-6 @else col-md-4 @endif">
							<div class="text-center"><h3 class="title">{{$item->categories->label}}</h3></div>
							<p for="" class="text-center">
								{{$item->categories->instructions}}
							</p>
							<textarea placeholder="Escribe..." required name="{{$item->categories->slug}}" id="" cols="30" rows="10">{{$item->score}}</textarea>
						</div>
					@endforeach
				</div>
				
				<div class="row">
					<div class="col-md-6 col-centered">
						<div class="status-group">
							<select name="status" required id="" class="form-control group-item">
								<option value="">Selecciona...</option>
								<option @if($review->status== "revision") selected @endif value="revision">En revisión</option>
								<option @if($review->status== "draft") selected @endif  value="draft">Borrador</option>
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
	mode = 'edit';
</script>
@endsection

@section('knobs')
<script src="{{asset('/js/knobs.js')}}"></script>
@endsection

@section('scripts')
<script>
	$(document).ready(function(){

		$.validator.setDefaults({ 
    		ignore: [],
		});

		$.validator.messages.required = "";


		$('form').validate({
			highlight:function(element){
				$(element).parent().parent().find('.error_light').addClass('error');
				$(element).addClass('error');
			},
			unhighlight:function(element){
				$(element).parent().parent().find('.error_light').removeClass('error');
				$(element).removeClass('error');
			},
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				conection('PUT', $('form').serialize(),'/reviews/{{$review->id}}',true).then(function(data){
					if(data.success == 1){
						show_message('success','¡Listo!',data.message,data.redirect);
					}else{
						show_message('error','Error!',data.message);
					}
				
				});
			}
		});
		$("body").on('click', '.submit', function(e) {
			e.preventDefault();
			$('input').each(function() {
  				console.log("se agregp");
		        $(this).rules("add", 
		            {
		                required: true,
		                min: 1,
		            });
		    });
    		$('form').submit();
    		
		});
		

	});
</script>
@endsection
	
		


