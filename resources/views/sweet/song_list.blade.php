@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Canciones Registradas</h1>
			@if(get_role() == 'musician')
				<a href="/songs/create" class="btn btn-success submit">
				<i class="fas fa-plus-circle"></i>
			Registrar Canción</a>
			@endif
		</div>
	</div>
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
								
								<div class="btn-group" role="group" aria-label="Basic example">
								
								@if($song->payments)
									@if($song->payments->status == 'paid')
										<a href="/payments/{{$song->payments->id}}" class="btn btn-success hastooltip" title="Estatus pagado"><i class="fas fa-check-circle  paid" ></i></a>
									@elseif($song->payments->status == 'pending')
										<a href="/payments/{{$song->payments->id}}" class=" hastooltip btn btn-success" title="Pago pendiente"><i class="fas fa-clock  pending" ></i></a>
									@elseif($song->payments->status == 'expired')
										<a href="/payments/create/{{$song->id}}" class="btn btn-success hastooltip" title="Pago expirado, da click para generar una nueva forma de pago"><i class="fas fa-times-circle expired "  ></i></a>
									@endif
								@endif
									
									@if(isset($song->knob))
									<a href="{{$song->knob}}" class="btn btn-secondary hastooltip" title="Ver Knob"><img src="{{asset('img/knob_icon.png')}}" alt=""></a>
									@endif
									@if(get_role() == 'musician' OR get_role() == 'admin')
									<a href="/songs/{{$song->id}}/edit" class="btn btn-success"><i class="fas fa-edit"></i></a>
									@elseif (get_role() == 'critic')
									<a href="/reviews/create/{{$song->id}}" class="btn btn-primary hastooltip" title="Hacer una crítica"><i class="fas fa-edit"></i></a>
									@endif
								</div>
								
					  		</div>
						</div>
					</li>
				  @endforeach
				@else
					<li class="list-group-item clearfix song-item">
						<span class="title">
							No hay canciones registradas
						</span>
					</li>
				@endif
			  
			</ul>
		</div>
	</div>
</div>





@endsection