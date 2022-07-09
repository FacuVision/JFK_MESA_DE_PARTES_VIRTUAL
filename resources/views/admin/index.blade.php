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
        .container {
            margin: 0 auto;
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
                    //console.log(fecha);
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
                    };

                    // This will get the first returned node in the jQuery collection.
                    new Chart(areaChartCanvas, {
                        type: 'bar',
                        data: areaChartData,
                        options: areaChartOptions
                    });



/*----------------------------------------------------------------------------------------------------------------------------------------------------------*/
                    const etiquetas = [
                        'Muy Satisfecho',
                        'Satisfecho',
                        'Regular',
                        'Poco Satisfecho',
                        'Insatisfecho',
                    ];
                    var pieOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    };
                    const colors = ['#00a65a', '#BAE430', '#FFE733', '#f39c12', '#f56954'];




                    var usa1 = $('#usa1').get(0).getContext('2d');
                    var dataset1 = [];
                    for (let i = 0; i < fecha[0]["usa1"].length; i++) {
                        dataset1.push(fecha[0]["usa1"][i]);
                    }
                    var datausa1 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset1.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(usa1, {
                        type: 'doughnut',
                        data: datausa1,
                        options: pieOptions
                    });


                    var usa2 = $('#usa2').get(0).getContext('2d');
                    var dataset2 = [];
                    for (let i = 0; i < fecha[0]["usa2"].length; i++) {
                        dataset2.push(fecha[0]["usa2"][i]);
                    }
                    var datausa2 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset2.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(usa2, {
                        type: 'doughnut',
                        data: datausa2,
                        options: pieOptions
                    });


                    var fun1 = $('#fun1').get(0).getContext('2d');
                    var dataset3 = [];
                    for (let i = 0; i < fecha[0]["fun1"].length; i++) {
                        dataset3.push(fecha[0]["fun1"][i]);
                    }
                    var datafun1 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset3.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(fun1, {
                        type: 'doughnut',
                        data: datafun1,
                        options: pieOptions
                    });

                    var fun2 = $('#fun2').get(0).getContext('2d');
                    var dataset4 = [];
                    for (let i = 0; i < fecha[0]["fun2"].length; i++) {
                        dataset4.push(fecha[0]["fun2"][i]);
                    }
                    var datafun2 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset4.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(fun2, {
                        type: 'doughnut',
                        data: datafun2,
                        options: pieOptions
                    });

                    var acc1 = $('#acc1').get(0).getContext('2d');
                    var dataset5 = [];
                    for (let i = 0; i < fecha[0]["acc1"].length; i++) {
                        dataset5.push(fecha[0]["acc1"][i]);
                    }
                    var dataacc1 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset5.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(acc1, {
                        type: 'doughnut',
                        data: dataacc1,
                        options: pieOptions
                    });

                    var acc2 = $('#acc2').get(0).getContext('2d');
                    var dataset6 = [];
                    for (let i = 0; i < fecha[0]["acc2"].length; i++) {
                        dataset6.push(fecha[0]["acc2"][i]);
                    }
                    var dataacc2 = {
                        labels: etiquetas,
                        datasets: [{
                            data: dataset6.reverse(),
                            backgroundColor: colors,
                        }]
                    };
                    new Chart(acc2, {
                        type: 'doughnut',
                        data: dataacc2,
                        options: pieOptions
                    });






/*----------------------------------------------------------------------------------------------------------------------------------------------------------*/

                    for (let index = 0; index < 12; index++) {


                        id = index + 1;

                        porcentaje = ((archivado[index] * 100) / enviado[index]);

                        //console.log(Math.round(porcentaje));

                        var color = "";


                        if (porcentaje >= 0 && porcentaje < 25) {
                            color = "#e74c3c";
                        } else if (porcentaje >= 25 && porcentaje < 65) {
                            color = "#fec107";
                        } else if (porcentaje >= 65 && porcentaje <= 100) {
                            color = "#79E354";
                        }

                        if (enviado[index] == 0) {

                            color = "#e74c3c";

                            $('#' + id).val(0);

                            $('#' + id).knob({
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

                            $('#' + id).val(Math.round(porcentaje));

                            $('#' + id).knob({
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
