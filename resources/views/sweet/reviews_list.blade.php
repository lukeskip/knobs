@extends('layouts.main',['body_class' => 'song-list'])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>{{$title}}</h1>
			
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
									@if($review->status == 'publish')
										<a href="#" class="btn btn-success hastooltip" title="Estatus Publicado"><i class="fas fa-check-circle  paid" ></i></a>
									@elseif($review->status == 'revision')
										<a href="#" class=" hastooltip btn btn-success" title="Estatus: En Revisión"><i class="fas fa-clock  pending" ></i></a>
									@elseif($review->status == 'draft')
										<a href="#" class=" hastooltip btn btn-success" title="Estatus en Borrador"><i class="fas fa-clock  pending" ></i></a>
									@elseif($review->status == 'rejected')
										<a href="#" class="btn btn-success hastooltip" title="Tu crítica fue rechazada"><i class="fas fa-times-circle expired "  ></i></a>
									@endif
									<a href="{{$review->knob}}" class="btn btn-success hastooltip" title="Ver Knob"><img src="{{asset('img/knob_icon.png')}}" alt=""></a>
									
									@if(get_role()== 'admin' || ($review->status == 'rejected' || $review->status == 'draft'))
										<a href="{{$review->knob_edit}}" class="btn btn-success hastooltip" title="Editar Knob"><i class="fas fa-edit"></i></a>
									@endif
								</div>
								
					  		</div>
						</div>
					</li>
				  @endforeach
				@else
					<li class="list-group-item clearfix song-item">
						<span class="title">
							No hay críticas registradas
						</span>
					</li>
				@endif
			  
			</ul>
		</div>
	</div>
</div>





@endsection