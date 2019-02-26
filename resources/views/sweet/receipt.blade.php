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
											1 Knob de un experto para {{$song->title}}
									</div>
								 
							</div>
							<div class="col-sm-4 text-center">
								<span class="price">
									${{$options->where("slug","price")->first()->value}} MXN
								</span> 
							</div>
						</div>
					</li>
				</ul>

				<div class="row">
					@if($payment->method == 'oxxo' && $payment->status == 'pending')
					<div class="col-md-12">
						
						<div class="alert alert-light" role="alert">
							<h3>Tu código de OxxoPay es</h3>
							<div class="order_id">
								{{$payment->order_id}}
							</div>
							<div class="instructions">
								Acude a tu tienda oxxo más cercana, pide un pago OxxoPay y proporciona este número.
							</div>

						</div>
						
					
					</div>
				@endif
				</div>
				
				@if(!$payment->finish)
				<div class="row">
					<div class="col-md-12 columns">
						<div class="alert alert-primary" role="alert">
  							Si deseas cambiar tu forma de pago u obtener un nuevo código para pago en oxxo da click en el botón correspondiente
						</div>
						
					</div>
				</div>
				
				<div class="row">	
					<div class="col-md-6">
						<form id="oxxo-form" action="/oxxo" method="POST">
							{{ csrf_field() }}
					
							
							<input type="hidden" name="song_id" value="{{$song->id}}">

							
							<button type="submit" class="oxxo_button btn btn-success btn-lg btn-block oxxo">Pagar en Oxxo</button>
						</form>
						
					</div>
					<div class="col-md-6">
						

						<form action='{{$options->where("slug","paypal_action")->first()->value}}' method='post'>


							<input type='hidden' name='business' value='{{$options->where("slug","paypal_mail")->first()->value}}'>


							<input type='hidden' name='cmd' value='_xclick'>


							<input type='hidden' name='item_name' value='Knobs: Knob de un experto en música'>
							<input type='hidden' name='amount' value='{{$options->where("slug","price")->first()->value}}'>
							<input type='hidden' name='currency_code' value='MXN'>

							<input type="hidden" name="item_number" value="{{$song->id}}-{{$user_id}}">
							
							<input type="hidden" name="return" value="https://knobs.reydecibel.com.mx">
							<input type="hidden" name="notify_url" value="https://knobs.reydecibel.com.mx/confirmed_paypal">

							<button class="btn btn-success btn-lg btn-block paypal">Pagar con Paypal</button>

						</form>
			
					</div>
				</div>
				@endif

			</div>
			

		</div>
		
	</form>
</div>


@endsection

@section('scripts')
<script>
	$('.oxxo-form').click(function(e){
		e.preventDefault();
		$('form').submit();
	});

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
