@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h2>Cupones</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="{{route('coupons.create')}}" class="btn btn-success btn-large">Crear Cupón</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<ul class="list-group">
				@if($coupons->count() > 0)
					@foreach($coupons as $coupon)
					<li class="list-group-item clearfix song-item">
						<div class="row">
							<div class="col-sm-8">
								<span class="song-name title">
									{{$coupon->label}} ({{$coupon->code}})
									
								</span>
								<span class="author">
                                    {{$coupon->discount}}%
								</span>
								<span class="">
                                    {{$coupon->starts}} /
								</span>
								<span class="">
                                    {{$coupon->ends}}
								</span>
                                <span class="author">
                                    {{$coupon->limit}} de {{$coupon->redeemed}}
								</span>
								
							</div>
							
							<div class="col-md-4 text-right">
							<form action="{{route('coupons.destroy',$coupon->id)}}" method="POST">
								@csrf
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-success btn-small"> Eliminar</button>
							</form>
							</div>
							
						</div>
					</li>
				  @endforeach
				@else
					<li class="list-group-item clearfix song-item">
						<span class="title">
							No hay cupones registrados
						</span>
					</li>
				@endif
			  
			</ul>
		</div>
	</div>
	
	
	

</div>


@endsection