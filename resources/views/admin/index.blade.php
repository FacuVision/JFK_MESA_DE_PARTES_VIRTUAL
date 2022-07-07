@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Administracion</h1>

@stop

@section('content')
    <p>Bienvenido al panel de control de la empresa JFK Escuela de Manejo</p>

    @livewire('dashboardcomponent')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
        .container{
          margin:0 auto;
          text-align: center
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {

            $.ajax({
                type: "get",
                url: "{{ route('admin.procedings.graficos') }}",
                success: function(fecha) {
                    //Se declara la variable datas donde se almacenaran los datos del json que trae como respuesta del controler
                    var enviado = [];
                    //Se hace el recorrido de la respuesta para colocarlo en el array datas
                    for (let i = 0; i < fecha[0]["Enviados"].length; i++) {
                        enviado.push(fecha[0]["Enviados"][i]);
                    }
                    var archivado = [];
                    for (let i = 0; i < fecha[0]["Archivados"].length; i++) {
                        archivado.push(fecha[0]["Archivados"][i]);
                    }

                    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

                    var areaChartData = {
                        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                            'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                        //labels: ['January', 'February'],
                        datasets: [

                            {
                                label: 'Enviados',
                                backgroundColor: 'rgba(210, 214, 222, 0.5)',
                                borderColor: 'rgba(210, 214, 222, 1)',
                                pointRadius: true,
                                pointColor: 'rgba(210, 214, 222, 1)',
                                pointStrokeColor: '#c1c7d1',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data: enviado

                            },
                            {
                                label: 'Atendidos',
                                backgroundColor: 'rgba(60,141,188,0.5)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: true,
                                pointColor: '#3b8bba',
                                pointStrokeColor: 'rgba(60,141,188,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data: archivado
                            },
                        ]
                    }

                    var areaChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false,
                                }
                            }]
                        },
                    }

                    // This will get the first returned node in the jQuery collection.
                    new Chart(areaChartCanvas, {
                        type: 'bar',
                        data: areaChartData,
                        options: areaChartOptions
                    });


                    for (let index = 0; index < 12; index++) {


                        id = index+1;

                        porcentaje = ((archivado[index]*100)/enviado[index]);

                        //console.log(Math.round(porcentaje));

                        var color = "";


                        if( porcentaje >= 0  && porcentaje < 25){
                            color = "#e74c3c";
                        }
                        else if( porcentaje >= 25  && porcentaje < 65){
                            color = "#fec107";
                        } else if( porcentaje >= 65  && porcentaje <= 100){
                            color = "#79E354";
                        }

                        if (enviado[index]== 0) {

                            color = "#e74c3c";

                            $('#'+id).val(0);

                            $('#'+id).knob({
                                'min': 0,
                                'max': 100,
                                'height': 100,
                                'width': 100,
                                'displayInput': true,
                                'fgColor': color,
                                'release': function(v) {
                                    $(".p").text(v);
                                },
                                'readOnly': true
                            });

                        } else {

                            $('#'+id).val(Math.round(porcentaje));

                            $('#'+id).knob({
                                'min': 0,
                                'max': 100,
                                'height': 100,
                                'width': 100,
                                'displayInput': true,
                                'fgColor': color,
                                'release': function(v) {
                                    $(".p").text(v);
                                },
                                'readOnly': true
                            });
                        }

                    }

                    //var aea = 1;

                }
            });

        });
    </script>

@stop
