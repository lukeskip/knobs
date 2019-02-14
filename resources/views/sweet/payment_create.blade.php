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
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="GKX42794HJEC6">
							<!-- <input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea."> -->
							<button type="submit" class="btn btn-lg btn-block paypal">Pagar con Paypal</button>
							<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
							<input name="notify_url" value="mypage.php" type="hidden">
						</form>
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
