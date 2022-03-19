<template>
    <div class="col-md-12">
        <div class="m-5">
            <h6>Categorias materiales</h6>
            <button type="button" class="btn btn-secondary" v-on:click="activarModal('categoria','registrar')" >
                <i class="icon-plus"></i>&nbsp;Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripcion</th>
                      <th>Estado</th>
                       <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="categoria in cat_objetos" :key="categoria.id_categoria_obj">
                        <td>{{categoria.id_categoria_obj}}</td>
                        <td>{{categoria.nombre}}</td>
                        <td>{{categoria.descripcion}}</td>    
                        <td>
                            <template v-if="categoria.condicion">
                                Activo  
                            </template>
                            <template v-else>      
                                Inactivo 
                            </template>
                        </td>
                        <td>
                            <button  class="btn btn-info" type="button" @click="activarModal('categoria','actualizar', categoria)">Editar</button>
                            <template v-if="categoria.condicion">    
                                <button type="button"  @click="desactivar(categoria.id_categoria_obj)" class="btn btn-danger">Desactivar</button>
                            </template>
                            <template v-else>     
                                <button type="button" @click="activar(categoria.id_categoria_obj)" class="btn btn-success">Activar</button>     
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Notes Modal -->
         <div class="modal fade"  style="display: none;" id="modal_categoria" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h5 class="modal-title has-icon text-white" v-if="bandera==true">REGISTRAR CATEGORIA</h5>
              <h5 class="modal-title has-icon text-white" v-if="bandera==false">ACTUALIZAR CATEGORIA</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()"><span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <div class="ms-form-group">
                  <label>Nombre</label>
                  <input type="text" placeholder="Nombre del articulo" class="form-control" v-model="nombre">
                </div>

                <div class="ms-form-group">
                  <label>Descripcion</label>
                  <textarea name="" id="" class="form-control" v-model="descripcion" placeholder="Escriba la descripcion"></textarea>
                </div>
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
                <button type="button" class="btn btn-secondary shadow-none" v-if="bandera==true" @click="registrarCategoria()" >Registrar</button>
                 <button type="button" class="btn btn-secondary shadow-none" v-if="bandera==false" @click="actualizarCategoria()" data-dismiss="modal">Actualizar</button>
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
               id_categoria:0,
               prueba: 'hola mundo cruel', 
               cat_objetos:[],
               nombre:'',
               descripcion:'',
               bandera:false,
               cat_selects:[],
               mostrarError: 0,
               errormensaje:[],
            }
        },

        computed:{

        },

        methods: {
            getCategoriasObjetos(){

                let cap = this;

                axios.get('/categoria_objetos').then(function (response) {

                    let respuesta = response.data;

                    cap.cat_objetos = respuesta.categorias.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
  
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                   case 'categoria':{
                       
                       switch (accion) {
                           case 'registrar':{
                               //mostrar modal
                               $('#modal_categoria').modal('show');
                                    this.nombre='';
                                    this.descripcion='';
                                   
                                    this.bandera=true;
                               break;
                           }
                           case 'actualizar':{
                                $('#modal_categoria').modal('show');
                                this.bandera=false;
                                this.id_categoria = data['id_categoria_obj'];
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                        
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
                
                $('#modal_categoria').modal('hide');
                this.nombre='';
                this.descripcion='';
                this.errormensaje=0;
            },
            registrarCategoria(){

                if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/categoria_objetos/registrar';

                axios.post(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'id_categoria_obj' : this.id_categoria
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_categoria').modal('hide');
                   
                  //actualizatabla
                  cargar.getCategoriasObjetos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },
            actualizarCategoria(){
                 if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/categoria_objetos/actualizar';

                axios.put(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'id_categoria_obj' : this.id_categoria
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_categoria').modal('hide');

                  
                  //actualizatabla
                  cargar.getCategoriasObjetos();
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
           this.getCategoriasObjetos();

        }
    }
</script>



