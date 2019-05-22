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
                	<h3 class="panel-title" id="titulo-padres" align="center">
                		{{ $religion -> religion }}
                	</h3>
              	</div>
            </div>
            <div class="panel-footer">
                <table>
                	<tr>
                		<td><a href="{{ route('Religion.edit', $religion-> id_religion)}}" class="btn btn-primary">Editar</a>
                		</td>
                		<td><form method="POST" onsubmit="return confirm('¿En realidad desea borrar el registro seleccionado?');" action="{{ route('Religion.destroy', $religion -> id_religion)}}" class="delete" id="{{ $religion -> id_religion }}">
								{!! method_field('DELETE') !!}
							 	{!! csrf_field() !!}
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
                		</td>
                		<td>
		           			<div style="width: 285px"></div>
		           		</td>
		           		<td>
		           			<span class="pull-right">
		               			<a href="{{ route('Religion.index') }}" class="btn btn-primary">Regresar</a>
		           			</span>
		           		</td>
                	</tr>
                </table>         
            </div>       
          </div>
        </div>
    </div>

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
	.panel-heading {
  		background-color: #20193D !important;
	}
	.panel-title {
		color: #D10F20 !important;
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