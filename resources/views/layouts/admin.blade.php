<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Promociona tu música</title>
	<link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/menu/menu.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/owl-carousel/assets/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/swal/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>

	<meta property="og:url" content="http://playlist.reydecibel.com.mx/" />
	<meta property="og:title" content="Incluye tu musica en las Playlists de Rey Decibel" />
	<meta property="og:description" content="En sólo 3 clicks agrega tu música a las playlists en Spotify de Rey Decibel" />
	<meta property="og:image" content="{{asset('img/facebook_ok.png')}}" />

</head>
<body>
	@if(!Auth::guest())
	<div id='cssmenu'>
	<ul>
	   <li><a href='/admin'>Dashboard</a></li>
	   <li><a href='/admin/canciones'>Todas las canciones</a></li>
	   <!-- <li><a href='#'>Administradores</a></li>
	   <li><a href='#'>Estadísticas</a></li> -->
	</ul>
	</div>
	@endif
	<div class="container">
		@yield('content')
	</div>
	
	@if(!Auth::guest())
	<script>
		var provider_token =  "{{Auth::user()->accounts()->where('provider_name','spotify')->first()->provider_token}}";
	</script>
	@endif
	
	

	<script src="{{asset('/js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/plugins/menu/menu.js')}}"></script>
	<script src="{{asset('/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('/plugins/spotify-web-api-js-master/src/spotify-web-api.js')}}"></script>
	<script src="{{asset('/plugins/swal/sweetalert2.all.min.js')}}"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
	@if(!Auth::guest())
	<script type="text/javascript">
		var user_id = "{{Auth::user()->id}}";
	</script>
	@endif
	<script type="text/javascript">
		var user_id = 1;
	</script>
	<script type="text/javascript">
		var APP_URL = {!! json_encode(url('/')) !!}
	</script>
	<script src="{{asset('/js/admin.js')}}"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132667323-1"></script>
	

</body>
</html>