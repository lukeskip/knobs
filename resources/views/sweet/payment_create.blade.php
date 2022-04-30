@extends('layouts.main',['body_class' => 'checkout'])

@section('styles')
<link rel="stylesheet" href="{{asset('/css/profiles.css')}}">
@endsection
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
									<div class="profiles-list horizontal">
										<div class="item profile" data-id="{{$song->profiles()->first()->id}}">
											<h3 class="text-center">{{$song->profiles->first()->name}}</h3>
											<img class="image" src="{{$song->profiles->first()->image_url}}" alt="">
											<h4 class="text-center">{{$song->profiles->first()->expertice}} / {{$song->profiles()->first()->genre}} </h4>
											<div class="pricing">
												Costo: ${{$song->profiles->first()->pricing}}
											</div>
											<p class="summary">
												{{$song->profiles->first()->summary_limited}}
											</p>
										</div>
									</div>

									<div class="detail">
											1 Knob de Carlos Vera para {{$song->title}}
									</div>
									@if(isset($discount) && $discount > 0)
										<div class="old-price">
											${{$song->profiles->first()->pricing}} MXN									
										</div>
										<div class="price">
											descuento aplicado: ${{$price}} MXN									
										</div>
									@else
										<div class="price">
											${{$price}} MXN									
										</div>
									@endif
								 
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
					<div class="col-md-6">
						<button  class="oxxo_button btn btn-success btn-lg btn-block oxxo" data-toggle="modal" data-target="#oxxo-modal">Pagar en Oxxo</button>
						
					</div>
					<div class="col-md-6">
						

						<form target="_blank" action='{{get_option("paypal_action")}}' method='post'>

							
							<input type='hidden' name='business' value='{{get_option("paypal_mail")}}'>


							<input type='hidden' name='cmd' value='_xclick'>


							<input type='hidden' name='item_name' value='Knobs: Knob de un experto en música'>
							
							
							<input type='hidden' name='amount' value="{{$price}}">	
							
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
