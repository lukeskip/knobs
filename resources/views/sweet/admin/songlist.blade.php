@extends('layouts.admin')
@section('content')
<section class="row">
	<div class="col-md-12">
		<br>
		<h1>{{$title}}</h1>
	</div>
</section>
@if($songs->count() > 0)
<section class="row">
	<div class="col-md-12">
		<ul class="list-group">
			@foreach($songs as $song) 
				<li class="list-group-item">
					<span class="check">
						<div class="btn add_list" data-song_id="{{$song->id}}" data-remove="@if($song->in_playlist > 0 )0 @else 1 @endif">
							<a href="#"  class="btn btn-primary btn-sm" role="button" aria-pressed="true">
								+
							</a> 
						</div>
					</span>
					<a class="link" target="_blank" href="{{$song->link}}">{{$song->label}} @if($song->in_playlist > 0 )({{($song->in_playlist)}}) @endif</a>
					
				</li>
			@endforeach
		</ul>
		<div class="pagination">
			{!! $songs->appends(Request::capture()->except('page'))->render() !!}
		</div>
	</div>
</section>
@else
<section class="row">
	<div class="col-md-12">
		<ul class="list-group">
			<li class="list-group-item" style="color:#666666">
				No hay canciones nuevas que revisar		
			</li>
			
		</ul>
	</div>
</section>
@endif

@endsection