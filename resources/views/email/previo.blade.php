<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importacion</title>
</head>
<body>
    @foreach ($previoVivo as $importacion)
    <h1 class="font-weigth-bold">Referencia: <span class="font-weigth-regular">{{$importacion->referencia}}</span></h1>
    <p>Evidencias Previo</p>

    <p>Consulta toda la información en <a href="importaciones.mrollogistics.com/importacion/{{$importacion->id}}">importaciones.mrollogistics.com/importacion/{{$importacion->id}}</a></p>

    <img style="display:block" src='http://127.0.0.1:8000/images/logo.jpeg' alt="">
    @endforeach
</body>
</html>
