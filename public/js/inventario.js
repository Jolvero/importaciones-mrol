let inventarioZte = [];
var inventarioOppo = [];
var inventarioVivo = [];
var inventarioCloud = [];
var inventarioRealme = [];
var inventarioTecno = [];
generarGrafica()

function generarGrafica() {

    const seccionFGraficaInventario = document.querySelector('#chartInventario');

    if(seccionFGraficaInventario != null) {

        $.get('/clientes/nombres', function(data) {
            let clientes = [];

            for(let i = 0; i < data.length; ++i) {
                clientes = [... clientes, data[i]]
            }

            $.get('/inventario/clientes', function(data) {
                var options = {
                    series: [{
                        name: 'Importaciones',
                        data: data
                    },],
                    chart: {
                        height: 450,
                        type: 'bar',
                        animations: {
                            enabled: true,
                            easing: 'easein',
                            speed: 200,
                            animateGradually: {
                                enabled: true,
                                delay: 150
                            },
                            dynamicAnimation: {
                                enabled: true,
                                speed: 350
                            }
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 0,
                            dataLabels: {
                                position: 'top', // top, center, bottom
                            },
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function (val) {
                            return val + "";
                        },
                        offsetY: -20,
                        style: {
                            fontSize: '12px',
                            colors: ["#304758"]
                        }
                    },

                    xaxis: {
                        categories: clientes,
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        crosshairs: {
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    colorFrom: '#D8E3F0',
                                    colorTo: '#BED1E6',
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                }
                            }
                        },
                        tooltip: {
                            enabled: true,
                        }
                    },
                    yaxis: {
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false,
                        },
                        labels: {
                            show: true,
                        }

                    },

                };


                var chart = new ApexCharts(document.querySelector("#chartInventario"), options);
                chart.render();
            })
        })

    }


}





