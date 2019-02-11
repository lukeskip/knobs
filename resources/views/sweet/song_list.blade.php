@extends('layouts.main',['body_class' => 'song-list'])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Canciones Registradas</h1>
			@if(Auth::user()->roles->first()->name != 'critic')
				<a href="/songs/create" class="btn btn-success submit">
				<i class="fas fa-plus-circle"></i>
			Registrar Canción</a>
			@endif
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
									<a href="{{$song->knob}}" class="btn btn-secondary hastooltip" title="Ver Knob"><img src="{{asset('img/knob_icon.png')}}" alt=""></a>
									@if(Auth::user()->roles->first()->name == 'musician' OR Auth::user()->roles->first()->name== 'admin')
									<a href="/songs/{{$song->id}}/edit" class="btn btn-primary"><i class="fas fa-edit"></i></a>
									@elseif (Auth::user()->roles->first()->name == 'critic')
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