
//selectores
const mes = document.querySelector('#mes');
const tipo = document.querySelector('#tipo');
const tbody = document.querySelector('#tbody');
const grafica = document.querySelector('#myChart');

var id = 0;
var dias = [];
var documentacion_arribo = [];
var arribos_despacho = [];
var despacho_cg = [];
var cg_anticipo = [];
let myChart;
let ValidarSelect = 0;

// kpis mediante selects

mes.addEventListener('change', changeOnMes);
tipo.addEventListener('change', changeOnTipo);


function changeOnMes() {
    if (tipo.length == 1) {
        console.log(tipo.length);
        llenarTipos();
    }
    limpiarHTML();

    // Ajax
    $.get('/kpis/' + $("#mes").val(), function (data) {

        for (var i = 0; i < data.length; ++i) {

            var todo = '<tr class="text-center"><td>' + data[i].referencia + '</td>';
            todo += '<td class="text-center">' + data[i].dias_documentacion_arribo + '</td>';
            todo += '<td class="text-center">' + data[i].dias_arribo_despacho + '</td>';
            todo += '<td class="text-center">' + data[i].dias_despacho_cuentaGastos + '</td>';
            todo += '<td class="text-center">' + data[i].dias_cuentaGastos_anticipo + '</td>';

            $('#tbody').append(todo);

            dias.push(data[i].referencia);


            documentacion_arribo.push(data[i].dias_documentacion_arribo);
            arribos_despacho.push(data[i].dias_arribo_despacho);
            despacho_cg.push(data[i].dias_despacho_cuentaGastos);
            cg_anticipo.push(data[i].dias_cuentaGastos_anticipo);

        }
        generarGrafica();
    })


}

function changeOnTipo() {
    limpiarHTML();
    $.get('kpis/mes/' + $('#mes').val() + '/tipo/' + $('#tipo').val(), function (data) {

        for (var i = 0; i < data.length; ++i) {
            var datos = '<tr class="text-center"><td>' + data[i].referencia + '</td>';
            datos += '<td class="text-center">' + data[i].dias_documentacion_arribo + '</td>';
            datos += '<td class="text-center">' + data[i].dias_arribo_despacho + '</td>';
            datos += '<td class="text-center">' + data[i].dias_despacho_cuentaGastos + '</td>';
            datos += '<td class="text-center">' + data[i].dias_cuentaGastos_anticipo + '</td>';

            $('#tbody').append(datos);

            dias.push(data[i].referencia);

            documentacion_arribo.push(data[i].dias_documentacion_arribo);
            arribos_despacho.push(data[i].dias_arribo_despacho);
            despacho_cg.push(data[i].dias_despacho_cuentaGastos);
            cg_anticipo.push(data[i].dias_cuentaGastos_anticipo);
        }
        generarGrafica();
    })

}

function llenarTipos() {
    if(ValidarSelect !== 0) {
        return;
    }
    var opciones = {
        tipo: 'opcion1',
    };
    $.get('/embarques/tipos', function (data) {
        for (var i = 0; i < data.length; ++i) {
            $.each(opciones, function () {
                $('#tipo').append($('<option>',
                    {
                        value: data[i].id,
                        text: data[i].tipo
                    }))
            })
        }
    })
}



function generarGrafica() {
    var ctx = document.getElementById('myChart').getContext('2d');
    if (myChart) {
        myChart.destroy();
    }

    let delayed;
    myChart = new Chart(ctx, {
        type: 'bar',
        options: {

            animation: {

            },
            plugins: {
                title: {
                    display: true,
                    text: 'Kpis',
                }
            }
        },
        data: {
            labels: dias,
            datasets: [{
                label: 'Doc-Arribo',
                data: documentacion_arribo,

                backgroundColor: [
                    'rgba(255, 153, 0, 0.5)',

                ],
                borderColor: [
                    'rgba(114, 116, 116, 1)',


                ],
                borderWidth: 1,

                borderWidth: 1,
            }, {

                label: 'Arribo-Desp',
                data: arribos_despacho,

                backgroundColor: [
                    'rgba(1, 128, 255, 0.5)',

                ],
                borderColor: [
                    'rgba(114, 162, 235, 1)',


                ],

            }, {
                label: 'Despacho-CG',
                data: despacho_cg,
                backgroundColor: [
                    'rgba(114, 47, 55, 0.7)',

                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',


                ],
                borderWidth: 1,
            }, {
                label: 'CG-Anticipo',
                data: cg_anticipo,
                backgroundColor: [
                    'rgba(53, 193, 114, 0.2)',

                ],
                borderColor: [
                    'rgba(51, 200, 235, 1)',


                ],
                borderWidth: 1,
            }],

        },


    });
    documentacion_arribo = [];
    arribos_despacho = [];
    despacho_cg = [];
    cg_anticipo = [];
    dias = [];
}

function limpiarHTML() {

    while (tbody.firstChild) {
        tbody.removeChild(tbody.firstChild);
    }
}
