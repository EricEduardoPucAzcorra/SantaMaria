<?php

namespace App\Http\Controllers;

use App\Models\Huesped;
use Illuminate\Http\Request;

class HuespedController extends Controller
{
   
    public function index()
    {
        //
        $huespedes = Huesped::all();

        return $huespedes;
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

  
    public function show(Huesped $huesped)
    {
        //
    }

   
    public function edit(Huesped $huesped)
    {
        //
    }

    
    public function update(Request $request, Huesped $huesped)
    {
        //
    }

    public function destroy(Huesped $huesped)
    {
        //
    }
}
