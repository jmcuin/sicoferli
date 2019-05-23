@extends('layout')

@section('contenido')
	<div class="col-med-8" style="overflow: auto;"> 
		<h1>
			Listado de Trabajadores
			<a href="{{ route('Trabajador.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Trabajador','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaTrabajador">
			<thead>
				<tr>
					<th>
						Matrícula
					</th>
					<th>
						@sortablelink('nombre')
					</th>
					<th>
						@sortablelink('a_paterno')
					</th>
					<th>
						@sortablelink('a_materno')
					</th>
					<th>
						@sortablelink('curp')
					</th>
					<th>
						@sortablelink('rfc')
					</th>
					<th>
						@sortablelink('telefono')
					</th>
					<th>
						@sortablelink('email')
					</th>
					<th>
						Rol
					</th>
					<th colspan="3">
						Acciones
					</th>
				</tr>
			</thead>
			<tbody>
			@if($trabajadores-> isEmpty())
					<tr>
						<td colspan="18" align="center">No hay datos para mostrar.</td>
					</tr>
				@else
					@foreach($trabajadores as $trabajador)
						<tr>
							<td>
								{{ $trabajador -> user -> matricula }}
							</td>
							<td>
								{{ $trabajador -> nombre }}
							</td>
							<td>
								{{ $trabajador -> a_paterno }}
							</td>
							<td>
								{{ $trabajador -> a_materno }}
							</td>
							<td>
								{{ $trabajador -> curp }}
							</td>
							<td>
								{{ $trabajador -> rfc }}
							</td>
							<td>
								{{ $trabajador -> telefono }}
							</td>
							<td>
								{{ $trabajador -> email }}
							</td>
							<td>
								{{ $trabajador -> user -> roles[0] -> rol }}
							</td>
							<td>
								@if( $trabajador -> user -> matricula != 'coferli' )
								<a href="{{ route('Trabajador.show', $trabajador -> id_trabajador) }}" class="btn btn-primary">Ver</a>
								@endif
							</td>
							<td>
								@if( $trabajador -> user -> matricula != 'coferli' )
								<a href="{{ route('Trabajador.edit', $trabajador -> id_trabajador) }}" class="btn btn-primary">Editar</a>
								@endif
							</td>
							<td>
								@if( $trabajador -> user -> matricula != 'coferli' )
								<form method="POST" action="{{ route('Trabajador.destroy', $trabajador-> id_trabajador)}}" class="delete" id="{{ $trabajador -> id_trabajador }}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-danger">Eliminar</button>
								</form>
								@endif
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	{!! $trabajadores->appends(\Request::except('page'))->render() !!}	

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
