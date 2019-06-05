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
           		Mensaje: <br>{{ $notificacion -> mensaje }}<br>
           	</h3>
         	</div>
          <div class="row">
            <h3 class="panel-title" id="titulo-padres" align="center">
              Para: <br>
              @if( $notificacion -> grupo != null )
                Grupo: {{ $notificacion -> grupo -> grupo }} - {{ $notificacion -> materia -> materia }}<br>
              @elseif( $notificacion -> alumno != null )
                Alumn@: {{ $notificacion -> alumno -> nombre }} {{ $notificacion -> alumno -> a_paterno }} {{ $notificacion -> alumno -> a_materno }}<br>
              @elseif($notificacion -> trabajador != null )
                Trabajador@: {{ $notificacion -> trabajador -> nombre }} {{ $notificacion -> trabajador -> a_paterno }} {{ $notificacion -> trabajador -> a_materno }}<br>
              @endif
            </h3>
          </div>
          <div class="row">
            <h3 class="panel-title" id="titulo-padres" align="center">
              Caducidad: <br>{{ $notificacion -> caducidad }}<br>
            </h3>
          </div>
        </div>
        <h3 class="panel-title" id="titulo-adjuntos" align="center">Adjuntos</h3>
        <div id="panel-adjuntos"> 
          <table class="table table-user-information">
            <tbody>
              <?php 
                $adjuntos = null;
                if($notificacion -> archivos != 'ninguno')
                  $adjuntos = explode('&', $notificacion -> archivos);
              ?>
              @if($adjuntos != null)
                @if(count($adjuntos) > 1)
                  @for($i=1; $i < count($adjuntos); $i++)
                    <tr>
                      <td>
                        <a href="{{ Storage::url('public/notificaciones/'. $adjuntos[$i]) }}" target="_blank"><img src="{{ URL::asset('images/clip.png') }}" width="20px" height="20px"> {{ $adjuntos[$i] }}</a> 
                      </td>
                      <td>
                        <form method="POST" action="{{ route('deleteAttachment') }}" class="delete" id="attachment_{{ $i }}">
                          <input type="text" name="attachment" value="{{ $notificacion -> id_notificacion }}-{{ $i }}" hidden="hidden">
                          {!! method_field('POST') !!}
                          {!! csrf_field() !!}
                          <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                      </td>
                    </tr>
                  @endfor
                @endif
              @else
                Sin adjuntos
              @endif
            </tbody>
          </table>
        </div>
        <div class="panel-footer">
          <table>
          	<tr>
           		<td>
                <a href="{{ route('Notificacion.edit', $notificacion-> id_notificacion) }}" class="btn btn-primary">Editar</a>
            	</td>
           		<td>
                <form method="POST" action="{{ route('Notificacion.destroy', $notificacion -> id_notificacion) }}" class="delete" id="{{ $notificacion -> id_notificacion }}">
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
		          		<a href="{{ route('Notificacion.index') }}" class="btn btn-primary">Regresar</a>
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
    $(function(){
      $('#panel-adjuntos').hide();
      $('#titulo-adjuntos').css('cursor', 'pointer');
      $("#titulo-adjuntos").click(function(){
        $('#panel-adjuntos').slideToggle( "slow" );
      });
    });
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
    });
</script>
@endsection
