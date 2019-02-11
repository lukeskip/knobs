@extends('layouts.main',['body_class' => 'song-list'])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Tus Knobs</h1>
			
		</div>
	</div>
	<div class="row">
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
									{{$review->songs->author}}
								</span>
							</div>
							<div class="col-sm-4 text-right">
								<div class="btn-group" role="group" aria-label="Basic example">
									<a href="{{$review->knob}}" class="btn btn-secondary hastooltip" title="Ver Knob"><img src="{{asset('img/knob_icon.png')}}" alt=""></a>

									<a href="{{$review->knob_edit}}" class="btn btn-primary hastooltip" title="Editar Knob"><i class="fas fa-edit"></i></a>
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