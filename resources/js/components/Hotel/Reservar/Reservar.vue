<template>
  <div class="col-md-12">
    <div class="m-5">
      <h4>Realizar reservas</h4>          
    </div>
    <div class="m-5">
      <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6" v-for="habitacion in habitaciones" :key="habitacion.id_habitacion">
            <div class="ms-card">               
              <div class="ms-card-body">

                      <div class="new">
                        <h6 class="mb-0">Habitacion {{habitacion.num_habitacion}} {{habitacion.tipo_habitaciones.tipo}}  </h6>
                        <h6 class="ms-text-primary mb-0">$ {{habitacion.precio}}</h6>
                      </div>
                      <div class="new meta">
                        <p>Folio: {{habitacion.folio}}</p>
                        <template v-if="habitacion.estado=='DISPONIBLE'">
                        <span class="badge badge-success">Disponible</span>
                        </template>

                        <template v-else-if="habitacion.estado=='OCUPADO'">
                        <span class="badge badge-danger">Ocupado</span>
                        </template>

                        <template v-else>
                        <span class="badge badge-warning">Mantenimiento</span>
                        </template>

                      </div>
                      <p>Caracteristicas : {{habitacion.caracteristicas}} </p>
                      <p>Cant. Personas : {{habitacion.num_personas}} </p>
                      <div class="new mb-0">
                        <button type="button" class="btn grid-btn mt-0 btn-sm btn-info" @click="activarModal('reserva','detalle', habitacion)">Detalles</button>
                        <template v-if="habitacion.estado=='DISPONIBLE'">

                        <button type="button" class="btn grid-btn mt-0 btn-sm color-primario" @click="activarModal('reserva','registro', habitacion)">Reservar</button>

                        </template>

                        <template v-else-if="habitacion.estado=='OCUPADO'">

                          <p>OCUPADO HOY</p>

                        </template>


                      </div>
                    </div>
                  </div>
                </div>
          </div>   
         <!-- } modal reservar -->
        <div class="modal fade"  style="display: none;" id="modal_reserva" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header color-secundario">
                <h5 class="modal-title has-icon text-white" >Reservar la habitacion</h5>
                <!-- <h5 class="modal-title has-icon text-white">ACTUALIZAR RECURSO</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarModal()">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <form>
                <div class="modal-body">
             
                  <div class="ms-form-group" hidden="">
                    <label hidden="">Habitación</label>
                    <input type="text" class="form-control" v-model="id_habitacion" >
                  </div>

                   <div class="ms-form-group" hidden="">
                    <label hidden="">Cantidad de personas</label>
                    <input type="text" class="form-control" v-model="cant_habitacion" >
                  </div>

                  <div class="ms-form-group" hidden="">
                    <label hidden="">Precio</label>
                    <input type="text" class="form-control" v-model="precio" >
                  </div>

                  <div class="ms-form-group" hidden="">
                    <label hidden="">Total</label>
                    <input type="text" hidden="" class="form-control" v-model="total" >
                  </div>

                  <div class="ms-form-group">
                    <label>Huesped</label>
                    <select name=""  class="form-control" id="select" v-model="id_huesped">
                      <option value="0" disabled>Selecione  un huesped</option>
                      <option v-bind:value="huesped.id_huesped" v-for="huesped in huespedes" :key="huesped.id_huesped">{{huesped.nombre}} {{huesped.apellidos}}</option>
                  
                    </select> 
                  
                  <div id="form" >
                      <div class="ms-form-group">
                      <label>Nombre</label>
                      <input type="text" name="" id="" class="form-control" v-model="nombre">
                      </div>
                      <div class="ms-form-group">
                        <label>Apellidos</label>
                          <input type="text" name="" id="" class="form-control" v-model="apellidos">
                      </div>

                      <div class="ms-form-group">
                        <label>INE</label>
                       <input type="text" name="" id="" class="form-control" v-model="ine">
                      </div>
                      <div class="ms-form-group">
                        <label>Telefono</label>
                       <input type="text" name="" id="" class="form-control" maxlength="10" v-model="telefono">
                      </div>
                      <div class="ms-form-group">
                        <label>Correo electronica</label>
                       <input type="email" name="" id="" class="form-control" v-model="correo">
                      </div>
                  </div>

                    <a href="#" id="agregarHuesped" @click="agregarHuesped()">Nuevo huesped</a>
                    <a href="#" id="cancelar" @click="cancelar()">Cancelar</a>
                  </div>

                  <div class="ms-form-group">
                    <label>Entrada</label>
                    <input type="date" name="" value="" id="fecha_entrada" class="form-control" v-model="fecha_entrada">
                  </div>

                  
                  <div class="ms-form-group">
                    <label>Salida</label>
                      <input type="date" name="" id="" class="form-control" v-model="fecha_salida">
                  </div>

                   <div class="ms-form-group">
                    <label>Comentario</label>
                     <textarea name="" id="" cols="3" rows="3" class="form-control" v-model="comentario"></textarea>
                  </div>
                  
                    <span class="badge badge-danger">Total a pagar: $ {{total}}</span>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light"  @click="cerrarModal()" >Cerrar</button>
                  <button type="button" class="btn color-primario shadow-none" @click="reservar()">Reservar</button>
                  <!-- <button type="button" class="btn btn-secondary shadow-none"  data-dismiss="modal">Actualizar</button> -->
                </div>
              </form>
            </div>
          </div> 
            
        </div>  

         <div class="modal fade"  style="display: none;" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header color-secundario">
                <h5 class="modal-title has-icon text-white" >Detalles de la habitacion</h5>
                <!-- <h5 class="modal-title has-icon text-white">ACTUALIZAR RECURSO</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarModalDetalle()">
                  <i class="fas fa-times"></i>
                </button>
              </div>
              <form>
                <div class="modal-body">

                      <div class="ms-form-group" >
                      <label >Folio</label>
                      <input type="text"  class="form-control" v-model="folio" disabled>
                     </div>

                      <div class="ms-form-group" >
                      <label >Número de habitación</label>
                      <input type="text"  class="form-control" v-model="num_habitacion" disabled>
                     </div>

                     <div class="ms-form-group" >
                      <label >Características</label>
                      <textarea name="" id="" cols="3" rows="3" class="form-control" v-model="caracteristicas" disabled></textarea>
                     
                     </div>

                     <div class="ms-form-group">
                      <label >Número de personas</label>
                      <input type="text"  class="form-control" v-model="num_personas" disabled >
                     </div>

                     <div class="ms-form-group" >
                      <label >Estado</label>
                      <input type="text"  class="form-control" v-model="estado" disabled >
                     </div>

                      <span class="badge badge-danger">Precio $ {{precio}}</span>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-light"  @click="cerrarModalDetalle()" >Cerrar</button>
                 
                 
                </div>
              </form>
            </div>
          </div> 
            
        </div>  
        
    </div>
