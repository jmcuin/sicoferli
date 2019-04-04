@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('CriterioDesempenio.store')}}">
	 {!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Criterios de Desempeño</h1>
		<div class="col-lg-12 well">
			<div class="row" align="center">
				<div class="col-sm-4">
					<label for="criterio">
						Criterio
						<input type="text" name="criterio" value="{{old('criterio')}}" class="form-control" placeholder="Nombre del criterio">
						{{ $errors -> first('criterio') }}
					</label>
				</div>
				<div class="col-sm-8">
					<label for="descripcion">
						Descripción
						<textarea name="descripcion" class="form-control" placeholder="Descripción del criterio" cols="60">{{old('descripcion')}}</textarea>
						{{ $errors -> first('descripcion') }}
					</label>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-sm-6">
					<label for="porcentaje_examen">
						Porcentaje de Examen
						<input type="number" name="porcentaje_examen" id="porcentaje_examen" value="{{old('porcentaje_examen')}}" class="form-control criterios" placeholder="Porcentaje de examen" min="0" max="100">
						{{ $errors -> first('porcentaje_examen') }}
					</label>
				</div>
				<div class="col-sm-6">
					<label for="porcentaje_tareas">
						Porcentaje de Tareas
						<input type="number" name="porcentaje_tareas" id="porcentaje_tareas" value="{{old('porcentaje_tareas')}}" class="form-control criterios" placeholder="Porcentaje de tareas" min="0" max="100">
						{{ $errors -> first('porcentaje_tareas') }}
					</label>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-sm-6">
					<label for="porcentaje_tomas_clase">
						Porcentaje de Toma de Clase
						<input type="number" name="porcentaje_tomas_clase" id="porcentaje_tomas_clase" value="{{old('porcentaje_tomas_clase')}}" class="form-control criterios" placeholder="Porcentaje de tomas de clase" min="0" max="100">
						{{ $errors -> first('porcentaje_tomas_clase') }}
					</label>
				</div>
				<div class="col-sm-6">
					<label for="porcentaje_participacion">
						Porcentaje de Participaciones
						<input type="number" name="porcentaje_participacion" id="porcentaje_participacion" value="{{old('porcentaje_participacion')}}" class="form-control criterios" placeholder="Porcentaje de participacion" min="0" max="100">
						{{ $errors -> first('porcentaje_participacion') }}
					</label>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-sm-12">
					<span id="mensaje" style="font-weight: bolder;"></span>
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
<script type="text/javascript"> 
	$('.criterios').focusout(function() {
		total = 0; 
		total = parseInt($('#porcentaje_examen').val())+parseInt($('#porcentaje_tareas').val())+parseInt($('#porcentaje_tomas_clase').val())+parseInt($('#porcentaje_participacion').val());
		if(total != 100)
			$('#mensaje').text("Atención, la suma de los porcentajes es: "+total);
		else
			$('#mensaje').text("Todo en orden, la suma de los porcentajes es: "+total);
	});
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	input[type="text"] {
    	width: 300px;
	}
</style>
@endsection