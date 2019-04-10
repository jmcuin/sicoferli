@extends('layout')

@section('contenido')
	@if(session('info'))
    	<strong>
    		<div class="alert alert-success alert-dismissable fade in">
       			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
       			{{ session('info') }}
    		</div>
    	</strong>
    @endif
	<h3 align="center">
		Evaluación Grupal<br>
	</h3>
	<h4 align="center">
		{{ $grupo -> escolaridad -> escolaridad }}<br>
		Ciclo Escolar {{ $grupo -> periodo -> periodo }}<br>
		Grupo:{{ $grupo -> grupo}}<br>
	</h4>
	<form method="POST" action="{{ route('Calificacion.store', $grupo -> id_grupo)}}">
	 	{!! csrf_field() !!}
	 	<div class="container">
			<div class="col-lg-12 well">
				<div class="col-sm-16">
					<div class="row" align="center">
						Materias<br>
						<select name="materias" id='selector_materia'>
						<?php $contador_materias = 0;
						?>
							<option value="0">Seleccione una opción</option>
							@foreach($inscripciones as $inscripcion)
								@if($contador_materias < $numero_de_materias)
									<option value="{{ $inscripcion -> materia -> id_materia }}">{{ $inscripcion -> materia -> materia }}</option>
								@endif
								<?php $contador_materias++; ?>
							@endforeach
						</select><br><br>
						<table border="1" class="encabezados">
							<tr>
								<td align="center" rowspan="2" class="materia" style="width: 200px">Alumno</td>
								<td align="center" rowspan="2" class="materia" style="width: 150px">Materia</td>
								<td colspan="9" align="center" class="materia">Bimestre {{$bimestre_secundaria}}</td>
							</tr>
							<tr>
								<td class="criterios" style="width: 70px">Examen</td>
								<td class="criterios" style="width: 70px">Tareas</td>
								<td class="criterios" style="width: 70px">Trabajos</td>
								<td class="criterios" style="width: 70px">Asistencias</td>
								<td class="criterios" style="width: 70px">Puntos Extra</td>
								<td class="criterios" style="width: 70px">Promedio</td>
								<td class="criterios" style="width: 70px">Regularizaciones</td>
								<td class="criterios" style="width: 70px">#Inasistencias</td>
								<td class="criterios" style="width: 70px">Criterio</td>
							</tr>
							<?php $id_alumno = 0;
							$contador = 0; 
							$numero_de_materias = count($inscripciones); ?>
					 		@foreach($inscripciones as $inscripcion)
								<input type="text" name="inscripcion[]" value="{{$inscripcion -> id_inscripcion}}" hidden="hidden">
								<!--<tr>-->
									<!-- aqui iba el codigo de alumno -->
									@if($inscripcion -> alumno -> id_alumno != $id_alumno)
										<!--<td rowspan="3" class="alumno"><div id="{{$inscripcion -> alumno -> id_alumno}}">{{ $inscripcion-> alumno -> nombre}} {{ $inscripcion -> alumno -> a_paterno}} {{ $inscripcion -> alumno -> a_materno}}<img src="/storage/show.png" width="28px" height="24px" class="icono pull-right"></img>
										<img src="/storage/hide.png" width="28px" height="24px" class="icono pull-right" style="display: none;"></img></div></td>-->
									@endif
								<!--</tr>-->
								<tr class="tr_{{$inscripcion -> alumno -> id_alumno}} fm-{{ $inscripcion-> materia -> id_materia }} contenedor" hidden="hidden">
										<td class="alumno" style="width: 180px"><div id="{{$inscripcion -> alumno -> id_alumno}}">{{ $inscripcion -> alumno -> nombre}} {{ $inscripcion -> alumno -> a_paterno}} {{ $inscripcion -> alumno -> a_materno}}</div></td>
										<td class="materia" style="width: 200px">{{ $inscripcion -> materia -> materia}}</td>
										<td align="center"><input type="number" name="examen[]" id="examen_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> examen}}" min="0" max="10" step="0.01"></td>
										<td align="center"><input type="number" name="tareas[]" id="tareas_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> tareas}}" min="0" max="10" step="0.01"></td>
										<td align="center"><input type="number" name="trabajos[]" id="trabajos_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> trabajos}}" min="0" max="10" step="0.01"></td>
										<td align="center"><input type="number" name="asistencias[]" id="asistencias_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> asistencias}}" min="0" max="10" step="0.01"></td>
										<td align="center"><input type="number" name="puntos_extra[]" id="puntos_extra_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> puntos_extra}}" min="0" max="10" step="0.01"></td>
										<td align="center"><input type="number" name="promedio" id="promedio_{{$contador}}" class="ponderado" style="width: 4em"	value="" disabled="disabled"></td>	
										<td align="center"><input type="number" name="examen_extra[]" id="examen_extra_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> examen_extra}}" min="0" max="10" step="0.01"></td>	
										<td align="center"><input type="number" name="numero_inasistencias[]" id="numero_inasistencias_{{$contador}}" class="ponderado" style="width: 4em"
										value="{{$inscripcion -> numero_inasistencias}}" min="0" max="10" step="0.01"></td>
										<td align="center" style="color: #000;">
											<select name="criteriosdesempenio[]" id="selector_criterio_{{$contador}}" class="selector_criterio">
												@foreach($criteriosdesempenio as $criteriodesempenio)
													<option value="{{ $criteriodesempenio -> id_criterio_desempenio }}" @if($inscripcion -> id_criterio_desempenio == $criteriodesempenio -> id_criterio_desempenio) selected="selected" @endif>{{ $criteriodesempenio -> criterio }}</option>	
												@endforeach
											</select>
											@foreach($criteriosdesempenio as $criteriodesempenio)
												@if($inscripcion -> id_criterio_desempenio == $criteriodesempenio -> id_criterio_desempenio)
													<input type="number" name="porcentaje_examen[]" id="porcentaje_examen_{{$contador}}" value="{{ $inscripcion -> criterioDesempenio -> porcentaje_examen }}" hidden="hidden">
													<input type="number" name="porcentaje_tareas[]" id="porcentaje_tareas_{{$contador}}" value="{{ $inscripcion -> criterioDesempenio -> porcentaje_tareas }}" hidden="hidden">
													<input type="number" name="porcentaje_tomas_clase[]" id="porcentaje_tomas_clase_{{$contador}}" value="{{ $inscripcion -> criterioDesempenio -> porcentaje_tomas_clase }}" hidden="hidden">
													<input type="number" name="porcentaje_participacion[]" id="porcentaje_participacion_{{$contador}}" value="{{ $inscripcion -> criterioDesempenio -> porcentaje_participacion }}" hidden="hidden">
												 @elseif($inscripcion -> id_criterio_desempenio == null)
												 	<input type="number" name="porcentaje_examen[]" id="porcentaje_examen_{{$contador}}" value="{{ $criteriodesempenio -> porcentaje_examen }}" hidden="hidden">
													<input type="number" name="porcentaje_tareas[]" id="porcentaje_tareas_{{$contador}}" value="{{ $criteriodesempenio -> porcentaje_tareas }}" hidden="hidden">
													<input type="number" name="porcentaje_tomas_clase[]" id="porcentaje_tomas_clase_{{$contador}}" value="{{ $criteriodesempenio -> porcentaje_tomas_clase }}" hidden="hidden">
													<input type="number" name="porcentaje_participacion[]" id="porcentaje_participacion_{{$contador}}" value="{{ $criteriodesempenio -> porcentaje_participacion }}" hidden="hidden">
												 @endif
											@endforeach
										</td>
								</tr>	
									@php 
										$id_alumno = $inscripcion -> alumno -> id_alumno;
										$contador++;
									@endphp
							@endforeach
						</table>
						<input type="text" id="numero_de_registros" value="{{ $contador }}" hidden="hidden">
					</div>
					<div class="row">
						<div class="form-group pull-right">
							<br>
							<button type="submit" class="btn btn-primary">Guardar</button>
							<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary">Regresar</a>
						</div>
					</div>
				</div>
			</div>
		</div>				
	</form>

