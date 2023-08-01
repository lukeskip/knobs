@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Configuración General</h1>
		</div>
	</div>
	
		<form action="{{ route('options.store') }}" method="POST">
			{{ csrf_field() }}
			<div class="row">
			@foreach($options as $option)

				@if($option->type == 'text' || $option->type== 'number' || $option->type== 'email')
					<div class="col-md-4">
						<label>{{$option->label}} <i class="fa fa-question-circle hastooltip" title="{{$option->description}}" aria-hidden="true"></i></label>
						<input class="input-group-field form-control" name="{{$option->slug}}" type="{{$option->type}}" value="{{$option->value}}">
					</div>
				
				@elseif ($option->type == 'select')
				<div class="col-md-4">
					<label>{{$option->label}} <i class="fa fa-question-circle hastooltip" title="{{$option->description}}" aria-hidden="true"></i></label>
					<select class="form-control" name="{{$option->slug}}" id="">

						@for ($i = 0; $i < count($option->labels); $i++)
								<option @if($option->value == $option->options[$i]) selected @endif value="{{$option->options[$i]}}">
									{{$option->labels[$i]}}
								</option>
							@endfor
						</select>
					</div>
					@endif
			@endforeach
			</div>
			<div class="row">

				<div class="col-md-12">
					<br>
					<button class="btn btn-lg btn-success" type="submit">
						Guardar
					</button>
				</div>
			</div>
		</form>
		
</div>




@endsection