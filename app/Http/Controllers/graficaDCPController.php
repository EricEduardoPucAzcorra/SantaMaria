<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class graficaDCPController extends Controller
{

    private $array=[];

    public function getDetalles_CP(){

        $etiquetas=DB::select("SELECT DISTINCT(created_at),id_detalle_comandaP  FROM detalle_comanda_platillos");
        $etiqueta= $etiquetas[0];
        $mes=substr($etiqueta->created_at,5,2);
        $annio=substr($etiqueta->created_at,0,4);


        //array capturador
        $labels = [];

        //recorro el array {} 
        foreach ($etiquetas as $etiqueta) {
            //insertos datos en un array
            if($mes=="01")$mes_n = "Enero";
            if($mes=="02")$mes_n = "Febrero";
            if($mes=="03")$mes_n = "Marzo";
            if($mes=="04")$mes_n = "Abril";
            if($mes=="05")$mes_n = "Mayo";
            if($mes=="06")$mes_n = "Junio";
            if($mes=="07")$mes_n = "Julio";
            if($mes=="08")$mes_n = "Agosto";
            if($mes=="09")$mes_n = "Septiembre";
            if($mes=="10")$mes_n = "Octubre";
            if($mes=="11")$mes_n = "Noviembre";
            if($mes=="12")$mes_n = "Diciembre";

            array_push($labels, $etiqueta=$annio);
            // array_push($labels, $etiqueta->id_detalle_comandaP);

        }

        //return $labels;

        $serie1 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='01'");
        //array capturador
        $sers1 = [];
        //convertimos enun array plano
        foreach ($serie1 as $ser1) {
            array_push($sers1, $ser1->total);
        }

        $serie2 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='02'");
        //array capturador
        $sers2 = [];
        //convertimos enun array plano
        foreach ($serie2 as $ser2) {
            array_push($sers2, $ser2->total);
        }

        $serie3 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='03'");
        //array capturador
        $sers3 = [];
        //convertimos enun array plano
        foreach ($serie3 as $ser3) {
            array_push($sers3, $ser3->total);
        }

        $serie4 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='04'");
        //array capturador
        $sers4 = [];
        //convertimos enun array plano
        foreach ($serie4 as $ser4) {
            array_push($sers4, $ser4->total);
        }

        $serie5 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='05'");
        //array capturador
        $sers5 = [];
        //convertimos enun array plano
        foreach ($serie5 as $ser5) {
            array_push($sers5, $ser5->total);
        }

        $serie6 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='06'");
        //array capturador
        $sers6 = [];
        //convertimos enun array plano
        foreach ($serie6 as $ser6) {
            array_push($sers6, $ser6->total);
        }

        $serie7 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='07'");
        //array capturador
        $sers7 = [];
        //convertimos enun array plano
        foreach ($serie7 as $ser7) {
            array_push($sers7, $ser7->total);
        }

        $serie8 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='08'");
        //array capturador
        $sers8 = [];
        //convertimos enun array plano
        foreach ($serie8 as $ser8) {
            array_push($sers8, $ser8->total);
        }

        $serie9 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='09'");
        //array capturador
        $sers9 = [];
        //convertimos enun array plano
        foreach ($serie9 as $ser9) {
            array_push($sers9, $ser9->total);
        }

        $serie10 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='10'");
        //array capturador
        $sers10 = [];
        //convertimos enun array plano
        foreach ($serie10 as $ser10) {
            array_push($sers10, $ser10->total);
        }

        $serie11 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='11'");
        //array capturador
        $sers11 = [];
        //convertimos enun array plano
        foreach ($serie11 as $ser11) {
            array_push($sers11, $ser11->total);
        }

        $serie12 = DB::select("SELECT total FROM detalle_comanda_platillos WHERE $mes='12'");
        //array capturador
        $sers12 = [];
        //convertimos enun array plano
        foreach ($serie12 as $ser12) {
            array_push($sers12, $ser12->total);
        }

       


        $detalles = [
            'labels' => $labels,
            'serie1' => $sers1,
            'serie2' => $sers2,
            'serie3' => $sers3, 
            'serie4' => $sers4,         
            'serie5' => $sers5,         
            'serie6' => $sers6,         
            'serie7' => $sers7,         
            'serie8' => $sers8,         
            'serie9' => $sers9,         
            'serie10' => $sers10,
            'serie11' => $sers11,         
            'serie12' => $sers12,         



        ];

        return $detalles;
    }
}
