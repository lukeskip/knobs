@extends('layouts.main',['body_class' => 'song-list'])

@section('content')

<div class="container">
	<form action="">
		<div class="row">
			<div class="col-md-12">
				<h1>Paga en una tienda oxxo</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p>Tendrás horas para liquidar el pago</p>

				<div class="oxxo method">
					<form id="oxxo-form" action="/oxxo" method="POST">
						{{ csrf_field() }}
					

						<input type="hidden" name="amount" class="amount" value="">

						
						<input name="name" type="hidden" size="20" value="" class="form-control">
						
						<label for="">Teléfono</label>
						<input name="phone" type="text" size="20" value="" class="form-control">
							
						
						<input name="email" type="hidden" size="20" value="" class="form-control">
						<div class="text-center">
							<br>
							<button type="submit" class="oxxo_button btn btn-success btn-lg">Generar Línea de Captura</button>
						</div>
						
					</form>
				</div>
			</div>
		</div>
		
	</form>
</div>





@endsection