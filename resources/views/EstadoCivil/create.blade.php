@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('EstadoCivil.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Estado Civil</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="estado_civil">
						Estado Civil
						<input type="text" name="estado_civil" value="{{old('estado_civil')}}" class="form-control" placeholder="soltero, casado, etc...">
						{{ $errors -> first('estado_civil') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Guardar" class="btn btn-primary">
					<a href="{{ route('EstadoCivil.index') }}" class="btn btn-primary">Regresar</a>
				</div>
			</div>
		</div>
	</div>
</form>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
</style>
@endsection
