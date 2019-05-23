@extends('layout')

@section('contenido')
	<div class="col-sm-8" style="overflow: auto;"> 
		<h1>
			Catálogo de Eventos
			<a href="{{ route('Agenda.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Agenda','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaNotificacion">
			<thead>
				<tr>
					<th>
						@sortablelink('id_periodo')
					</th>
					<th>
						@sortablelink('id_escolaridad')
					</th>
					<th>
						@sortablelink('evento')
					</th>
					<th>
						@sortablelink('descripcion')
					</th>
					<th>
						@sortablelink('fecha_evento')
					</th>
					<th>
						@sortablelink('hora_inicio')
					</th>
					<th>
						@sortablelink('hora_fin')
					</th>
					<th>
						Autor
					</th>
					<th colspan="4">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($eventos -> isEmpty())
					<tr>
						<td colspan="7" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($eventos as $evento)
						<tr>
							<td>
								{{ $evento -> periodo -> periodo }}
							</td>
							<td>
								{{ $evento -> escolaridad -> escolaridad }}
							</td>
							<td>
								{{ $evento -> evento }}
							</td>
							<td>
								{{ substr($evento -> descripcion,0,15) }}...
							</td>
							<td>
								{{ $evento -> fecha_evento }}
							</td>
							<td>
								{{ $evento -> hora_inicio }}
							</td>
							<td>
								{{ $evento -> hora_fin }}
							</td>
							<td>
								{{ $evento -> autor -> nombre }} {{ $evento -> autor -> a_paterno }} {{ $evento -> autor -> a_materno }}
							</td>
							<td>
								<a href="{{ route('Agenda.show', $evento -> id_agenda) }}" class="btn btn-primary">Ver</a>
							</td>
							<td>
								<a href="{{ route('Agenda.edit', $evento -> id_agenda) }}" class="btn btn-primary">Editar</a>
							</td>
							<td>
								<form method="POST" action="{{ route('Agenda.destroy', $evento-> id_agenda)}}" class="delete" id="{{ $evento -> id_agenda }}">
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
		{!! $eventos -> appends(\Request::except('page'))->render() !!}	

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
