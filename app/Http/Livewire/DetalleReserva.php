<?php

namespace App\Http\Livewire;
use App\Models\Detalle_Reserva;
use Livewire\Component;
use Livewire\WithPagination;

class DetalleReserva extends Component
{
    use WithPagination;
 
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $detalles = Detalle_Reserva::join('habitaciones', 'detalle_reservaciones.id_habitacion', '=', 'habitaciones.id_habitacion')
        ->join('tipos_habitaciones', 'habitaciones.id_tipo', '=', 'tipos_habitaciones.id_tipo')
        ->select('detalle_reservaciones.fecha_registro','detalle_reservaciones.id_reserva','habitaciones.folio as num_folio','tipos_habitaciones.tipo as tipo_h','detalle_reservaciones.total')
        ->orderBy('id_detalle_reserva', 'desc')->paginate(5);
        return view('livewire.detalle-reserva',compact('detalles'));
    }

}
