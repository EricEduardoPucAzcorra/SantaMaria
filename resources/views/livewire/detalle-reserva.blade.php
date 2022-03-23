<div>
  

    <div class="col-md-12">
        <div class="m-5">
            <h6>Detalles de reservas</h6>
            {{-- <button type="button" class="btn btn-secondary"  >
                <i class="icon-plus"></i>&nbsp;Nuevo
            </button> --}}
        </div>
        <div class="m-5">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                      <th scope="col">Fecha reserva</th>
                      <th scope="col">Habitacion</th>
                      <th scope="col">Num_reserva</th>
                      <th>Total</th>
                      <th>Opciones</th>
                  
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        
                    <tr>
                        <td>{{$detalle->fecha_registro}}</td>
                        <td>{{$detalle->num_folio}}-{{$detalle->tipo_h}}</td>
                        <td>{{$detalle->id_reserva}}</td>
                        <td>$ {{$detalle->total}}</td>
                       
                        <td>
                            <button class="btn btn-warning btn-sm" >PDF</button>
                            <!-- <button>Eliminar</button> -->
                        </td>
                    </tr>
                    @endforeach

                    {{ $detalles->links() }}
                </tbody>
            </table>
        </div>

      </div>

    </div>
</div>
