@extends('layouts.main',['body_class' => 'dashboard'])

@section('content')


<div class=" first-level">
	<div class="container">
		
		<div class="row">
			<div class="col-md-12">
				<ul class="list-group">
					@if($profiles)
						@foreach($profiles as $profile)
						<li class="list-group-item clearfix song-item">
							<div class="row">
								<div class="col-sm-8">
									<span class="song-name title">
										{{$profile->name}} {{$profile->status}}
									</span>
									<span class="author">
										{{$profile->genre}}
									</span>
								</div>
								<div class="col-sm-4 text-right">
									<form class="status-form" method="POST" action="{{route('update-status',$profile->id)}}">
										@csrf
										<select class="status" name="status" id="">
											<option @if($profile->status == 'pending') selected @endif value="pending">Pendiente</option>
											<option @if($profile->status == 'approved') selected @endif value="approved">Aprobado</option>
											<option  @if($profile->status == 'rejected') selected @endif value="rejected" value="rejected">Rechazado</option>
										</select>
									</form>
									
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
</div>






@endsection

@section('scripts')
<script>
	$('.status').on('change',function(){
		$(this).closest('.status-form').submit();
	});
</script>
@endsection