@extends('layouts.main',['body_class' => 'admin'])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Usuarios Registrados</h1>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="" method="GET">
			<div class="status-group unbalanced">
				
					<input type="text" name="s" class="form-control group-item">
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
				@if($users->count() > 0)
					@foreach($users as $user)
					<li class="list-group-item clearfix song-item">
						<div class="row">
							<div class="col-sm-8">
								<span class="song-name title">
									{{$user->name}}
								</span>
								<span class="author">
									{{$user->email}}
								</span>
							</div>
							<div class="col-sm-4 text-right">
								<form class="ajax" action="/admin/users/role">
									<input type="hidden" name="user_id" value="{{$user->id}}">
									<div class="status-group">
										<select name="role" required id="" class="form-control group-item">
										@foreach($roles as $role)
											<option @if($user->roles->first()->name == $role->name)selected @endif value="{{$role->id}}">{{$role->name}}</option>
										@endforeach
										</select>
										<button class="btn btn-success group-item submit">Guardar Rol</button>
									</div>
								</form>
								
								
								
					  		</div>
						</div>
					</li>
				  @endforeach
				@else
					<li class="list-group-item clearfix song-item">
						<span class="title">
							No hay registros que mostrar
						</span>
					</li>
				@endif
			  
			</ul>
		</div>
	</div>
</div>





@endsection

@section('scripts')
<script>
	$(document).ready(function(){
		$( ".ajax" ).on( "submit", function(e){
			e.preventDefault();
			conection('POST', $(this).serialize(),$(this).attr('action'),true).then(function(data){
				if(data.success == 1){
					show_message('success','¡Listo!',data.message,data.redirect);
				}else{
					show_message('error','Error!',data.message);
				}

			});
		});
	});
	
</script>
@endsection