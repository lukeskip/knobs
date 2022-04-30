@extends('layouts.main',['body_class' => 'not_available'])

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center">
				Esta página aún no está habilitada
			</h1>
			<h2 class="text-center">Regresa pronto.</h2>
            <p class="text-center">
                <a class="btn btn-success" href="{{ url()->previous() }}">Regresar</a>
            </p>
		</div>
	</div>
</div>
@endsection