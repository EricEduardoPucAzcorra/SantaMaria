<div>

    @php
    use Carbon\Carbon;

    // Carbon::setLocale('es');

    // $date = Carbon::now();

    $date = Carbon::now()->locale('es');

   $date->diffForHumans();

    $fecha = $date->format('l jS \\of F Y h:i:s A');

    
    @endphp

    <center><h5 style="margin-top: 10px;">Bienvenido {{Auth::user()->usuario}}</h5></center>

    <tt style="margin-left: 5%;">{{$fecha}}</tt>

   

    

    <detalles_reservar-component></detalles_reservar-component>

</div>