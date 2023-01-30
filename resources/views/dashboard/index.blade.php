@extends('layouts.app')
@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="{{asset('js/importacionesDashboard.js')}}"defer></script>
<!-- Inventario -->
<script src="{{asset('js/inventario.js')}}"defer></script>
@endsection
@section('content')
@include('dashboard.dashboard')
@endsection
