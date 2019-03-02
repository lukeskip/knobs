@extends('layouts.mail')
@section('image')
<br><br>
<h1><img src="{{asset('img/logo_mail.png')}}" alt="Knobs"></h1>
@endsection

@section('content')
	
	@if(isset($data['title']))
		<h1>{{$data['title']}}</h1>
	@endif
	<br><br>
	
	@if(isset($data['message']))
		<p>{{$data['message']}}</p>
	@endif
	<br>
	<br>
	<p>
		
		@if(isset($data['link']))
		<a href="{{url('/').$data['link']}}" style="background: #2FAB31;color:white;padding: 15px; text-align: center; border-radius: 10px; text-decoration: none;font-size: 20px;">
				Para ver tu recibo haz click aquí
		</a>
		@endif

	</p>


@endsection