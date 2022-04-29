<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">
	<title>Que dice un experto de tu música</title>
	<link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/owl-carousel/assets/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/swal/sweetalert2.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/jquery_ui/jquery-ui.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/jquery_ui/jquery-ui.structure.min.css')}}">
	<link rel="stylesheet" href="{{asset('/plugins/round_slider/roundslider.min.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	@yield('styles')
	<link rel="stylesheet" href="{{asset('/plugins/menu/menu.css')}}">
	<link rel="stylesheet" href="{{asset('./css/app.css')}}">
	
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>

	<meta property="og:url" content="http://playlist.reydecibel.com.mx/" />
	<meta property="og:title" content="Incluye tu musica en las Playlists de Rey Decibel" />
	<meta property="og:description" content="En sólo 3 clicks agrega tu música a las playlists en Spotify de Rey Decibel" />
	<meta property="og:image" content="{{asset('img/facebook_ok.png')}}" />

</head>
<body class="{{ !empty($body_class) ? $body_class : '' }}">
	@yield('logo')
	<div class="loader">
		<div class="loader_icon">
			<img src="{{asset('img/loader.svg')}}" alt="">
		</div>
	</div>

	@include('layouts.template_parts.menu')
	
	<div class="content">
		
		@yield('content')

	</div>
		
	
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					Todos los derechos reservados, 2020. Idea Creativa, Diseño y Desarrollo por Rey Decibel. <a href="/terms" target="_blank">Terminos y condiciones</a> y <a href="/notice_privacy" target="_blank">Aviso de privacidad</a>
				</div>
			</div>
		</div>
		
	</footer>

	<script src="{{asset('/js/jquery-3.3.1.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('/plugins/spotify-web-api-js-master/src/spotify-web-api.js')}}"></script>
	<script src="{{asset('/plugins/swal/sweetalert2.all.min.js')}}"></script>
	<script src="{{asset('/plugins/jquery_ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('/plugins/round_slider/roundslider.min.js')}}"></script>
	<script src="{{asset('/plugins/copytoclipboard/clipboard.min.js')}}"></script>
	<script async src="https://www.youtube.com/iframe_api"></script>
	<script src="{{asset('plugins/videoback/src/jquery.youtubebackground.js')}}"></script>

	@yield('variables')
	
	@if(!Auth::guest())
	<script type="text/javascript">
		let user_id = "{{Auth::user()->id}}";
		let role = "{{get_role()}}";
	</script>
	@endif

	<script type="text/javascript">
		let APP_URL = {!! json_encode(url('/')) !!}
	</script>
	<script src="{{asset('/plugins/menu/menu.js')}}"></script>
	<script src="{{asset('/js/app.js')}}"></script>
	@yield('knobs')
	@yield('scripts')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156447738-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-156447738-1');
	</script>


	

</body>
</html>