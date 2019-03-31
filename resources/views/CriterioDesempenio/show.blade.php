@extends('layout')

@section('contenido')
<div class="container">
      <div class="row">
      <div class="col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" >Mostrando...</h3>
            </div>
            <div class="panel-body">
              	<div class="row">
                	<h3 class="panel-title" align="center">
                		{{ $criterioD -> criterio }}<br>
        						{{ $criterioD -> descripcion }}<br>
        						Porcentaje de Examen: {{ $criterioD -> porcentaje_examen }}<br>
                    Porcentaje de Tareas: {{ $criterioD -> porcentaje_tareas }}<br>
                    Porcentaje de Tomas de Clase: {{ $criterioD -> porcentaje_tomas_clase }}<br>
                    Porcentaje de Participaciones: {{ $criterioD -> porcentaje_participaciones }}</h3>
              	</div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('CriterioDesempenio.edit', $criterioD -> id_criterio_desempenio )}}" class="btn btn-primary">Editar</a>
                		</td>
                		<td>
                      <form method="POST" action="{{ route('CriterioDesempenio.destroy', $criterioD -> id_criterio_desempenio )}}">
        								{!! method_field('DELETE') !!}
        							 	{!! csrf_field() !!}
        								<button type="submit" class="btn btn-primary">Eliminar</button>
        							</form>
                		</td>
                		<td>
		           			<div style="width: 285px"></div>
		           		</td>
		           		<td>
		           			<span class="pull-right">
		               			<a href="{{ route('CriterioDesempenio.index') }}" class="btn btn-primary">Regresar</a>
		           			</span>
		           		</td>
                	</tr>
                </table>         
            </div>       
          </div>
        </div>
    </div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
	.panel-heading {
  		background-color: #20193D !important;
	}
	.panel-title {
		color: #D10F20 !important;
	}
</style>
@endsection