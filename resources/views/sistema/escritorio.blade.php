<div>

    @php
    use Carbon\Carbon;

    // Carbon::setLocale('es');

    // $date = Carbon::now();

    $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha = $diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

    @endphp

    <center><h5 style="margin-top: 10px;">Bienvenido {{Auth::user()->usuario}}</h5></center>

    <tt style="margin-left: 5%;"><span style="font-family:Arial, Helvetica, sans-serif">{{$fecha}}</span></tt>

   

    

    <detalles_reservar-component></detalles_reservar-component>

</div>