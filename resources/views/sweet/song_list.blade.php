@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Canciones Registradas</h1>
		</div>
	</div>
	@if($songs->count() > 5)
	<div class="row">
		<div class="col-md-12">
			<form action="" method="GET">
			<div class="status-group unbalanced">
				
					<input type="text" name="s" class="form-control group-item">
					<button class="btn btn-success group-item submit">
						Buscar
					</button>
				
			</div>
			</form>
		</div>
	</div>
	@endif
	
	@if(get_role() == 'musician')
	<div class="row">
		<div class="col-md-12">
			<p>
	  			Una vez que el estatus de tus pagos esté completado, un productor revisará tu canción. Posteriormente un icono aparecerá a lado de tu canción para que puedas ver la opinión del productor, recuerda que el proceso puede llevar 48 hrs. Para mayor información revisa nuestros <a href="/terms">Términos y condiciones.</a>
			</p>	
		</div>
	</div>
		
	@endif
	
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
									
									<a href="/songs/{{$song->id}}/edit" class="btn btn-success hastooltip" title="Edita los datos de tu canción	"><i class="fas fa-edit"></i></a>
									<a href="/reviews/create/{{$song->id}}" class="btn btn-success hastooltip" title="Hacer una crítica"><i class="fas fa-edit"></i></a>
									<a href="/reviews/create/{{$song->id}}" class="btn btn-success hastooltip" title="Hacer una crítica"><i class="fas fa-edit"></i></a>
								
									
								</div>
								
					  		</div>
						</div>
					</li>
				  @endforeach
				@else
					@if(get_role() != 'musician' )
						<li class="list-group-item clearfix song-item">
							<span class="title">
								No hay canciones registradas
							</span>
						</li>
					@else
						<li class="list-group-item clearfix song-item">
							
							<a href="/songs/create" class="btn btn-success btn-lg">Registra tu primera canción</a>
							
						</li>
					@endif
				@endif
			  
			</ul>
		</div>
	</div>
</div>





@endsection