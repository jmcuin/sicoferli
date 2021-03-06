@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('Materia.store') }}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Materia</h1>
		<div class="col-lg-12 well">
			<div class="col-sm-12">
				<div class="row" align="center">
					<label for="materia">
						Materia
						<input type="text" name="materia" value="{{old('materia')}}" class="form-control" placeholder="Español, matemáticas, etc...">
						{{ $errors -> first('materia') }}
					</label>
				</div>
			</div>
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('Materia.index') }}" class="btn btn-primary">Regresar</a>
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