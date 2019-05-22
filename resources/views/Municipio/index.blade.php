@extends('layout')

@section('contenido')
	<div class="col-sm-8" style="overflow: auto;"> 
		<h1>
			Catálogo de Municipios
			<a href="{{ route('Municipio.create') }}" class="btn btn-primary pull-right">Nuevo</a>
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
    	{!! Form::open(['method'=>'GET','url'=>'Municipio','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
			<div class="input-group custom-search-form">
			    <input type="text" class="form-control" name="search" placeholder="Buscar...">
			    <span class="input-group-btn">
			        <button class="btn btn-default-sm" type="submit">
			            <i class="fa fa-search"><!--<span class="hiddenGrammarError" pre="" data-mce-bogus="1"--></i>
			        </button>
			    </span>
			</div>
		{!! Form::close() !!}
		<table class="table table-hover table-striped" id="tablaMunicipio">
			<thead>
				<tr>
					<th>
						@sortablelink('id_estado_municipio')
					</th>
					<th>
						@sortablelink('id_estado')
					</th>
					<th>
						Estado
					</th>
					<th>
						@sortablelink('id_municipio')
					</th>
					<th>
						@sortablelink('municipio')
					</th>
				</tr>
			</thead>
			<tbody>
			@if($municipios -> isEmpty())
				<tr>
					<td colspan="5" align="center">No hay datos para mostrar.</td>
				</tr>
			@else
				@foreach($municipios as $municipio)
					<tr>
						<td>
							{{ $municipio -> id_estado_municipio }}
						</td>
						<td>
							{{ $municipio -> id_estado }}
						</td>
						<td>
							<a href="{{ route('Municipio.show', $municipio -> estado -> id_estado)}}"> {{ $municipio -> estado -> estado}}</a>
						</td>
						<td>
							{{ $municipio -> id_municipio }}
						</td>
						<td>
							{{ $municipio -> municipio }}
						</td>
						<td>
							<a href="{{ route('Municipio.show', $municipio -> id_estado_municipio) }}" class="btn btn-primary">Ver</a>
						</td>
						<td>
							<a href="{{ route('Municipio.edit', $municipio -> id_estado_municipio) }}" class="btn btn-primary">Editar</a>
						</td>
						<td>
							<form method="POST" action="{{ route('Municipio.destroy', $municipio -> id_estado_municipio) }}" class="delete" id="{{ $municipio -> id_estado_municipio }}">
									{!! method_field('DELETE') !!}
								 	{!! csrf_field() !!}
									<button type="submit" class="btn btn-danger show-modal">Eliminar</button>
							</form>
						</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
		{!! $municipios->appends(\Request::except('page'))->render() !!}
		
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
	/*$(document).ready(function(){
	  /*$('.show-modal').click(function(e){
	      $("#testmodal").modal('show');
	      e.preventDefault();
	  });

	  $(".borrar-municipio").click(function(){
    		$("#form-borrar-municipio").submit();
    	});
	});*/
	/*$(".delete").on("submit", function(){
        return confirm("Are you sure?");
    });*/
    $(".delete").on("submit", function(e){
        $("#testmodal").modal('show');
        var user_id = $(this).closest("form").attr('id'); 

        /*return confirm("Are you sure?");*/
        e.preventDefault();
        user_id = "#"+user_id;
        $('#testmodal .modal-footer button').on('click', function(event) {
  			var $button = $(event.target);
      		//alert('The buttons id that closed the modal is: #' + $button[0].id);
      		if($button[0].id == 'continuado')
  				$(user_id).submit();
  			else
  				$("#testmodal").modal('hide');		
		});
		//return confirm("Are you sure?");
    });
</script>
@endsection
