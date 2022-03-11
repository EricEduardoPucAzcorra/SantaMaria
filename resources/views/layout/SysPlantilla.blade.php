<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('css/santamaria.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <div id="vue">
        <div>
            @include('layout.NavIzquierdo')
        </div>
        <div>
            @include('layout.NavSuperior')
        </div>
        <div id="contenedor-sistema">
            {{-- contenido --}}
            
            @yield('contenido')

        </div>
    </div>
</body>

<script src="{{asset('js/proyecto.js')}}"></script>
<script src="{{asset('js/sweetalert.js')}}"></script>
<script type="" src="{{asset('js/santamaria.js')}}"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</html>