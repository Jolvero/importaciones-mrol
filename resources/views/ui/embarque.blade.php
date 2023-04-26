<div class="col-md-4 mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="card-title">{{$embarque->referencia}}</h3>

            <div class="d-block justify-content-between">
                @php
                $fecha = $embarque->arribo

                @endphp
                </div>

    <p class="text-primary font-weight-bold">Arribo: <fecha-embarque class="text-dark" fecha="{{$fecha}}"></fecha-embarque></p>

    <a href="{{route('embarques.show', ['embarque' => $embarque->id])}}" class="btn btn-primary d-block btn-embarque">Ver importación
    </a>

        </div>
    </div>
</div>
