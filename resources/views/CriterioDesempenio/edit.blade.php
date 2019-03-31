@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('CriterioDesempenio.update', $criterioD -> id_criterio_desempenio)}}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Criterio de Desempeño</h1>
		<div class="col-lg-12 well">
			<div class="row" align="center">
				<div class="col-sm-4">
					<label for="criterio">
						Criterio
						<input type="text" name="criterio" value="{{ $criterioD -> criterio }}" class="form-control" placeholder="Nombre del criterio">
						{{ $errors -> first('criterio') }}
					</label>
				</div>
				<div class="col-sm-8">
					<label for="descripcion">
						Descripción
						<textarea name="descripcion" class="form-control" placeholder="Descripción del criterio" cols="60">{{ $criterioD -> descripcion }}</textarea>
						{{ $errors -> first('descripcion') }}
					</label>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-sm-4">
					<label for="porcentaje_examen">
						Porcentaje de Examen
						<input type="text" name="porcentaje_examen" value="{{ $criterioD -> porcentaje_examen }}" class="form-control" placeholder="Porcentaje de examen">
						{{ $errors -> first('porcentaje_examen') }}
					</label>
				</div>
				<div class="col-sm-4">
					<label for="porcentaje_tareas">
						Porcentaje de Tareas
						<input type="text" name="porcentaje_tareas" value="{{ $criterioD -> porcentaje_tareas }}" class="form-control" placeholder="Porcentaje de tareas">
						{{ $errors -> first('porcentaje_tareas') }}
					</label>
				</div>
				<div class="col-sm-4">
					<label for="porcentaje_tomas_clase">
						Porcentaje de Toma de Clase
						<input type="text" name="porcentaje_tomas_clase" value="{{ $criterioD -> porcentaje_tomas_clase }}" class="form-control" placeholder="Porcentaje de tomas de clase">
						{{ $errors -> first('porcentaje_tomas_clase') }}
					</label>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-sm-4">
					<label for="porcentaje_participacion">
						Porcentaje de Participaciones
						<input type="text" name="porcentaje_participacion" value="{{ $criterioD -> porcentaje_participacion }}" class="form-control" placeholder="Porcentaje de participacion">
						{{ $errors -> first('porcentaje_participacion') }}
					</label>
				</div>
			</div>
		</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<input type="submit" value="Enviar" class="btn btn-primary">
					<a href="{{ route('CriterioDesempenio.index') }}" class="btn btn-primary">Regresar</a>
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