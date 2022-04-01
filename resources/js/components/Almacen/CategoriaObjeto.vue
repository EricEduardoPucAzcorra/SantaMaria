<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3>Categorías objetos</h3>
            <button type="button" class="btn color-primario" v-on:click="activarModal('categoria','registrar')" >
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripción</th>
                      <th>Estado</th>
                       <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="categoria in cat_objetos" :key="categoria.id_categoria_obj">
                        <td>{{categoria.id_categoria_obj}}</td>
                        <td>{{categoria.nombre}}</td>
                        <td>{{categoria.descripcion}}</td>    
                        <td>
                            <template v-if="categoria.condicion">
                                <span class="badge badge-success">Activo</span> 
                            </template>
                            <template v-else>      
                                <span class="badge badge-light">Inactivo</span> 
                            </template>
                        </td>
                        <td>
                            <button  class="btn btn-sm btn-outline-success" type="button" @click="activarModal('categoria','actualizar', categoria)">
                                <i class="fas fa-pen"></i> Editar
                            </button>
                            <template v-if="categoria.condicion">    
                                <button type="button"  @click="desactivar(categoria.id_categoria_obj)" class="btn btn-outline-light">
                                    <i class="fas fa-arrow-down"></i> Desactivar
                                </button>
                            </template>
                            <template v-else>     
                                <button type="button" @click="activar(categoria.id_categoria_obj)" class="btn btn-outline-warning">
                                   <i class="fas fa-arrow-up"></i> Activar
                                </button>     
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Notes Modal -->
        <div class="modal fade"  style="display: none;" id="modal_categoria" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header color-secundario">
                        <h5 class="modal-title" v-if="bandera==true">REGISTRAR CATEGORÍA</h5>
                        <h5 class="modal-title" v-if="bandera==false">ACTUALIZAR CATEGORÍA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="ms-form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" v-model="nombre">
                            </div>
                            <div class="ms-form-group">
                                <label>Descripcion</label>
                                <textarea name="" id="" class="form-control" v-model="descripcion"></textarea>
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
                            <button type="button" class="btn color-primario shadow-none" v-if="bandera==true" @click="registrarCategoria()" >Registrar</button>
                            <button type="button" class="btn color-primario shadow-none" v-if="bandera==false" @click="actualizarCategoria()" data-dismiss="modal">Actualizar</button>
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
                title: '¿Quieres activar la categoria?',
                text: "",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#f31809',
                cancelButtonColor: '#6c757d',
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
                        Swal.fire({
                        title:'Se activó',
                        text:"La categoria fue activada con exito",
                        icon:'success',
                        confirmButtonColor:'#f31809'
                        })
                    });  
                }
                });
            },
           
           desactivar(id){
                 let cargar = this;
                 let url = '/categoria_objetos/desactivar';

                Swal.fire({
                title: '¿Quieres desactivar la categoria?',
                text: "",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#f31809',
                cancelButtonColor: '#6c757d',
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
                        Swal.fire({
                        title:"Se desactivó",
                        text:"la categoria fue desactivada",
                        icon:'success',
                        confirmButtonColor:'#f31809'
                        })
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