<script type="text/javascript"> 
	$( document ).ready(function() {
    	calificar();
	});

	$('#selector_materia').on('change', function(e){
		$('.contenedor').hide();
		$('.'+'fm-'+e.target.value).show();
	});

	$('.ponderado').keyup(function() {
		calificar();
	});

    $('.selector_criterio').on('change', function(e){
		id = e.target.id;
		id_ = id.split('_');
		$.get('/ajax-getCriterio?id_criterio_desempenio='+e.target.value, function(data){
			$.each(data, function(create, criterio){
				$('#porcentaje_examen_'+id_[2]).val(criterio.porcentaje_examen);
				$('#porcentaje_tareas_'+id_[2]).val(criterio.porcentaje_tareas);
				$('#porcentaje_tomas_clase_'+id_[2]).val(criterio.porcentaje_tomas_clase);
    			$('#porcentaje_participacion_'+id_[2]).val(criterio.porcentaje_participacion);
    			calificar();
			});
		});
	});

	function calificar(){
		$(function(){
			var promedio = 0.0;
			var registros = parseInt($('#numero_de_registros').val());
			for(i = 0; i < registros; i ++){
				if(parseFloat($('#examen_extra_'+i).val()) == 0){
					promedio = (parseFloat($('#examen_'+i).val())*(parseFloat($('#porcentaje_examen_'+i).val())/100)
						+ parseFloat($('#tareas_'+i).val())*(parseFloat($('#porcentaje_tareas_'+i).val())/100)
						+ parseFloat($('#trabajos_'+i).val())*(parseFloat($('#porcentaje_tomas_clase_'+i).val())/100)
						+ parseFloat($('#asistencias_'+i).val())*(parseFloat($('#porcentaje_participacion_'+i).val())/100)
						+ parseFloat($('#puntos_extra_'+i).val())
					);
				}else{
					if(parseFloat($('#examen_extra_'+i).val()) > 10)
						promedio = 10;
					else
						promedio = $('#examen_extra_'+i).val();
				}
				if(promedio > 10){
					$('#promedio_'+i).val(10);
				}else if(promedio < 6){
					$('#promedio_'+i).val(5);
				}else{
					$('#promedio_'+i).val(promedio);
				}
				if(promedio<6.0){
					$('#promedio_'+i).closest('tr').find('.materia').css({"background-color": "#c94c4c"});
				}else{
					$('#promedio_'+i).closest('tr').find('.materia').css({"background-color": ""});
				}
			}
		});
	}
</script>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.encabezado{
		width: 12px;
		font-weight: bold;
		text-align: center;
	}
	.criterios{
		font-size: small;
		width: 15px;
		font-weight: bold;
		text-align: center;
	}
	.alumno{
		font-size: medium;
		font-weight: bold;
		text-align: center;
	}
	.materia{
		width: 15px;
		font-size: medium;
		font-weight: bold;
		margin: 0 auto;
	}
	table{
		border-collapse: separate;
    	border-width:2px;
    	border-spacing: 6px 6px;  
	}
	td{
		border-width:2px; 
	}
	.encabezados{
		background-color:#20193D;
		color: #fff;
	}
	input{
		color: #20193D;
	}
</style>
<script>
	$(".icono").click(function(){
		var clase = $(this).closest("div").prop("id");
		clase = ".tr_"+clase;
		$(clase).toggle("100000");
		$(this).find('image').toggle();
	});
</script>
@endsection