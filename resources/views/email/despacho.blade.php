<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Despacho</title>
</head>
<body>
    @foreach ($despachos as $despacho)
    <h2>Estatus de despacho {{$despacho->referencia}}:<span>{{$despacho->despachos->nombre}}</span></h2>
    <p >Consulta toda la informaci贸n en <a href="http://importaciones.mrollogistics.com/importacion/{{$despacho->id}}">http://importaciones.mrollogistics.com/importacion/{{$despacho->id}}</a></p>

    <img style="display:block" src='http://importaciones.mrollogistics.com/images/logo.jpeg' alt="img-logo">
' alt="">
h
</body>
</html>
