@extends('layouts.main',['body_class' => 'review'])

@section('content')

	<!-- <img src="{{asset('img/logo_rey.png')}}" alt="" class="logo d-lg-block" width="150"> -->
	<div class="song_profile">
		<div class="container ">
			<div class="row ">
				<div class="col-md-8">
					<h1>{{$review->songs->title}}</h1>
					<h2 class="author">{{$review->songs->author}}</h2>
					<p>{{$review->songs->description}}</p>
					
					<a href="{{$review->songs->link}}" class="btn btn-success btn-lg" target="blank">
						{!! html_entity_decode($review->icon) !!} 
						Reproducir
					</a>
					
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
	








	
@section('variables')
<script>
	mode = 'show';
</script>
@endsection

@section('knobs')
<script src="{{asset('/js/knobs.js')}}"></script>
@endsection
	
		



@endsection