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
                    Evento: {{ $evento -> evento }}<br>
                    Descripción: {{ $evento -> descripcion }}<br>
                    Fecha: {{ $evento -> fecha_evento }}</h3>
                </div>
            </div>
            <div class="panel-footer">
                <table>
                  <tr>
                    <td><a href="{{ route('Agenda.edit', $evento -> id_agenda)}}" class="btn btn-primary">Editar</a>
                    </td>
                    <td>
                      <form method="POST" action="{{ route('Agenda.destroy', $evento -> id_agenda)}}">
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
                        <a href="{{ route('Agenda.index') }}" class="btn btn-primary">Regresar</a>
                    </span>
                  </td>
                  </tr>
                </table> 
            </div> 
        
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset=utf-8></script>     
          </div>
        </div>
    </div>
<script>


    var data_click = <?php echo $grupos_por_periodo; ?>;
    var etiquetas = <?php echo $periodos; ?>;

    var barChartData = {

        labels: etiquetas,

        datasets: [{

            label: 'Numero de grupos',

            backgroundColor: ['rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'],

            data: data_click

        }]/*, {

            label: 'View',

            backgroundColor: "rgba(151,187,205,0.5)",

            data: data_viewer

        }]*/

    };


    window.onload = function() {

        var ctx = document.getElementById("canvas").getContext("2d");

        window.myBar = new Chart(ctx, {

            type: 'bar',

            data: barChartData,

            options: {

                elements: {

                    rectangle: {

                        borderWidth: 2,

                        borderColor: 'rgb(0, 255, 0)',

                        borderSkipped: 'bottom'


                    }

                },

                responsive: true,

                title: {

                    display: true,

                    text: 'Grupos por Periodo'

                },
                scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepValue: 1,
                                max: 10
                            }
                        }]
                }

            }

        });


    };

</script>


<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">

                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                    <canvas id="canvas" height="280" width="600"></canvas>

                </div>

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