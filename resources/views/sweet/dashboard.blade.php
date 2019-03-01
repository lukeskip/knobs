@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2>Últimos Pagos</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="total">Total a repartir esta semana: <span class="number">{{$total}}</span></div>
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
									${{$payment->total}}
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

	<div class="row">
		<div class="col-md-12">
			<h2>CCríticas esperando Autorización</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
				@if($reviews)
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
								<a href="/reviews/{{$review->id}}/edit" class="btn btn-success hastooltip" title="Revisar y editar">
									<i class="fas fa-edit"></i>
								</a>
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
									${{$song->author}}
								</span>
							</div>
							<div class="col-sm-4 text-right">
								{{$song->created_at}}
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


@endsection