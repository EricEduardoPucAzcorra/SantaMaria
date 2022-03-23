@extends('layout.SysPlantilla')
@section('titulo','Detalles')
@section('style')
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
@endsection
@section('contenido')

   <livewire:detalle-reserva/>

@endsection

@push('js')
    
@endpush