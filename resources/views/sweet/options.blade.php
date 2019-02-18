@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Configuración General</h1>
			<form action="/options/" method="POST">
				{{ csrf_field() }}
				@foreach($options as $option)

					@if($option->type == 'text' or $option->type== 'number')
						<div class="col-md-6">
							<label>{{$option->label}} <i class="fa fa-question-circle hastooltip" title="{{$option->description}}" aria-hidden="true"></i></label>
							<input class="input-group-field" name="{{$option->slug}}" type="{{$option->type}}" value="{{$option->value}}">
						</div>
					@elseif ($option->type == 'select')
					<div class="col-md-6">
						<label>{{$option->label}} <i class="fa fa-question-circle hastooltip" title="{{$option->description}}" aria-hidden="true"></i></label>
						<select name="{{$option->slug}}" id="">

							@for ($i = 0; $i < count($option->labels); $i++)
									<option @if($option->value == $setting->options[$i]) selected @endif value="{{$setting->options[$i]}}">
										{{$setting->labels[$i]}}
									</option>
								@endfor
							</select>
						</div>
						@endif
				@endforeach
				<div class="col-md-12">
					<button class="btn btn-lg btn-success" type="submit">
						Guardar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>




@endsection