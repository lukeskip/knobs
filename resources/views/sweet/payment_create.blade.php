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
								 
							</div>
							<div class="col-sm-4 text-center">
								<span class="price">
									$300 MXN
								</span> 
							</div>
						</div>
					</li>
				</ul>
				
				
				<div class="row">	
					<div class="col-md-6">
						<form id="oxxo-form" action="/oxxo" method="POST">
							{{ csrf_field() }}
					
							
							<input type="hidden" name="song_id" value="{{$song->id}}">

							
							<button type="submit" class="oxxo_button btn btn-success btn-lg btn-block oxxo">Pagar en Oxxo</button>
						</form>
						
					</div>
					<div class="col-md-6">
						<!-- <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="XXX">
    <input type="hidden" name="lc" value="CA">
    <input type="hidden" name="item_name" value="Tangled Roots">
    <input type="hidden" name="button_subtype" value="services">
    <input type="hidden" name="no_note" value="0">
    <input type="hidden" name="cn" value="Add special instructions to the seller">
    <input type="hidden" name="no_shipping" value="2">
    <input name="amount" value="16.99">
    <input type="hidden" name="currency_code" value="CAD">
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form> -->

		<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post'>


		<input type='hidden' name='business' value='contacto-facilitator@chekogarcia.com.mx'>


		<input type='hidden' name='cmd' value='_xclick'>


		<input type='hidden' name='item_name' value='Hot Sauce-12 oz. Bottle'>
		<input type='hidden' name='amount' value='5.95'>
		<input type='hidden' name='currency_code' value='MXN'>
		<input name="notify_url" value="https://knobs.reydecibel.com.mx" type="hidden">

		<input type="hidden" name="return" value="https://knobs.reydecibel.com.mx">
<input type="hidden" name="notify_url" value="https://knobs.reydecibel.com.mx/confirmed_paypal">



		<input type='image' name='submit' border='0' src='https://www.paypal.com/en_US/i/btn/btn_buynow_LG.gif' alt='PayPal – The safer, easier way to pay online'>
		<img alt='' border='0' width='1' height='1' src='https://www.paypal.com/en_US/i/scr/pixel.gif' >

		</form>



Read more: http://designertuts.com/adding-an-advanced-paypal-buy-now-button.php#ixzz5fciVS8uH




						
					</div>
				</div>
			<div class="col-md-6">

				
				</div>
						
					
				



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
