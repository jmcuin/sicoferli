@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('HistorialAlumno.update', $historial_alumno -> id_historial_alumno) }}">
	{!! csrf_field() !!}
	{!! method_field('PUT') !!}
	<div class="container">
	    <h1 align="center">Edición de Expediente</h1>
		<div class="col-lg-12 well">
			<div class="row" align="center">
						<div class="col-lg-12">
							<div class="row">
							
							
							
								
									<label for="narrativa">
										Narrativa<br>
										<textarea name="narrativa" id="narrativa" rows="4" cols="50" placeholder="Escriba aquí su narrativa...">{{ $historial_alumno -> narrativa }}</textarea>	
									</label>
									<span class="help-block">
										{{ $errors -> first('narrativa') }}
									</span>
								
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>

	</div>
		<div class="col-lg-12 well">
			<div class="row">
				<div class="form-group pull-right">
					<button type="submit" id="boton_registrar_alumno" class="btn btn-primary">Enviar<i class="fa fa-paper-plane-o ml-2"></i></button>
					<a href="{{ route('Inscripcion.index') }}" class="btn btn-primary">Regresar</a>
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
	textarea {
    	resize: none;
	}
</style>
<script>
	$(document).ready(function(){
		
	});
</script>
@endsection