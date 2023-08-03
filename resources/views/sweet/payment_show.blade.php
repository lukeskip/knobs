@extends('layouts.main',['body_class' => 'receipt'])

@section('content')

<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">{{$title}}</h1>
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
											1 Knob de un experto para {{$payment->songs->title}}
									</div>
								 
							</div>
							<div class="col-sm-4 text-center">
								<span class="price">
									${{$payment->amount}} MXN
								</span> 
							</div>
						</div>
					</li>
				</ul>

				@if($payment->method == 'oxxo' && $payment->status == 'pending')
				<div class="row">
					
					<div class="col-md-12">
						@if(!$expired)
						<div class="alert alert-light" role="alert">
							<h3>Tu código de OxxoPay es</h3>
							<div class="order_id">
								{{$payment->reference_show}}
							</div>
							<div class="instructions">
								Acude a tu tienda oxxo más cercana, pide un pago OxxoPay y proporciona este número.
							</div>
							<div class="clarification">
								Esta orden de pago vence {{$expiration}}, si expira tendrás que generar otra.
							</div>

						</div>
						@else
						<div class="alert alert-light" role="alert">
							<h3>Tu código de OxxoPay expiró</h3>
							
							<div class="instructions">
								Genera una nueva dando click en "Pagar en Oxxo" o cambia la forma de pago a Paypal.
							</div>
							
						</div>
						@endif
						
					
					</div>
				
				</div>
				@endif
				
				@if(!$payment->finish)
				<div class="row">
					<div class="col-md-12 columns">
						<div class="alert alert-light" role="alert">
  							Si deseas cambiar tu forma de pago u obtener un nuevo código para pago en oxxo da click en el botón correspondiente.
							<br><br>
			  				<div class="row">	
								<div class="col-md-6">
									<button @if(!$expired) disabled @endif class="oxxo_button btn btn-success btn-lg btn-block oxxo" data-toggle="modal" data-target="#oxxo-modal">Pagar en Oxxo</button>
									
								</div>
								<div class="col-md-6">
									

									<form action='{{$options->where("slug","paypal_action")->first()->value}}' method='post'>


										<input type='hidden' name='business' value='{{$options->where("slug","paypal_mail")->first()->value}}'>


										<input type='hidden' name='cmd' value='_xclick'>


										<input type='hidden' name='item_name' value='Knobs: Knob de un experto en música'>
										<input type='hidden' name='amount' value='{{$payment->amount}}'>
										<input type='hidden' name='currency_code' value='MXN'>

										<input type="hidden" name="order_id" value="{{$payment->order_id}}">
										
										<input type="hidden" name="return" value="https://knobs.reydecibel.com.mx/payments/{{$payment->order_id}}">
										<input type="hidden" name="notify_url" value="https://knobs.reydecibel.com.mx/confirmed_paypal?p={{$payment->order_id}}">

										<button class="btn btn-success btn-lg btn-block paypal">Pagar con Paypal</button>

									</form>
						
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				
				@endif

			</div>
			

		</div>
		
	</form>
</div>


<!-- Modal Phone Number -->
<div class="modal fade" id="oxxo-modal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<form id="oxxo-form" action="/oxxo?p={{$payment->order_id}}" method="POST">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        
							{{ csrf_field() }}
					
			<label class="title">Número Telefónico</label>
			<input type="text" name="phone" class="form-control ">
			<input type="hidden" name="song_id" value="{{$payment->songs->id}}">
			<br>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        	<button type="submit" class="oxxo_button btn btn-success oxxo">Generar Orden de Pago</button>
			
		
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
					minlength:10
				}
			},
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','que escribir un numero telefonico a 10 digitos');
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
