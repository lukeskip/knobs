@extends('layouts.main',['body_class' => 'checkout'])

@section('content')

<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Finaliza tu compra</h1>
				<div class="owl-carousel owl-theme">
				    <div class="item">
						<h2 class="text-center handwriting" style="color:white">Este es el dinero que mejor has invertido en tu banda</h2>
						
					</div>
					<div class="item">
						<h2 class="text-center handwriting" style="color:white">Es mejor que comprar 5 cafés en Starbucks</h2>
					</div>
					<div class="item">
						<h2 class="text-center handwriting" style="color:white">Mejor que invitar a tu novi@ al cine</h2>
					</div>
					<div class="item">
						<h2 class="text-center handwriting" style="color:white">Mejor que ir al bar de moda el viernes</h2>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				
				<ul class="list-group">
				
					<li class="list-group-item  clearfix song-item">
						<div class="row">
							<div class="col-sm-8">
									<div class="detail">
											1 Knob de un experto para {{$song->title}}
									</div>
									<div class="price">
									@if(\Session::has('discount_final'))
										${{ Session::get('discount_final')}} MXN	
									@else
										${{$options->where("slug","price")->first()->value}} MXN
										
									@endif

										
										
									</div> 
								 
							</div>
							
							<div class="col-md-4">
								<h3>¿Tienes un cupón de descuento?</h3>
								<form action="{{route('redeem')}}" method="POST" class="dark">
									{{csrf_field()}}
									<input class="form-control" type="text" name="code" placeholder="Código de cupón">
									<button type="submit" class="btn btn-success btn-lg">Redimir Cupón</button>
								</form>
							</div>
						</div>
					</li>
				</ul>
				
				<div class="row">
					
				</div>
				<div class="row">	
					<!-- <div class="col-md-6">
						<button  class="oxxo_button btn btn-success btn-lg btn-block oxxo" data-toggle="modal" data-target="#oxxo-modal">Pagar en Oxxo</button>
						
					</div> -->
					<div class="col-md-6">
						

						<form target="_blank" action='{{$options->where("slug","paypal_action")->first()->value}}' method='post'>

							
							<input type='hidden' name='business' value='{{$options->where("slug","paypal_mail")->first()->value}}'>


							<input type='hidden' name='cmd' value='_xclick'>


							<input type='hidden' name='item_name' value='Knobs: Knob de un experto en música'>
							
							
							@if(\Session::has('discount_final'))
								<input type='hidden' name='amount' value="{{ Session::get('discount_final')}}">	
							@else
								<input type='hidden' name='amount' value='{{$options->where("slug","price")->first()->value}}'>
							@endif
							
							<input type='hidden' name='currency_code' value='MXN'>

							<input type="hidden" name="item_number" value="{{$song->id}}-{{$user_id}}">
							<input type="hidden" name="custom" value="{{Session::get('coupon_id')}}">
							
							<input type="hidden" name="return" value="https://knobs.reydecibel.com.mx/songs">
							<input type="hidden" name="notify_url" value="https://knobs.reydecibel.com.mx/confirmed_paypal">

							<button class="btn btn-success btn-lg btn-block paypal">Pagar con Paypal</button>

						</form>
			
					</div>
				</div>
			
						
					
				



			</div>
		</div>
		
	</form>
</div>

<!-- Modal Phone Number -->
<div class="modal fade" id="oxxo-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<form id="oxxo-form" action="/oxxo" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        
							{{ csrf_field() }}
					
			<label class="handwriting">Número Telefónico</label>
			<input type="text" name="phone" class="form-control ">
			<input type="hidden" name="song_id" value="{{$song->id}}">
			<br>
			<div class="text-right">
				<button type="button" class="btn btn-secondary btn" data-dismiss="modal">Cancelar</button>
	        	<button type="submit" class="oxxo_button btn btn-success oxxo">Generar Orden de Pago</button>
			</div>
			
			
		
      </div>
     
    </div>
  </div>
  </form>
</div>
<!-- Modal Phone Number -->

@endsection

@section('scripts')
<script>
	
	$('#oxxo-form').validate({
			rules:{
				phone : {
					required :true,
					rangelength: [10, 10],
					digits: true
				}
			},
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que escribir un número telefónico a 10 digitos');
			},
			submitHandler: function(form) {
				
				form.submit();
					
			}
	});

	$('.oxxo-modal').modal('show');

	$('.owl-carousel').owlCarousel({
    	loop:true,
    	margin:10,
    	nav:false,
    	items:1,
    	autoplay:true,
    	autoplayTimeout:5000
	});
</script>


@endsection
