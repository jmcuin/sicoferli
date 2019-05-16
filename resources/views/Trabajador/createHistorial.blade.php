@extends('layout')

@section('contenido')
<form method="POST" action="{{ route('storeHistorial') }}">
	{!! csrf_field() !!}
	<div class="container">
	    <h1 align="center">Registro de Expediente</h1>
	    <input type="text" name="id_grupo" value="{{ $grupo -> id_grupo }}" hidden="hidden">
		<div class="col-lg-12 well">
			<div class="row" align="center">
			<table class='tabla_narrativa'>
				<tr id="narrativa">
					<td>
						<button class="delete_narrativa pull-right" hidden="hidden" style="background-color: #20193D; color: white">X</button>
						<input type="text" name="narrativa_oculto[]" id="narrativa_oculto" class="oculto" value="0" hidden="hidden">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-sm-6 form-group">
								<div class="input-group">
									<label for="id_estado_municipio">
									Alumno<br>
									<select name="id_alumno[]" id="id_alumno">
										@foreach($alumnos as $alumno)
											<option value="{{ $alumno -> id_alumno }}" @if(old('id_alumno') == $alumno -> id_alumno ) selected @endif>{{ $alumno -> nombre }} {{ $alumno -> a_paterno }} {{ $alumno -> a_materno }}	
											</option>	
										@endforeach
									</select>
									</label>
								</div>
								@if ($errors->has('id_alumno.*'))
								    {{ $errors->first('id_alumno.*') }}
								@endif 
								</div>
							
								<div class="col-sm-6 form-group"> 
									<label for="narrativa">
										Narrativa<br>
										<textarea name="narrativa[]" id="narrativa" rows="4" cols="50" placeholder="Escriba aquí su narrativa...">{{ old('narrativa[]') }}</textarea>	
									</label>
									<span class="help-block">
										@if ($errors->has('narrativa.*'))
										    {{ $errors->first('narrativa.*') }}
										@endif
									</span>
								</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="col-sm-4 form-group pull-right">
			<a id="boton_narrativa" class="btn btn-primary">Agregar Narrativa</a>
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
		$('#boton_narrativa').click(function() {
			var $tableBody = $('.tabla_narrativa').find("tbody"),
			$trLast = $tableBody.find("tr:last"),
			$auxvalor = $tableBody.find("tr:last .oculto").val();
			$trNew = $trLast.clone(true);
			$trNew.find(".oculto").attr("value", (Number($auxvalor)+1));
			$trNew.find(".delete_narrativa").show();
			$trNew.find(".delete_narrativa").attr("id", "delete-"+(Number($auxvalor)+1));
			$trLast.after($trNew);
		});

		$('.delete_narrativa').click(function(event) {
			event.preventDefault();
			$(this).closest('tr').remove();
		});
	});
</script>
@endsection