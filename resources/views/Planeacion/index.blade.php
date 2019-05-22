@extends('layout')

@section('contenido')
		<div class="col-sm-8" style="overflow: auto;"> 
		<h1>
			Catálogo de Planeaciones
			@if( auth() -> user() -> hasRoles(['profesor']) )
				<a href="{{ route('PlaneacionAnual') }}" class="btn btn-primary pull-right">Nuevo Plan Anual</a>
				<a href="{{ route('Planeacion.create') }}" class="btn btn-primary pull-right">Nueva Planeación</a>
			@endif
			@if( auth() -> user() -> hasRoles(['direccion_general','administracion_sitio']) )
				<a href="{{ route('PlaneacionEstad', 5)}}" class="btn btn-primary pull-right">Estadísticas</a>
			@endif
		</h1>
		<br>
		@if (session('info'))
    		<strong>
    			<div class="alert alert-success alert-dismissable fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			{{ session('info') }}
    			</div>
    		</strong>
    	@endif
    	@if (session('error'))
    		<strong>
    			<div class="alert alert-danger alert-dismissable fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			{{ session('error') }}
    			</div>
    		</strong>
    	@endif
    	{!! Form::open(['method'=>'GET','url'=>'Planeacion','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaPeriodo">
			<thead>
				<tr>
					<th>
						@sortablelink('id_planeacion')
					</th>
					<th>
						@sortablelink('id_trabajador')
					</th>
					<th>
						Grupo
					</th>
					<th>
						Semana
					</th>
					<th>
						Comentarios
					</th>
					<th>
						Creado el
					</th>
					<th>
						Enviado el
					</th>
					<th>
						Semáforo
					</th>
					<th>
						Anexos
					</th>
					<th>
						Propuestas
					</th>
					<th colspan="3">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($planeaciones -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($planeaciones as $planeacion)
						@if($planeacion -> nuevo == 1)
						<tr style="font-weight: bolder !important; background-color: #98fb98 !important;">
						@else
						<tr>
						@endif
							<td>
								{{ $planeacion -> id_planeacion }}
							</td>
							<td>
								{{ $planeacion -> propietario -> nombre }}
							</td>
							<td>
								{{ $planeacion -> grupo -> grupo }}
							</td>
	                        <td>
	                        	@if($planeacion -> anual == 1) 
	                        		Anual 
	                        	@else 
	                        		{{ $planeacion -> semana }} 
	                        	@endif
	                        </td>
							<td>
								{{ $planeacion -> comentarios }}
							</td>
							<td>
								{{ $planeacion -> created_at }}
							</td>
							<td>
								{{ $planeacion -> enviado_el }}
							</td>
							<td align="center">
								@if($planeacion -> semaforo === 'Verde')
									<div style="width: 20px; background-color: green; height: 20px;"></div>
								@elseif($planeacion -> semaforo === 'Amarillo')
									<div style="width: 20px; background-color: yellow; height: 20px;"></div>
								@elseif($planeacion -> semaforo === 'Rojo')
									<div style="width: 20px; background-color: red; height: 20px;"></div>
								@elseif($planeacion -> semaforo === 'Morado')
									<div style="width: 20px; background-color: purple; height: 20px;"></div>
								@else
									<div style="width: 20px; background-color: gray; height: 20px;"></div>
								@endif
							</td>
							<td>
								{{count($planeacion -> anexos )}}
							</td>
							<td>
								{{count($planeacion -> propuestas )}}
							</td>
							<td>
								<a href="{{ route('Planeacion.show', $planeacion -> id_planeacion) }}" class="btn btn-primary">Ver</a>
							</td>
							@if( auth() -> user() -> hasRoles(['profesor']) )
								<td>
									@if( $planeacion -> enviar == 0 )
										<form method="POST" action="{{ route('Planeacion.destroy', $planeacion -> id_planeacion)}}" class="delete" id="{{ $planeacion -> id_planeacion }}">
											{!! method_field('DELETE') !!}
										 	{!! csrf_field() !!}
											<button type="submit" class="btn btn-danger">Eliminar</button>
										</form>
									@endif
								</td>
								<td>
									@if( $planeacion -> enviar == 0 )
										<form method="POST" action="{{ route('PlaneacionSend') }}">
											{!! method_field('POST') !!}
										 	{!! csrf_field() !!}
										 	<input type="text" name="id_planeacion" id="id_planeacion" hidden="hidden" value="{{ $planeacion -> id_planeacion }}">
											<button type="submit" class="btn btn-primary">Enviar</button>
										</form>
									@elseif( $planeacion -> enviar == 1 )
										Enviada
									@endif
								</td>
							@endif
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $planeaciones->appends(\Request::except('page'))->render() !!}	

		<div id="testmodal" class="modal fade" data-backdrop="false">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">Confirmación</h4>
	            </div>
	            <div class="modal-body">
	                <p><b>Atención:</b></p>
	                <p>Borrar esté registro ocasionará que se elimine toda la información asociada al mismo.</p>
	                <p>¿Está seguro(a) de que desea continuar?</p>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" id="cancelado" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-warning borrar-municipio" id="continuado">Continuar</button>
	            </div>
	        </div>
	    </div>
	</div>	
	</div>
<style type="text/css">
	.btn-primary{
		background-color: #20193D !important;
	}
</style>
<script>
    $(".delete").on("submit", function(e){
        $("#testmodal").modal('show');
        var boton_id = $(this).closest("form").attr('id'); 

        e.preventDefault();
        boton_id = "#"+boton_id;
        $('#testmodal .modal-footer button').on('click', function(event) {
  			var $button = $(event.target);
      		if($button[0].id == 'continuado')
  				$(boton_id).submit();
  			else
  				$("#testmodal").modal('hide');		
		});
		//return confirm("Are you sure?");
    });
</script>
@endsection
