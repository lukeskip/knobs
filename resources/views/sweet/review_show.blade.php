@extends('layouts.main',['body_class' => 'review'])

<!-- STARTS: CONTENT -->
@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song-profile {{$review->songs->genre}}">
		<div class="container ">
			<div class="row ">
				<div class="col-md-8">

					@if($review->admin_comments && $review->status!= 'publish')
						@foreach($review->admin_comments as $comment)
							<div class="alert alert-danger admin-comment" role="alert">
							  {{$comment->description}}
							  <div class="date">
							  	{{$comment->create_at}}
							  </div>
							</div>
						@endforeach
					@endif
					<h1>{{$review->songs->title}}</h1>
					<h2 class="author">{{$review->songs->author}}</h2>
					<p>{{$review->songs->description}}</p>
					
					<a href="{{$review->songs->link}}" class="btn btn-success btn-lg" target="blank">
						{!! html_entity_decode($review->icon) !!} 
						Reproducir
					</a>

					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ratingModal">
					  Launch demo modal
					</button>
					
				</div>
				<div class="col-md-4 rating">
					
				</div>
				
			</div>

		</div>
	</div>
	<div class="knobs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>
						Tus Knobs
					</h2>
					<p>El crítico calificó en base 10 varios aspectos de tu canción, toma en cuenta que estos aspectos son primordialmente técnicos y que su intención es la de ayudarte a lograr la mejor versión de esta rola.</p>
				</div>
			</div>
			<div class="row">
				@foreach($knobs as $knob)
					<div class="@if($knob->categories->importance == 1) col-md-6 @else col-md-4 @endif">
						<div class="knob_item">
							<div class="slider-wrapper @if($knob->categories->importance == 1) big @endif">
								<div class="knob"></div>
								<div class="score"></div>
								<div id="{{$knob->categories->slug}}" data-score="{{$knob->score}}" class="slider disable @if($knob->categories->importance == 1) big @endif"></div>	
							</div>
							<div class="title">{{$knob->categories->label}}</div>
						</div>
					</div>
				@endforeach
				
				
			</div>
		</div>
	</div>
	<div class="form-items">
			<div class="container ">
				<div class="row">
					<div class="col-md-12">
						<h2 class="text-center">
							El crítico opina...
						</h2>
					</div>
				</div>
				<div class="row">
					@foreach($form_items as $item)
						<div class="@if($item->categories->importance == 1) col-md-12 @elseif($item->categories->importance == 2) col-md-6 @else col-md-4 @endif">
							<div><h3 class="title">{{$item->categories->label}}</h3></div>
							{{$item->score}}
						</div>
					@endforeach
				</div>
				

			</div>
	</div>
	<div class="comments">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>Comentarios</h2>
					<form id="comment_form" action="">
						<label for="">
							Deja un comentario
						</label>
						<textarea name="description" id="" cols="30" rows="10"></textarea>
						<input type="hidden" name="review_id" value="{{$review->id}}">
						<div class="text-right"><button type="submit" class="btn btn-success btn-lg">Enviar</button></div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 comments-list">
					@foreach($review->comments as $comment)
					<div class="comments-item">
						<div class="author title">
							{{$comment->users->name}}
						</div>
						<div class="description">
							{{$comment->description}}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>

<!-- STARTS: MODAL -->
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form id="rating" action="">
  		<input type="hidden" name="review_id" value="{{$review->id}}">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-body knobs">
			
			
			<h3 class="text-center">Califica este knob</h3>
			
				<div class="slider-wrapper ">
					<div class="knob"></div>
					<div class="score"></div>
					<div id="rating" @if($review->ratings)data-score="{{$review->ratings->score}}"@endif class="slider"></div>	
				</div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Guardar</button>
		  </div>
		</div>
	  </div>
  </form>
</div>
<!-- ENDS: MODAL -->

@endsection
<!-- ENDS: CONTENT -->





	
@section('variables')
<script>
	mode = 'show';
</script>
@endsection

@section('knobs')
<script src="{{asset('/js/knobs.js')}}"></script>
@endsection

@section('scripts')
<script>
	$(document).on('submit','#comment_form',function(e){
		e.preventDefault();
		if($('#comment_form').find('textarea').val() != ''){
			conection('POST', $(this).serialize(),'/comments',true).then(function(data){
				if(data.success == 1){
					$('.comments-list').prepend('<div class="comments-item"><div class="author title">'+data.user+'</div><div class="description">'+data.description+'</div></div>')
					show_message('success','¡Listo!',data.message,data.redirect);
					$('#comment_form').find('textarea').val('');

				}else{
					show_message('error','Error!',data.message);
				}
			
			});	
		}
		
	});

	$(document).on('submit','#rating',function(e){
		e.preventDefault();
		conection('POST', $(this).serialize(),'/ratings',true).then(function(data){
			if(data.success == 1){
				$('#ratingModal').modal('hide');
				show_message('success','¡Listo!',data.message,data.redirect);

			}else{
				show_message('error','Error!',data.message);
			}
		
		});
	});
	
</script>
@endsection
	
		



