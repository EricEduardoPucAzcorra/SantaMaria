@extends('layout.SysPlantilla')
@section('titulo','Habitaciones')
@section('style')
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
@endsection
@section('contenido')

<habitaciones-component></habitaciones-component>

@endsection

@push('js')
    
@endpush