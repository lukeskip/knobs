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
	<link rel="stylesheet" href="{{asset('/plugins/menu/menu.css')}}">
	@yield('styles')
	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" type="favicon/png" href="{{asset('img/favicon.png')}}"/>

	<meta property="og:url" content="http://playlist.reydecibel.com.mx/" />
	<meta property="og:title" content="Incluye tu musica en las Playlists de Rey Decibel" />
	<meta property="og:description" content="En sólo 3 clicks agrega tu música a las playlists en Spotify de Rey Decibel" />
	<meta property="og:image" content="{{asset('img/facebook_ok.png')}}" />

</head>
<body class="fixed {{ !empty($body_class) ? $body_class : '' }}">
	@yield('logo')
	<div class="loader">
		<div class="loader_icon">
			<img src="{{asset('img/loader.svg')}}" alt="">
		</div>
	</div>

	<!-- STARTS: MENU  -->
	<header>
		<div id='cssmenu' >
			<ul>
				<li><a href='/'>Knobs</a></li>
				@if(Auth::guest())
					<li><a href='/register'>Regístrate</a></li>
					<li><a href='/login'>Entrar</a></li>
				@endif
				
				@yield('menu-items-first')

				<!-- STARTS: MENU FOR ADMIN -->
				@if(get_role() == 'admin')

					<li><a href='/admin/dashboard'>Dashboard</a></li>
					<li><a href='/admin/options'>Opciones</a></li>
					<li><a href='/admin/users'>Usuarios</a></li>
					<li><a href='/admin/songs'>Canciones registradas</a></li>
					<li><a href='/admin/payments'>Pagos</a></li>
					<li><a href='/admin/payments/users'>Pagos a Usuarios</a></li>
					<li><a href='/log-viewer' target="_blank">Errores</a></li>
					
					<!-- <li><a href='#'>Administradores</a></li>
					<li><a href='#'>Estadísticas</a></li> -->
					
				@endif
				<!-- ENDS: MENU FOR ADMIN -->

				<!-- STARTS: MENU FOR CRITIC -->
				@if(get_role() == 'critic')
				
					@if(Auth::user()->profiles)
						<li>
							<a href='/profiles/{{Auth::user()->profiles->id}}/edit'/>
							Perfil
							</a>
						</li>
					@endif
					<li><a href='/critic/dashboard'>Dashboard</a></li>
					<li><a href='/reviews'>Mis Knobs</a></li>
						   
				@endif
				<!-- ENDS: MENU FOR ADMIN -->
			
				<!-- STARTS: MENU FOR MUSICIAN -->
				@if(get_role() == 'musician')
						
					<li><a href='/songs/create'>Registrar Canción</a></li>
					<li><a href='/songs'>Mis canciones</a></li>
					
				@endif
				<!-- ENDS: MENU FOR ADMIN -->

				@yield('menu-items-last')

				@if(!Auth::guest())
					<li><a href='/logout'>Salir</a></li>
				@endif
			</ul>
		</div>
		<div class="addition"></div>
	</header>
	<!-- ENDS: MENU FOR ADMIN -->
	
	<div class="content">
		
		@yield('content')

	</div>
		
	
	<footer>
		<div class="row">
			<div class="col-md-12">
				Todos los derechos reservados, 2018. Idea Creativa, Diseño y Desarrollo por Malechor Lab. <a href="/terms" target="_blank">Terminos y condiciones</a> y <a href="/notice_privacy" target="_blank">Aviso de privacidad</a>
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
		var user_id = "{{Auth::user()->id}}";
		var role = "{{get_role()}}";
	</script>
	@endif
	<script type="text/javascript">
		
		var APP_URL = {!! json_encode(url('/')) !!}
	</script>
	<script src="{{asset('/plugins/menu/menu.js')}}"></script>
	<script src="{{asset('/js/app.js')}}"></script>
	@yield('knobs')
	@yield('scripts')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132667323-1"></script>

	

</body>
</html>