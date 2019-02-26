@extends('layouts.no_menu',['body_class' => 'landing'])
@section('content')
<div class="first_level">
	<div class="content-centered">
		<h1>Tu música puede ser mejor</h1>
		<p>Todos los artistas tienen momentos en los que no saben si lo que hacen les gusta, necesitan un  guía, deja que Knobs te guía</p>
		<a href="" class="btn btn-primary">
			Registra tu primera canción
		</a>
	</div>
	
</div>
@endsection
@section('scripts')

@endsection

@section('scripts')
<script>
	$(document).ready(function() {
    	$('.content-centered').flexVerticalCenter();
  	});
</script>
@endsection