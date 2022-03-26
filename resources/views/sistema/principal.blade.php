@extends('layout.SysPlantilla')
@section('titulo','Santa Maria')
@section('contenido')

@if (Auth::check())
    {{-- autenticado como Administrador --}}
    @if(Auth::user()->id_rol==1)

	<!-- Aqui se insertan las rutas de las capetas donde estan las vistas -->

	<template v-if="menu==0">
		principal
	</template>

	<template v-if="menu==1">
		@include('sistema.usuarios.usuarios')
	</template>

	<template v-if="menu==2">
		
	</template>

	<template v-if="menu==3">
		
	</template>

	<template v-if="menu==4">
		
	</template>

	<template v-if="menu==5">
		@include('sistema.almacen.almacen')
	</template>

	<template v-if="menu==6">
		@include('sistema.almacen.categoriasObj')
	</template>

	<template v-if="menu==7">
		@include('sistema.admin.hotel.reservaciones.reservar')
	</template>

	<template v-if="menu==8">
		@include('sistema.admin.hotel.habitaciones.habitaciones')
	</template>

	<template v-if="menu==9">
		@include('sistema.admin.hotel.reservaciones.detalle_reservas')
	</template>

	  {{-- autenticado como Recepcionista--}}
    @elseif(Auth::user()->id_rol==2)

    <template v-if="menu==0">
		principal
	</template>
	<template v-if="menu==7">
			@include('sistema.admin.hotel.reservaciones.reservar')
	</template>
	 
	 {{-- autenticado como Mesero--}}
	 @elseif(Auth::user()->id_rol==3)   


    <template v-if="menu==0">
		principal
	</template>

	 {{-- autenticado como Cocina--}}
	 @elseif(Auth::user()->id_rol==4)   

	 <template v-if="menu==0">
		principal
	</template>

    @else

    @endif

@endif

@endsection
