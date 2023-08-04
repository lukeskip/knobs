@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class=" first-level">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Pagos de esta semana</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="total">Total ganancias: <span class="number">{{$total}}</span></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					@if($payments->count() > 0)
						@foreach($payments as $payment)
						<li class="list-group-item clearfix song-item">
							<div class="row">
								<div class="col-sm-8">
									<span class="song-name title">
										{{$payment->order_id}}
									</span>
									<span class="author">
										${{$payment->total}} (${{get_share('admin',$payment->method,$payment->total)}})
									</span>
								</div>
								<div class="col-sm-4 text-right">
									{{$payment->created_at}}
						  		</div>
							</div>
						</li>
					  @endforeach
					@else
						<li class="list-group-item clearfix song-item">
							<span class="title">
								No hay pagos registrados
							</span>
						</li>
					@endif
				  
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center box hidden">
				<a href="/admin/payments" class="btn btn-success">
					Ver todos los pagos
				</a>
			</div>
		</div>
	</div>
</div>


<div id="first-level level" class="second-level">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Críticas esperando Autorización</h2>
			</div>
			<div class="col-md-12">

				<ul class="list-group">
					@if($reviews->count() > 0)
						@foreach($reviews as $review)
						<li class="list-group-item clearfix song-item">
							<div class="row">
								<div class="col-sm-8">
									<span class="song-name title">
										{{$review->songs->title}}
									</span>
									<span class="author">
										{{$review->users->name}}
									</span>
								</div>
								<div class="col-sm-4 text-right">
									<a href="/reviews/{{$review->token}}/edit" class="btn btn-success hastooltip" title="Revisar y editar">
										<i class="fas fa-edit"></i>
									</a>
						  		</div>
							</div>
						</li>
					  @endforeach
					@else
						<li class="list-group-item clearfix song-item text-center">
							<span class="title">
								No hay críticas registradas
							</span>
						</li>
					@endif
				  
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="third-level">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Canciones Pagadas esperando crítica</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					@if($songs->count() > 0)
						@foreach($songs as $song)
						<li class="list-group-item clearfix song-item">
						<div class="row">
							<div class="col-sm-8">
								<span class="song-name title">
									{{$song->title}}
								</span>
								<span class="author">
									{{$song->author}}
								</span>
							</div>
							<div class="col-sm-4 text-right">
								
								<div class="btn-group" role="group" >
									
									@if($song->payments)
										@if($song->payments->status == 'paid' || $song->payments->status == 'completed' || $song->payments->status == 'processed')
											<a href="/payments/{{$song->payments->order_id}}" class="btn btn-success hastooltip" title="Estatus pagado"><i class="fas fa-check-circle  paid" ></i></a>
										@elseif($song->payments->status == 'pending')
											<a href="/payments/{{$song->payments->order_id}}" class=" hastooltip btn btn-success" title="Pago pendiente"><i class="fas fa-clock  pending" ></i></a>
										@elseif($song->payments->status == 'expired')
											<a href="/payments/create/{{$song->id}}" class="btn btn-success hastooltip" title="Pago expirado, da click para generar una nueva forma de pago"><i class="fas fa-times-circle expired "  ></i></a>
										@endif
									@else
										<a href="/payments/create/{{$song->id}}" class=" hastooltip btn btn-success" title="Pago pendiente"><i class="fas fa-clock  pending" ></i></a>
									@endif
									
									@if(isset($song->knob))
										<a href="{{$song->knob}}" class="btn btn-secondary hastooltip" title="Ver Knob"><img src="{{asset('img/knob_icon.png')}}" alt=""></a>
									@endif
									
									 @if($song->reviews)
									 <a href="/reviews/{{$song->reviews->token}}/edit" class="btn btn-success hastooltip" title="Editar Crítica"><i class="fas fa-edit"></i></a>
									 @else
									 <a href="/reviews/create/{{$song->id}}" class="btn btn-success hastooltip" title="Hacer una crítica"><i class="fas fa-plus-circle"></i></a>
									 @endif
										
			
								</div>
								
					  		</div>
						</div>
						</li>
					  @endforeach
					@else
						<li class="list-group-item clearfix song-item text-center">
							<span class="title">
								No hay canciones registradas
							</span>
						</li>
					@endif
				  
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center box hidden">
				<a href="/admin/songs" class="btn btn-success">
					Ver todos las canciones
				</a>
			</div>
		</div>
	</div>
</div>



@endsection