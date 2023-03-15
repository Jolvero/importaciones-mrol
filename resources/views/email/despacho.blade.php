<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Despacho</title>
</head>
<body>
    <!--hola-->
    @foreach ($despachos as $despacho)
    <h2>Estatus de despacho {{$despacho->referencia}}:<span>{{$despacho->despachos->nombre}}</span></h2>
    <p >Consulta toda la información en <a href="http://127.0.0.1:8000/importacion/{{$despacho->id}}">http://127.0.0.1:8000/importacion/{{$despacho->id}}</a></p>

    <img style="display:block" src='http://127.0.0.1:8000/images/logo.jpeg' alt="">
    @endforeach
</body>
</html>
