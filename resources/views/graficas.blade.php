@extends('layouts.app')

@section('content')
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js" defer></script>
<script src="https://code.highcharts.com/modules/data.js" defer></script>
<script src="https://code.highcharts.com/modules/drilldown.js" defer></script>
<script src="https://code.highcharts.com/modules/exporting.js" defer></script>
<script src="https://code.highcharts.com/modules/export-data.js" defer></script>
<script src="https://code.highcharts.com/modules/accessibility.js" defer></script>
<script src="{{asset('js/graficas.js')}}" defer></script>
@endsection
<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart showing browser market shares. Clicking on individual columns
        brings up more detailed data. This chart makes use of the drilldown
        feature in Highcharts to easily switch between datasets.
    </p>
</figure>

@endsection