</template>

<script>
    
    import moment from "moment";

    export default {
        data(){
            return{
               prueba: 'hola mundo cruel', 
               habitaciones:[],
               huespedes:[],
               //variables del huespes extenas-visual
               id_huesped:0,
               nombre:'',
               apellidos:'',
               ine:'',
               telefono:'',
               correo:'',
               //variables de la reserva
               fecha_entrada:'',
               fecha_salida:'',
               comentario:'',
               //vaibles internas
               id_habitacion:0,
               cant_habitacion:1,
               precio:0,
               total:0,
               //datos de la habitacion
               folio:'',
               num_habitacion:'',
               caracteristicas:'',
               num_personas:'',
               estado:'',
               precio:''              

            }
        },

        computed:{
           
        },

        methods: {
          // obtener_fecha_hoy(){

          // var  data = moment(new Date()).format('YYYY-MM-D');
          // console.info(data);//2021-03-12

          // },
          //traer las habitaciones
            getHabitaciones(){
            var i = this;
            let  url = '/habitaciones';
            axios.get(url).then(function (response) {
              //console.log(response);
              i.habitaciones = response.data;

            }).catch(function (error) {
              console.log(error);
            });

            },
            //traer huespedes
            gethuespedes(){
              var i = this;
            let  url = '/huespedes';
              axios.get(url).then(function (response) {
                //console.log(response);
                i.huespedes = response.data;

              }).catch(function (error) {
                console.log(error);
              });
            },
            //agregar insersion de huesped
          agregarHuesped(){
            //oculta select
            $('#select').hide();
            //boton agregar ocultar
            $('#agregarHuesped').hide();
            
            $('#cancelar').show();

            $('#form').show();
          },
          //cancelar insession de huesped
          cancelar(){
            $('#agregarHuesped').show();
            $('#select').show();
            $('#cancelar').hide();
           
            $('#form').hide();
          },
       
          activarModal(modelo, accion, data=[]){
              
               //var fecha_actual= moment().add(10, 'days').calendar();    
               switch (modelo) {
                   case 'reserva':{
                      this.gethuespedes(); 
                       switch (accion) {
                           case 'registro':{
                               //mostrar modal
                               $('#modal_reserva').modal('show');
                               $('#cancelar').hide();
                               $('#select').show();
                               $('#form').hide();
                               $('#agregarHuesped').show();
                               this.id_habitacion=data['id_habitacion'];    
                               this.precio =data['precio'];
                               this.total = data['precio'];
                               this.id_huesped=0;
                              //  this.fecha_actual = moment(new Date()).format('D/MM/YYYY');
                              this.fecha_entrada= ''; 
                              this.fecha_salida='';
                              this.comentario='';
                              this.nombre='';
                              this.apellidos='';
                              this.ine='';
                              this.telefono='';
                              this.correo='';
                               break;
                           }
                           case 'detalle':{
                                $('#modal_detalle').modal('show');
                                  this.folio=data['folio'];
                                  this.num_habitacion=data['num_habitacion'];
                                  this.caracteristicas=data['caracteristicas'];
                                  this.num_personas=data['num_personas'];
                                  this.estado=data['estado'];
                                 this.precio=data['precio'];
                               break;
                           }

                       }
                   }
               }
            
            },
            //permite cerar el modal
              cerrarModal(){
              $('#modal_reserva').modal('hide');
              this.nombre='';
              this.apellidos='';
              this.ine='';
              this.telefono='';
              this.correo='';
              this.id_huesped=0;
              this.id_habitacion='';
              this.cant_habitacion='';
              this.precio='';
              this.total='';
              this.fecha_entrada='';
              this.fecha_salida='';
              this.comentario='';
            },
            cerrarModalDetalle(){
              $('#modal_detalle').modal('hide');
            },
            validarCampos(){

            },
            //metodo que permite reallizar la reserva
            reservar(){
              if(this.id_huesped!=0){ 
                //console.log('ha selecionado una id de huesped');
                  var i = this;

                  var estado = 'ACEPTADO';
                  //let  url = '/reservars';
                    axios.post('/reservars',{
                      'fecha_entrada':this.fecha_entrada,
                      'fecha_salida':this.fecha_salida,
                      'comentario':this.comentario,
                      'id_huesped':this.id_huesped,
                      'id_habitacion':this.id_habitacion,
                      'cant_habitacion':this.cant_habitacion,
                      'estado':estado,
                      'precio':this.precio,
                      'total':this.total
                    }).then(function (response) {
                     //console.log(response.data);
                     //oculta modal
                     $('#modal_reserva').modal('hide');
                     //deja vacio los campos
                     //cambia el estado de la habitacion
                      i.updateestadoH();     
                      this.nombre='';
                      this.apellidos='';
                      this.ine='';
                      this.telefono='';
                      this.correo='';
                      this.id_huesped=0;
                      this.id_habitacion='';
                      this.cant_habitacion='';
                      this.precio='';
                      this.total='';
                      this.fecha_entrada='';
                      this.fecha_salida='';
                      this.comentario='';
                      
                    }).catch(function (error) {
                      console.log(error);
                    });

                    
              }else{
                 var i = this;
                  var estado = 'ACEPTADO';
                  //let  url = '/reservars';
                    axios.post('/reservars',{
                      'nombre':this.nombre,
                      'apellidos':this.apellidos,
                      'ine':this.ine,
                      'telefono':this.telefono,
                      'correo':this.correo,
                      'fecha_entrada':this.fecha_entrada,
                      'fecha_salida':this.fecha_salida,
                      'comentario':this.comentario,
                      // 'id_huesped':this.id_huesped,
                      'id_habitacion':this.id_habitacion,
                      'cant_habitacion':this.cant_habitacion,
                      'estado':estado,
                      'precio':this.precio,
                      'total':this.total
                    }).then(function (response) {
                     //console.log(response.data);
                     //oculta modal
                      $('#modal_reserva').modal('hide');
                      
                      //cambia estado de la habitacion
                      i.updateestadoH();
                      //deja cvacio los campos
                      this.nombre='';
                      this.apellidos='';
                      this.ine='';
                      this.telefono='';
                      this.correo='';
                      this.id_huesped=0;
                      this.id_habitacion='';
                      this.cant_habitacion='';
                      this.precio='';
                      this.total='';
                      this.fecha_entrada='';
                      this.fecha_salida='';
                      this.comentario='';

                      i.gethuespedes();
                      
                    }).catch(function (error) {
                      console.log(error);
                    });
                 //console.log('de alta nuevo huesped');
              }

            },
             updateestadoH(){
              let i = this;
              let est = 'OCUPADO';
               axios.put('/cambiarestado',{
                      'estado':est,
                      'id_habitacion':this.id_habitacion,
                    }).then(function (response) {
                     i.getHabitaciones();
                    }).catch(function (error) {
                      console.log(error);
                });
            },
          
         },
                
        mounted() {
           this.getHabitaciones();
          //  this.obtener_fecha_hoy();
        }
    }
</script> 
