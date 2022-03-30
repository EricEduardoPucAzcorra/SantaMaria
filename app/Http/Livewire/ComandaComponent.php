<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Platillo;

use App\Models\Mesa;

use App\Models\Comanda;

use App\Models\Detalle_comanda_platillo;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ComandaComponent extends Component
{
    //array
    public $carrito, $detalles;
    //variables

    public $id_comanda, $folio_comanda, $fecha_comanda, $descuento,  $descripcion, $id_usuario, $estado, $id_mesa, $id_plato, $cantidad, $nota, $importe;
    public $total;

    
    protected $rules = [
            'folio_comanda' => 'required|min:10',
            'fecha_comanda' => 'required',
            'descuento' => 'nullable',
            'estado'=>'required|string',
            'descripcion' => 'string',
            'id_mesa' => 'required',
            'id_usuario' => 'required'
        ];




     public function mount()
    {
        //inicializar variables
        $this->carrito=[];
        $this->detalles=[];
        $this->id_mesa=0;
        $this->id_plato=0;
        $this->cantidad=1;

        $this->folio_comanda='C-R';
        $this->fecha_comanda='2022-03-29';
        $this->descuento=0;
        $this->estado='ACEPTADO';
        $this->descripcion='Null';
        $this->id_usuario=Auth::user()->id_usuario;
        $this->precio='';
        $this->nota='';
        $this->importe=0;
    }

    public function insertproduct(){

        $platillos = Platillo::find($this->id_plato);

        $precio = $platillos->precio;

        $total = $precio * $this->cantidad;

        $this->total = $total;

        array_push($this->carrito, ['id_plato' => $platillos->id_plato, 'nombre'=>$platillos->nombre, 'precio'=>$platillos->precio, 'cantidad_plato' => $this->cantidad,  'subtotal'=>$total]);   

        dd($this->carrito);

        
    }

    public function deleteproduct($carr){

      array_splice($this->carrito,$carr,1); 

      //dd($carr);
     
    }

    public function storecomanda(){

        
        try{
            //hagotransaccion
            DB::beginTransaction();
        //checar el validate
        //$this->validate();

        $comanda_folio = mt_srand(5);        

        $comanda = Comanda::create([
            'id_comanda' => $this->id_comanda,
            'folio_comanda'=>$this->folio_comanda.'-'.$this->id_usuario.'-'.$this->id_mesa.'-'.$this->fecha_comanda,
            'fecha_comanda'=>$this->fecha_comanda,
            'descuento'=>$this->descuento,
            'estado'=>$this->estado,
            'descripcion'=>$this->descripcion,
            'id_mesa'=>$this->id_mesa,
            'id_usuario'=>$this->id_usuario
        ]);

        $id_comanda = $comanda->id_comanda;

        $id_plato= $this->id_plato;

        $filas =[];

            for ($i=0; $i <count($this->detalle) ; $i++) { 
                $filas[]=[
                'id_plato' => $this->id_plato[$i],
                'id_comanda'=> $id_comanda,
                'cantidad_plato'=> $this->cantidad,
                'importe'=>$this->importe,
                'subtotal'=>$this->total,
                'total'=>$this->total,
                'nota'=>$this->nota     
                ];

            }

        
        dd($filas);
        
        //DB::table('detalle_comanda_platillos')->insert($this->detalles);


        DB::commit();

        return 'La cita fue exitosa';

        } catch(Exception $e){
            //muestro errors
            DB::rollBack();

             return 'La cita fue fallida';
        }

        
    }
   

    public function render()
    {
        $platillos = Platillo::all();

        $mesas = Mesa::where('estado','=','DISPONIBLE')->get();
        //si maneja carpetas hay que enteder la plantilla al compontente
        return view('livewire.comanda-component', [
            'platillos'=>$platillos,
            'carrito' =>$this->carrito,
            'mesas' =>$mesas
        ])
        ->extends('layout.SysPlantilla')
        ->section('contenido');

    }
    


}
