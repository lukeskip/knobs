@extends('layouts.main',['body_class' => 'song-list'])


@section('content')
	<div class="checkout">
		
		<div class="content row no-margin">
			<div class="large-8 columns no-padding">
				<h3>Respuesta del intento de pago</h3>
				
<li>{{dd($response)}}</li>

			
			
			
			</div>
			
			
		</div>
	
	</div>

@endsection
