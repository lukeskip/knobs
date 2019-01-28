@extends('layouts.main',['body_class' => 'song-list'])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group list-group-flush">
			  <li class="list-group-item">
			  	<div class="song-name">
			  		El hipster del 8
			  	</div>
			  	<div class="knobs">
			  		<div class="slider-wrapper small">
			  			<div class="knob"></div>
			  			<div class="slider small"></div>
			  		</div>
			  	</div>
			  </li>
			  <li class="list-group-item">Dapibus ac facilisis in</li>
			  <li class="list-group-item">Morbi leo risus</li>
			  <li class="list-group-item">Porta ac consectetur ac</li>
			  <li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</div>
	</div>
</div>



@endsection