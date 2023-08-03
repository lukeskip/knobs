@extends('layouts.mail')
@section('image')
<br><br>
<h1><img src="{{asset('img/logo_mail.png')}}" alt="Knobs"></h1>
@endsection

@section('content')
	
	@if(isset($title))
	<h1>{{$title}}</h1>
	@endif
	<br><br>

	@if(isset($message_str))
	<p>{{$message_str}}</p>
	@endif
	<br>
	<br>
	<p>
		
		@if(isset($link))
		<a href="{{$link}}" style="background: #2FAB31;color:white;padding: 15px; text-align: center; border-radius: 10px; text-decoration: none;font-size: 20px;">
				@if(isset($link_label))
					{{$link_label}}	
				@endif
		</a>
		@endif

	</p>


@endsection