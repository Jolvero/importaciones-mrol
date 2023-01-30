<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kpis</title>
</head>
<body>


    <table style="padding: 2rem; border: 1px, solid, #722f37">
        <thead class="bg-primary text-light">
            <tr style="background: #722f37">
                <th scope="col" style="color: #ffffff;">Referencia</th>
                <th scope="col" style="color: #ffffff;">Días Documentación Arribo</th>
                <th scope="col" style="color: #ffffff;">Días Arribo despacho</th>
                <th scope="col" style="color: #ffffff;">Días Despacho CG</th>
                <th scope="col" style="color: #ffffff;">Días Anticipo CG</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kpis as $kpi)
                <tr>
                    <td style="text-align:center">{{$kpi->referencia}}</td>
                    <td style="text-align:center">{{$kpi->dias_documentacion_arribo}}</td>
                    <td style="text-align:center">{{$kpi->dias_arribo_despacho}}</td>
                    <td style="text-align:center">{{$kpi->dias_despacho_cuentaGastos}}</td>
                    <td style="text-align:center">{{$kpi->dias_cuentaGastos_anticipo}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
