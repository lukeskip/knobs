@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2>Pagos</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="" method="GET">
			<div class="status-group unbalanced">
				
					<input type="text" name="s" class="form-control group-item" placeholder="Busca por id de orden">
					<button class="btn btn-success group-item submit">
						Buscar
					</button>
				
			</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
				@if($payments->count() > 0)
					@foreach($payments as $payment)
					<li class="list-group-item clearfix song-item">
						<div class="row">
							<div class="col-sm-8">
								<span class="song-name title">
									{{$payment->songs->title}}
									
								</span>
								<span class="author">
									{{$payment->partner}}
								</span>
								<span class="order-id">
									{{$payment->order_id}}
								</span>
								<span class="subtotal">
									${{$payment->total}}
								</span>
								
							</div>
							<div class="col-sm-4 text-right">
								{{$payment->created_at}}
					  		</div>
							<div class="col-md-12 text-right">
								{{$payment->status}}
							</div>
							
						</div>
					</li>
				  @endforeach
				@else
					<li class="list-group-item clearfix song-item">
						<span class="title">
							No hay pagos registrados
						</span>
					</li>
				@endif
			  
			</ul>
		</div>
	</div>
	
	
	

</div>


@endsection