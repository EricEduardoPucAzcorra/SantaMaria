<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3>Habitaciones</h3>
            <button type="button" class="btn color-primario" v-on:click="activarModal('habitacion','registrar')" >
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Folio</th>
                      <th scope="col">Tipo</th>
                      <th>Número de habitación</th>
                      <th>Precio</th>
                      <th>Características</th>
                      <th>Número de piso</th>
                      <th>Número de personas</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="habitacion in habitaciones" :key="habitacion.id_habitacion">
                        <td>{{habitacion.id_habitacion}}</td>
                        <td>{{habitacion.folio}}</td>
                        <td>{{habitacion.tipo_habitaciones.tipo}}</td>
                        <td>{{habitacion.num_habitacion}}</td>
                        <td>$ {{habitacion.precio}}</td>    
                        <td>{{habitacion.caracteristicas}}</td>    
                        <td>{{habitacion.num_piso}}</td>    
                        <td>{{habitacion.num_personas}}</td>    
                        <td>{{habitacion.estado}}</td>
                        <td>
                            <button class="btn btn-outline-success" @click="activarModal('habitacion','actualizar',habitacion)">
                               <i class="fas fa-pen"></i> Editar
                            </button>
                            <!-- <button>Eliminar</button> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Notes Modal -->
        <div class="modal fade"  style="display: none;" id="modal_habitacion" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header color-secundario">
                        <h5 class="modal-title" v-if="bandera==true">REGISTRAR HABITACIÓN</h5>
                        <h5 class="modal-title" v-if="bandera==false">ACTUALIZAR HABITACIÓN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="ms-form-group">
                                <label>Folio</label>
                                <input type="text" class="form-control" v-model="folio">
                            </div>
                            <div class="ms-form-group">
                                <label>Tipo de habitación</label>
                                <select class="form-control" v-model="id_tipo">
                                    <option value="0" disabled>Selecione un un tipo</option>
                                    <option v-for="tipo in tiposH" :key="tipo.id_tipo" v-bind:value="tipo.id_tipo">{{tipo.tipo}}</option>
                                </select>
                            </div>
                            <div class="ms-form-group" id="estado">
                                <label>Estado</label>
                                <select class="form-control" v-model="estado">
                                    <option value="0" disabled>Selecione un estado</option>
                                    <option value="DISPONIBLE">DISPONIBLE</option>
                                    <option value="OCUPADO">OCUPADO</option>
                                    <option value="MANTENIMIENTO">MANTENIMIENTO</option>
                                </select>
                            </div>
                            <div class="ms-form-group">
                                <label>Número de habitación</label>
                                <input type="number" class="form-control" v-model="num_habitacion">
                            </div>          
                            <div class="ms-form-group">
                                <label>Precio</label>
                                <input type="text" class="form-control" v-model="precio">
                            </div>
                            <div class="ms-form-group">
                                    <label>Características</label>
                                    <textarea name="" id="" cols="3" rows="3" class="form-control" v-model="caracteristicas"></textarea>
                            </div>
                            <div class="ms-form-group">
                                <label>Número de piso</label>
                                <input type="number" class="form-control" v-model="num_piso">
                            </div>
                            <div class="ms-form-group">
                                <label>Número de personas</label>
                                    <input type="number" class="form-control" v-model="num_personas">
                                </div>
                            </div>
                            <!-- validacion de campos -->
                            <div v-show="mostrarError" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errormensaje" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" @click="cerrarmodal()">Cerrar</button>
                                <button type="button" class="btn color-primario" v-if="bandera==true" @click="registrarHabitacion()" >Registrar</button>
                                <button type="button" class="btn color-primario" v-if="bandera==false" @click="actualizarHabitacion()" data-dismiss="modal">Actualizar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
               id_habitacion:0,
               prueba: 'hola mundo cruel', 
               habitaciones:[],
               tiposH:[],
               folio:'',
               id_tipo:0,
               num_habitacion:0,
               precio:0,
               caracteristicas:'',
               num_piso:0,
               num_personas:0,
               estado:'',
               bandera:false,
               mostrarError: 0,
               errormensaje:[],
            }
        },

        computed:{

        },

        methods: {
            getHabitaciones(){

                let cap = this;

                axios.get('/habitaciones').then(function (response) {

                    let respuesta = response.data;

                    cap.habitaciones = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            gettiposH(){
                let cap = this;

                axios.get('/tipos_habitaciones').then(function (response) {

                    let respuesta = response.data;

                    cap.tiposH = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
  
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                   case 'habitacion':{
                       this.gettiposH();
                       switch (accion) {
                           case 'registrar':{
                               //mostrar modal
                               $('#modal_habitacion').modal('show');
                                    this.folio='';
                                    this.id_tipo=0;
                                    this.num_habitacion=0;
                                    this.precio=0;
                                    this.caracteristicas='';
                                    this.num_piso='';
                                    this.num_personas='';
                                    this.estado='';
                                    $('#estado').hide();
                                    this.bandera=true;
                               break;
                           }
                           case 'actualizar':{
                                $('#modal_habitacion').modal('show');
                                this.id_habitacion=data['id_habitacion'];
                                this.folio=data['folio'];
                                this.id_tipo=data['id_tipo'];
                                this.num_habitacion=data['num_habitacion'];
                                this.precio=data['precio'];
                                this.caracteristicas=data['caracteristicas'];
                                this.num_piso=data['num_piso'];
                                this.num_personas=data['num_personas'];
                                this.estado=data['estado'];
                                $('#estado').show();
                                this.bandera=false;
                              
                        
                               break;
                           }

                       }
                   }
               }
            
            },

            validarinput(){
                
                //iniciañlizo variables
                this.mostrarError=0;
                this.errormensaje=[];
                //analixo o pcmprbo si tiene valor el campo nombre
             
                if(!this.nombre) this.errormensaje.push("El nombre es requerido");
               
                //muestro error
                if(this.errormensaje.length) this.mostrarError=1;
                //retorno el rror 
                return this.mostrarError;
            },

            cerrarmodal(){
                
                $('#modal_habitacion').modal('hide');
                  this.folio="";
                  this.id_tipo="";
                  this.num_habitacion="";
                  this.precio=0;
                  this.caracteristicas="";
                  this.num_piso="";
                  this.num_personas="";
                  this.estado="";
                this.errormensaje=0;
            },
            registrarHabitacion(){

                // if (this.validarinput()) {
                //     return;
                // }

                let cargar = this;
                let url = '/habitacion/registrar';

                let estado = 'DISPONIBLE';

                axios.post(url,{
                    'folio' : this.folio,
                    'id_tipo' : this.id_tipo,
                    'num_habitacion' : this.num_habitacion,
                    'precio' : this.precio,
                    'caracteristicas' : this.caracteristicas,
                    'num_piso':this.num_piso,
                    'num_personas':this.num_personas,
                    'estado' : estado
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_habitacion').modal('hide');
                   
                  //actualizatabla
                  cargar.getHabitaciones();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },
            actualizarHabitacion(){
                //  if (this.validarinput()) {
                //     return;
                // }

                let cargar = this;
                let url = '/habitacion/actualizar';

                axios.put(url,{
                    'folio' : this.folio,
                    'id_tipo' : this.id_tipo,
                    'num_habitacion' : this.num_habitacion,
                    'precio' : this.precio,
                    'caracteristicas' : this.caracteristicas,
                    'num_piso':this.num_piso,
                    'num_personas':this.num_personas,
                    'estado' : this.estado,
                    'id_habitacion' :this.id_habitacion
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_habitacion').modal('hide');

                  //actualizatabla
                  cargar.getHabitaciones();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },

            activar(id){
                 let cargar = this;
                 let url = '/categoria_objetos/activar';

                Swal.fire({
                title: 'Quieres activar la categoria',
                text: "",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Activar',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    let estado = 1;
                    //realizo peticion
                    axios.put('/categoria_objetos/activar',{
                        'condicion': estado,
                        'id_categoria_obj' : id
                    }).then(function (json) {
                        cargar.getCategoriasObjetos();
                        Swal.fire(
                        'Se activo',
                        'El articulo fue activada con exito',
                        'success'
                        )
                    });  
                }
                });
            },
           
           desactivar(id){
                 let cargar = this;
                 let url = '/categoria_objetos/desactivar';

                Swal.fire({
                title: 'Quieres desactivar la categoria',
                text: "",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Desactivar',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    let estado = 0;
                    //realizo peticion
                    axios.put('/categoria_objetos/desactivar',{
                        'condicion': estado,
                        'id_categoria_obj' : id
                    }).then(function (json) {
                        cargar.getCategoriasObjetos();
                        Swal.fire(
                        'Se desactivo',
                        'la categoria fue desactivada',
                        'success'
                        )
                    });  
                }
                });
            }

        },

        mounted() {
           this.getHabitaciones();

        }
    }
</script>



