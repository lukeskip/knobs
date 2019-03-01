@extends('layouts.main',['body_class' => 'error_404'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">
				No estás autorizado aquí
			</h1>
			<h2 class="text-center">Sólo sigue buscando</h2>
			<p class="text-center special-font" style="font-size: 5em;">
				403
			</p>
		</div>
	</div>
</div>
@endsection