@extends('layout.admin')
@section('title','Almacen de materiales')

@section('content')
 
<main class="body-content" >

    @include('layout.navbar_top')

  <div class="ms-content-wrapper">

     <nav aria-label="breadcrumb" class="new">
          <ol class="breadcrumb pl-0">
            <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i> Home</a></li>
            <li class="breadcrumb-item"><a href="#">Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
          </ol>
    </nav>


    {{-- agrego el componente vue js --}}
    <almacen-component></almacen-component>
    
  
  </div>

</main>

@endsection