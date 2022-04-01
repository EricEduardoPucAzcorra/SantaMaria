<template>
    <div class="col-md-12">
        <div class="m-5">
            <h4>Mesas</h4>
            <button type="button" class="btn color-primario" v-on:click="activarModal('mesa','registrar')" >
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Número de Mesa</th>
                      <th>Estado</th>
                       <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="mesa in mesas" :key="mesa.id_mesa">
                        <td>{{mesa.id_mesa}}</td>
                        <td>{{mesa.num_mesa}}</td>
                        <td>{{mesa.estado}}</td>
                        <td>
                            <button  class="btn btn-outline-success" type="button" @click="activarModal('mesa','actualizar', mesa)"> <i class="fas fa-pen"></i> Editar</button>
                            <!-- <template v-if="mesa.condicion">    
                                <button type="button"  @click="desactivar(mesa.id_mesa)" class="btn btn-danger">Desactivar</button>
                            </template>
                            <template v-else>     
                                <button type="button" @click="activar(mesa.id_mesa)" class="btn btn-success">Activar</button>     
                            </template> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Notes Modal -->
        <div class="modal fade"  style="display: none;" id="modal_mesa" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header color-secundario">
                        <h5 class="modal-title has-icon text-white" v-if="bandera==true">REGISTRO MESA</h5>
                        <h5 class="modal-title has-icon text-white" v-if="bandera==false">ACTUALIZAR MESA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="ms-form-group">
                                <label>Mesa</label>
                                <input type="text" class="form-control" v-model="num_mesa">
                            </div>
                            <div class="ms-form-group">
                                <label>Estado</label>
                                <select class="form-control" v-model="estado">
                                    <option value="DISPONIBLE">DISPONIBLE</option>
                                    <option value="NO DISPONIBLE">NO DISPONIBLE</option>
                                </select>
                            </div>
                            <!-- validacion de campos -->
                            <div v-show="mostrarError" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errormensaje" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" @click="cerrarmodal()">Cerrar</button>
                                <button type="button" class="btn color-primario shadow-none" v-if="bandera==true" @click="registrarmesa()" >Registrar</button>
                                <button type="button" class="btn color-primario shadow-none" v-if="bandera==false" @click="actualizarmesa()" data-dismiss="modal">Actualizar</button>
                            </div>
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
               id_mesa:0,
               prueba: 'hola mundo cruel', 
               mesas:[],
               num_mesa:'',
               estado:'',
               bandera:false,
               selec_selects:[],
               mostrarError: 0,
               errormensaje:[],
            }
        },

        computed:{

        },

        methods: {
            getmesasObjetos(){

                let cap = this;

                axios.get('/getmesas').then(function (response) {

                    let respuesta = response.data;

                    cap.mesas = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
  
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                   case 'mesa':{
                       
                       switch (accion) {
                           case 'registrar':{
                               //mostrar modal
                               $('#modal_mesa').modal('show');
                                    this.num_mesa='';
                                    this.estado='';    
                                    this.bandera=true;
                               break;
                           }
                           case 'actualizar':{
                                $('#modal_mesa').modal('show');
                                this.bandera=false;
                                this.id_mesa = data['id_mesa'];
                                this.num_mesa = data['num_mesa'];
                                this.estado = data['estado'];
                        
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
             
                if(!this.num_mesa) this.errormensaje.push("El numero de mesa es requerido");
               
                //muestro error
                if(this.errormensaje.length) this.mostrarError=1;
                //retorno el rror 
                return this.mostrarError;
            },

            cerrarmodal(){
                
                $('#modal_mesa').modal('hide');
                this.num_mesa='';
                this.estado='';
                this.errormensaje=0;
            },
            registrarmesa(){

                if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/mesa/registrar';

                axios.post(url,{
                    'num_mesa' : this.nombre,
                    'estado' : this.estado,
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_mesa').modal('hide');
                   
                  //actualizatabla
                  cargar.getmesasObjetos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },
            actualizarmesa(){
                 if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/mesa/actualizar';

                axios.put(url,{
                    'num_mesa' : this.num_mesa,
                    'estado' : this.estado,
                    'id_mesa' : this.id_mesa
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_mesa').modal('hide');
 
                  //actualizatabla
                  cargar.getmesasObjetos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },

            activar(id){
                 let cargar = this;
                 let url = '/mesa/activar';

                Swal.fire({
                title: 'Quieres activar la mesa',
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
                    axios.put('/mesaetos/activar',{
                        'condicion': estado,
                        'id_mesa' : id
                    }).then(function (json) {
                        cargar.getmesasObjetos();
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
                 let url = '/mesaetos/desactivar';

                Swal.fire({
                title: 'Quieres desactivar la mesa',
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
                    axios.put('/mesaetos/desactivar',{
                        'condicion': estado,
                        'id_mesa' : id
                    }).then(function (json) {
                        cargar.getmesasObjetos();
                        Swal.fire(
                        'Se desactivo',
                        'la mesa fue desactivada',
                        'success'
                        )
                    });  
                }
                });
            }

        },

        mounted() {
           this.getmesasObjetos();

        }
    }
</script>



