@extends('layout.SysPlantilla')
@section('titulo','Santa Maria')
@section('contenido')
	<div id="id_vue2">
		<h1>Grafico de Detalles Comanda Platillos</h1>
		
	</div>
	<canvas id="mychart2"> 		
	</canvas>

@endsection

@push('js')

	<script type="text/javascript" src="{{asset('graficos/chart.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('graficos/vue-resource.js')}}"></script>

	<script type="text/javascript" src="{{asset('graficos/graficoDR.js')}}"></script>
@endpush
