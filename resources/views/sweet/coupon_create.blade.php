@extends('layouts.main',['body_class' => ''])

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Registrar nuevo cupón</h1>
		</div>
        <form action="{{route('coupons.store')}}" method="post">
            {{csrf_field()}}
            <div class="col-md-12">
                <label for="">Label</label>
                <input type="text" name="label" class="label">
                
                @if ($errors->has('label'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('label') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="">Código</label>
                <input type="text" name="code" class="code">
                
                @if ($errors->has('code'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="">Descuento</label>
                <input type="number" name="discount" class="discount">
                @if ($errors->has('discount'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('discount') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="">Válido a partir de:</label>
                <input type="date" name="starts" class="starts">
                @if ($errors->has('starts'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('starts') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="">Válido hasta:</label>
                <input type="date" name="ends" class="ends">
                @if ($errors->has('ends'))
                    <span class="error" role="alert">
                        <strong>{{ $errors->first('ends') }}</strong>
                    </span>
                @endif
            </div>
            <div class="col-md-12">
                <label for="">Limite:</label>
                <input type="number" name="limit" class="limit">
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

        </form>
		
		
	</div>
</div>




@endsection