$.get('/importaciones/mes', function(data) {
    var options = {
        colors: [
            '#0edda9'
        ],
        series: [{
        name: 'Importaciones',
        data: data
      }],

        chart: {
        height: 350,
        type: 'area',

        animations: {
            enabled: true,
            easing: 'easeout',
            speed: 700,
            animateGradually: {
                enabled: true,
                delay: 150
            },
            dynamicAnimation: {
                enabled: true,
                speed: 150
            }
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth'
      },
      xaxis: {
        type: 'date',
        categories: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
      },
      tooltip: {
        x: {
          format: 'MM'
        },
      },
      };

      var chart = new ApexCharts(document.querySelector("#containerImportaciones"), options);
      chart.render();
})

// etiquetas clientes

$.get('/clientes/nombres', function(data) {
    let clientes = [];

    for(let i = 0; i < data.length; ++i) {
        clientes = [... clientes, data[i]]
    }

    // importaciones por cliente
    $.get('/importaciones/mes/cliente', function(data) {
        var options = {
            colors:['#3A83C8', '#415fff', '#9C27B0', '#3acfe7', '#e15018', '#3f33ef', '#b5ff7c', '#ff3305'],
            series: data,
            chart: {
            width: 450,
            type: 'pie',
          },
          labels: clientes,
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
          };

          var chart = new ApexCharts(document.querySelector("#mesClientes"), options);
          chart.render();

    })
})



// kpis

  $.get('/importaciones/kpis', function(data) {
    let referencias = [];
    for(let i = 0; i < data[3].length; ++i) {
        referencias.push(data[3][i])
    }

    var options = {
        series: [{
        name: 'Doc-Arribo',
        data: data[0]
      }, {
        name: 'Arribo-Despacho',
        data: data[1]
      }, {
        name: 'Despacho-CG',
        data: data[2]
      }],
        chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: referencias,
      },

      fill: {
        opacity: 1
      },

      };

      var chart = new ApexCharts(document.querySelector("#kpis"), options);
      chart.render();
  })
