@section('style')
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
@endsection

<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

 

    <ul class="nav nav-tabs nav-justified  px-4 pt-4 " role="tablist">
                <li role="" v-on:click="comanda=0" class="fs-12"><a href="#"  class="active show">Platillos</a></li>
                <li role="" v-on:click="comanda=1" class="fs-12"><a href="#"  >Bebidas</a></li>
                <li role="" v-on:click="comanda=2" class="fs-12"><a href="#" >Carrito</a></li>
         
    </ul>

     <div class="col-xl-12 col-md-12" v-if="comanda==0">
          <div class="ms-panel">
            <div class="ms-panel-header" style="display: flex;">
              <h6>Comanda</h6> <h6 style="margin-left: 10px;">Realiza : <i class="fa-solid fa-user"></i>{{Auth::user()->usuario}}</h6>
              <h6 style="margin-left: 10px;">Fecha:</h6>
            </div>
            <div class="ms-panel-body">
              <form class="needs-validation" novalidate>
               
                <div class="form-row" style="display: flex;">
                  <div class="col-md-7 mb-3">
                    <label for="validationCustom03">Eligir producto</label>
                    <div class="input-group">
                       <div class="col-xl-12 col-md-12">
                       

                     
                     <div class="needs-validation clearfix">
                        
                            <div class="ms-form-group" id="estado">
                               <label>Num_mesa</label>
                                <select class="form-control" wire:model="id_mesa">
                                  <option value="0" disabled>Eligir mesa</option>
                                    @foreach($mesas as $mesa)
                                    <option value="{{$mesa->id_mesa}}" >{{$mesa->num_mesa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="ms-form-group" id="estado">
                                <label>Platillo</label>
                                <select class="form-control" wire:model="id_plato">
                                  <option value="0" disabled>Eligir platillo</option>
                                    @foreach($platillos as $plato)
                                     <option value="{{$plato->id_plato}}">{{$plato->nombre}} <span class="badge badge-success" >--Precio: $ {{$plato->precio}}<span></option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="ms-form-group" id="estado">
                                <label>Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" wire:model="cantidad">
                            </div>
                   
                            
                              <button type="button" class="btn btn-info" wire:click="insertproduct()">Ok</button>
                      </div>
                   </div>
                    </div>
                  </div>


                  <div class="col-md-5 mb-3 " style="margin-left: 1%;">
                     <div class="table-responsive">
                        
                        <table class="table  thead-default">
                            <thead>
                          
                              <th>Nombre</th>
                              <th>Precio</th>
                              <th>Cantidad</th>
                              <th>Opciones</th>
                            </thead>
                            <tbody>
                            @foreach($carrito as $carr => $dato)
                             <tr>
                              <td hidden=""> {{ $dato['id_plato'] }} </td>
                              <td>{{ $dato['nombre'] }} </td>
                              <td>{{ $dato['precio'] }}</td>
                              <td>{{ $dato['cantidad_plato'] }}</td>
                              <td>{{$dato['subtotal']}}</td>
                              <td><button type="button" class="btn btn-danger btn-sm btn-xs" wire:click="deleteproduct({{$carr}})"> 
                                x
                              </button></td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                        

                      <button  type="button" class="btn btn-success" wire:click="storecomanda()">Realizar comanda</button>
                  </div>
                  </div>
                 
                </div>
                
              </form>
       
            </div>
          </div>
    </div>


      
                            


  <!--   <div class="col-xl-12 col-md-12" v-if="comanda==1">
          <div class="ms-panel">
            <div class="ms-panel-header">
              <h6>Comanda refrescos</h6>
            </div>
            <div class="ms-panel-body">
              <form class="needs-validation" novalidate>
                <div class="form-row">
                  <div class="col-md-12 mb-3">
                    <label for="validationCustom03">Eligir producto</label>
                    <div class="input-group">
                       <div class="col-xl-12 col-md-12">
                        <div class="input-group">
                         <input type="text" class="form-control" id="validationCustom18" placeholder="Inserte folio o nombre" value="" >
                                
                        <a href="#" style="margin-left: 3px;"><img class="img" style="width:35px; height:35px;" src="assets/img/icons/anadir.png" alt=""></a>
                       </div>

                     
                     <div class="needs-validation clearfix">
                         
                            <div class="table-responsive">
                             
                              <table class="table  thead-primary">
                                <thead>
                                  <tr>
                                   <th scope="col">Producto</th>
                                  <th scope="col">Cantidad</th>
                                  <th scope="col">Precio</th>
                                  <th scope="col">Opciones</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <tr>
                                   
                                     <td > <a href='#' class="text-dark"> Coca-cola</a></td>
                                     <td><input type="number" class="form-control" name=""></td>
                                      <td>$ 31</td>
                             
                                      <td>
                                        <a href="#" ><img class="img" style="width:40px; height:35px;" src="assets/img/icons/boton-x.png" alt=""></a>
                                      </td>
                                  </tr>
                              
                                
                                </tbody>
                              </table>
                            </div>
                            
                       
                        </div>
                   </div>
                    </div>
                  </div>

                </div>
                
              </form>
       
            </div>
          </div>
    </div> -->
<!-- 
    <div class="col-xl-12 col-md-12" v-if="comanda==2">
      <div class="form-row">
        <div class="col-md-12 mb-3">
          <div class="needs-validation clearfix" >


                <div class="form-row " style="display: flex;">
                  <div class="col-md-2 mb-3 " >
                    <label for="">Usuario</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="user" placeholder="{{Auth::user()->usuario}}" value="{{Auth::user()->id}}" disabled>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2 mb-3" style="margin-left:10px">
                    <label for="validationCustom02">Fecha</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" value="23-11-21" disabled>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                  </div>

                   <div class="col-md-2 mb-3" style="margin-left:10px">
                    <label for="validationCustom01">N° Mesa</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="validationCustom01" placeholder="First name" value="Mesa 1" >
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                    </div>
                  </div>
                </div>
                

                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    
                    <button class="btn btn-primary mt-4 d-block w-100" type="submit">Cancelar</button>
                    
                  </div>
                  <div class="col-md-6 mb-3">
                   <button class="btn btn-primary mt-4 d-block w-100" type="submit">Realizar</button>
                  </div>
                </div>
                                  
          
          </div>
       </div>
     </div>
   </div> -->

</div>

