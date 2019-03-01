@extends('layouts.main',['body_class' => 'review'])

<!-- STARTS: CONTENT -->
@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song-profile {{$review->songs->genre}}">
		@if(get_role() == 'musician')
			<a href="#" data-toggle="modal" data-target="#publicLink" class="share hastooltip left" title="Compartir este Knob">
				<i class="fas fa-share-alt"></i>
			</a>
		@endif
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
					
					<audio src="{{asset('storage/song_files/'.$review->songs->file)}}" controls></audio>
					
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
						<div class="col-md-12">
							<div><h3 class="title">{{$item->categories->label}}</h3></div>
							{{$item->score}}
						</div>
					@endforeach
				</div>
				

			</div>
	</div>
	@if($review->users)
	<div class="container critic-profile">
		<div class="row">
			@if($review->users->profiles)
			<div class="col-md-8">
				<div class="picture" style="background-image: url({{asset('profile_images/'.$review->users->profiles->picture)}})"></div>
				<div class="name">
					{{$review->users->profiles->name}}
				</div>
				<div class="expertice">
					{{$review->users->profiles->expertice}}
				</div>
				<div class="summary">
					{{$review->users->profiles->summary}}
				</div>
			</div>
			@endif
			<div class="col-md-4">
				<h3 class="text-center">Califica este knob</h3>
				<form id="rating" action="">
					<div class="slider-wrapper ">
						<div class="knob"></div>
						<div class="score"></div>
						<div id="rating" @if($review->ratings)data-score="{{$review->ratings->score}}"@endif class="slider"></div>	
					</div>
					<div class="text-center">
						<br>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	@endif
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


<!-- Modal -->
<div class="modal fade" id="publicLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
      	<form id="form_link" action="">
      		<input type="hidden" name="review_id" value="{{$review->id}}">
	      	<div id="link" class="link" data-clipboard-target="#link">
	      		
	      	</div>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button class="btn btn-success" type="submit">
	        	Generar Link Público
	        </button>
        </form>
      </div>
    
    </div>
  </div>
</div>

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

	$(document).on('submit','#form_link',function(e){
		e.preventDefault();
		conection('POST', $(this).serialize(),'/guests',true).then(function(data){
			if(data.success == 1){
				
				$('#publicLink .link').html('{{url()->current()}}?token='+data.token);

			}else{
				show_message('error','Error!',data.message);
			}
		
		});
	});

	var clipboard = new ClipboardJS('.link');
	clipboard.on('success', function(e) {
	    show_message('success','Listo!','El link ha sido copiado a tu portapapales, ahora compártelo con quien quieras',false);

    	e.clearSelection();
	});

	
	
</script>
@endsection
	
		



