
var mes = document.querySelector('#mes');
var tipo = document.querySelector('#tipo')
var cliente = document.querySelector('#cliente');

eventListeners()
function eventListeners() {
    mes.addEventListener('change', validarCampos)
    tipo.addEventListener('change', validarCampos)
    cliente.addEventListener('change', validarCampos)

}



function validarCampos() {
    if($('#mes').val() != 0 && $('#tipo').val() != 0 && $('#cliente').val()!=0 ) {
        $('#kpis').children().remove()
        kpis()

        vaciarCampos();

    }
}

function vaciarCampos() {
    $('#mes').val('')
    $('#tipo').val('')
    $('#cliente').val('')
}

function kpis() {
    $.get('/kpis/'+ $('#mes').val()+ '/'+ $('#tipo').val()+ '/'+ $('#cliente').val(), function(data) {
        $('#kpis').children().remove()

        if(data.length>0) {
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
              }, ],
                chart: {
                type: 'bar',
                height: 450
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
              referencias = [];
          } else {
            $('.mensaje').children().remove();
            $('.mensaje').append('<h2 class="text-center font-weight-bold">No se encontraron Resultados</h2>')
            setTimeout(()=> {
                $('.mensaje').children().remove();
            },3000)
          }
        }
      )

    }




