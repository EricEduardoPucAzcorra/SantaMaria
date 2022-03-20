@extends('layout.SysPlantilla')
@section('titulo','Reservar habitacion')
@section('style')
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
@endsection
@section('contenido')

<reservar-component></reservar-component>

@endsection

@push('js')
    
@endpush