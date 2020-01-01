@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
    <form action="{{route('coupons.store')}}" method="post" class="dark">
	<div class="row">
		<div class="col-md-12">
			<h1>Registrar nuevo cupón</h1>
		</div>
        
            {{csrf_field()}}
            <div class="col-md-12">
                <label for="" class="title">Label</label>
                <input type="text" name="label" class="label form-control">
                
                @if ($errors->has('label'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('label') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="" class="title">Código</label>
                <input type="text" name="code" class="code form-control">
                
                @if ($errors->has('code'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="" class="title">Descuento</label>
                <input type="number" name="discount" class="discount form-control">
                @if ($errors->has('discount'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('discount') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="" class="title">Válido a partir de:</label>
                <input type="date" name="starts" class="starts form-control">
                @if ($errors->has('starts'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('starts') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="" class="title">Válido hasta:</label>
                <input type="date" name="ends" class="ends form-control">
                @if ($errors->has('ends'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('ends') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="" class="title">Limite:</label>
                <input type="number" name="limit" class="limit form-control">
                @if ($errors->has('limit'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('limit') }}</strong>
                    </span>
                @endif
            </div>

            <div class="col-md-12">
                <button class="btn btn-lg btn-success">
                    Guardar
                </button>
            </div>

        
		
		
	</div>
    </form>
</div>




@endsection