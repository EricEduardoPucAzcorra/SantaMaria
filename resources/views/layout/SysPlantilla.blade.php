<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Cache" content="no-cache">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="usuario_log" content="{{Auth::user()}}">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="{{asset('css/santamaria.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('graficos/vue.js')}}"></script>

    @yield('style')

 
</head>
<body>
    <div id="vue">
         {{-- valido usuario  si esta autenticado--}}
            @if (Auth::check())
                {{-- autenticado como Administrador --}}
                @if(Auth::user()->id_rol==1)

                {{--incluyo el navegador superior administrativo--}}
                
                    @include('layout.NavIzquierdo')

                 {{-- autenticado como Recepcionista--}}
                @elseif(Auth::user()->id_rol==2)

                    @include('layout.NavIzquierdoRecepcionista')

                 {{-- autenticado como Mesero --}}
                @elseif(Auth::user()->id_rol==3)
                
                    @include('layout.NavIzquierdoMesero')

                {{-- autenticado como Cocina --}}
                @elseif(Auth::user()->id_rol==4)

                    @include('layout.NavIzquierdoCocina')

                @else

                @endif

            @endif


        <section class="home-section">
            
             @include('layout.NavSuperior')

            <div >   
                @yield('contenido')
            </div>
        </section>
    </div>


    
    <script src="{{asset('js/proyecto.js')}}"></script>
    <script src="{{asset('js/sweetalert.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="" src="{{asset('js/santamaria.js')}}"></script>
    <script src="{{asset('js/jquery/jquery.js')}}"></script>
    @stack('js')

</body>
</html>