@extends('layout')

@section('contenido')
	<div class="col-sm-12" style="overflow: auto;"> 
		<h1>
			Catálogo de Criterios de Desempeño
			<a href="{{ route('CriterioDesempenio.create') }}" class="btn btn-primary pull-right">Nuevo</a>
		</h1>
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
    	{!! Form::open(['method'=>'GET','url'=>'CriterioDesempenio','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>
						@sortablelink('id_criterio_desempenio')
					</th>
					<th>
						@sortablelink('criterio')
					</th>
					<th>
						Descripción
					</th>
					<th>
						@sortablelink('porcentaje_examen')
					</th>
					<th>
						@sortablelink('porcentaje_tareas')
					</th>
					<th>
						@sortablelink('porcentaje_tomas_clase')
					</th>
					<th>
						@sortablelink('porcentaje_participacion')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($criterios -> isEmpty())
					<tr>
						<td colspan="5" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($criterios as $criterio)
						<tr>
							<td>
								{{ $criterio -> id_criterio_desempenio }}
							</td>
							<td>
								{{ $criterio -> criterio }}
							</td>
							<td>
								{{ substr($criterio -> descripcion,0,15) }}...
							</td>
							<td>
								{{ $criterio -> porcentaje_examen }}
							</td>
							<td>
								{{ $criterio -> porcentaje_tareas }}
							</td>
							<td>
								{{ $criterio -> porcentaje_tomas_clase }}
							</td>
							<td>
								{{ $criterio -> porcentaje_participacion }}
							</td>
							<td>
								<a href="{{ route('CriterioDesempenio.show', $criterio -> id_criterio_desempenio)}}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('CriterioDesempenio.edit', $criterio -> id_criterio_desempenio)}}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('CriterioDesempenio.destroy', $criterio -> id_criterio_desempenio)}}" class="delete" id="{{ $criterio -> id_criterio_desempenio }}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $criterios->appends(\Request::except('page'))->render() !!}
		
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
