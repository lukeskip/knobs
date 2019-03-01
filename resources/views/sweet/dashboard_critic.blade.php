@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2>Canciones esperando crítica</h2>
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
														
									@if (get_role() == 'critic')
										<a href="/reviews/create/{{$song->id}}" class="btn btn-success">Hacer Crítica</a>
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
	<div class="row">
		<div class="col-md-12 text-center box hidden">
			<a href="/admin/songs" class="btn btn-success">
				Ver todos las canciones
			</a>
		</div>
	</div>

</div>


@endsection