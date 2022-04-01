<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3>Productos</h3>
            <button type="button" class="btn color-primario" v-on:click="activarModal('platillo','registrar')" >
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                      <th scope="col">Folio</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripción</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Precio</th>
                      <th>Estado</th>
                       <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                       
                    <tr v-for="platillos in platillos" :key="platillos.id_plato">
                        <td>{{platillos.folio}}</td>
                        <td>{{platillos.nombre}}</td>
                        <td>{{platillos.descripcion}}</td>
                        <td>{{platillos.categorias.nombre}}</td>
                        <td>{{platillos.precio}}</td>
                        <!-- <td>{{platillos.estado}}</td>     -->
                        <td>
                            <template v-if="platillos.estado">
                               <span class="badge badge-success">Activo</span>  
                            </template>
                            <template v-else>      
                               <span class="badge badge-light">Inactivo</span>
                            </template>
                        </td>
                        <td>
                            <button  class="btn btn-sm btn-outline-success" type="button" @click="activarModal('platillo','actualizar', platillos)">
                                <i class="fas fa-pen"></i> Editar
                            </button>
                            <template v-if="platillos.estado">    
                                <button type="button"  @click="desactivar(platillos.id_plato)" class="btn btn-outline-light">
                                    <i class="fas fa-arrow-down"></i> Desactivar
                                </button>
                            </template>
                            <template v-else>     
                                <button type="button" @click="activar(platillos.id_plato)" class="btn btn-outline-warning">
                                   <i class="fas fa-arrow-up"></i> Activar
                                </button>     
                            </template>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Notes Modal -->
         <div class="modal fade"  style="display: none;" id="modal_platillo" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header color-secundario">
              <h5 class="modal-title" v-if="bandera==true">REGISTRAR PLATILLO</h5>
              <h5 class="modal-title" v-if="bandera==false">ACTUALIZAR PLATILLO</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()">
                  <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                <div class="ms-form-group">
                  <label>Nombre</label>
                  <input type="text" placeholder="Nombre del articulo" class="form-control" v-model="nombre">
                </div>

                <div class="ms-form-group">
                  <label>Folio</label>
                  <input type="text" placeholder="folio" class="form-control" v-model="folio">
                </div>

                <div class="ms-form-group">
                  <label>Descripcion</label>
                  <textarea name="" id="" class="form-control" v-model="descripcion" placeholder="Descripcion"></textarea>
                  
                </div>
<!-- <input type="number" placeholder="precio" class="form-control" v-model="id_plato"> -->


                <div class="ms-form-group">
                  <label>Precio</label>
                      <input type="number" placeholder="precio" class="form-control" v-model="precio">
                </div>

                 <div class="ms-form-group">
                  <label>Categoria</label>
                  <select v-model="id_categoriaP" class="form-control">
                      <option value="0" disabled >Eligir categoria</option>
                      <option  v-for="categoria in categorias" :key="categoria.id_categoriaP" v-bind:value="categoria.id_categoriaP">{{categoria.nombre}}</option>
                  </select>
                </div>
              <!-- validacion de campos -->
                
              </div>

               <div v-show="mostrarError" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errormensaje" :key="error" v-text="error">

                            </div>
                        </div>
                </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-light" @click="cerrarmodal()">Cerrar</button>
                <button type="button" class="btn color-primario shadow-none" v-if="bandera==true" @click="registrarPlatillo()" >Registrar</button>
                 <button type="button" class="btn color-primario shadow-none" v-if="bandera==false" @click="actualizarPlatillo()" data-dismiss="modal">Actualizar</button>
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
               id_plato:0,
               platillos:[],
               categorias:[],
               prueba: 'hola mundo cruel',
               nombre:'',
               folio:'',
               descripcion:'',
               id_categoriaP:0,
               precio:'',
            //    estado:0,
               bandera:false,
               cat_selects:[],
               mostrarError: 0,
               errormensaje:[],

            }
        },

        computed:{

        },

        methods: {
            getPlatillos(){

                let cap = this;

                axios.get('/platillos').then(function (response) {

                    let respuesta = response.data;

                    cap.platillos = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
            getCategoriaP(){
                let cap = this;

                axios.get('/categoria_platillos').then(function (response) {

                    let respuesta = response.data;

                    cap.categorias = respuesta.categorias.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
  
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                   case 'platillo':{
                       this.getCategoriaP();
                       switch (accion) {
                           case 'registrar':{
                               //mostrar modal
                               $('#modal_platillo').modal('show');
                                    this.nombre='';
                                    this.descripcion='';
                                    this.precio='';
                                    this.estado=1;
                                    this.folio='';
                                    this.id_categoriaP=0;
                                    this.bandera=true;
                               break;
                           }
                           case 'actualizar':{
                                $('#modal_platillo').modal('show');
                                this.bandera=false;
                                this.id_plato = data['id_plato'];
                                this.id_categoriaP = data['id_categoriaP'];
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.precio=data['precio'];
                                this.folio=data['folio'];
                        
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
                
                $('#modal_platillo').modal('hide');
                this.nombre='';
                this.descripcion='';
                this.precio='';
                this.errormensaje=0;
            },
            registrarPlatillo(){

                if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/platillos/registrar';

                axios.post(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'precio' : this.precio,
                    'folio' : this.folio,
                    'id_categoriaP' : this.id_categoriaP,
                    // 'estado' : this.estado
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_platillo').modal('hide');
                   
                  //actualizatabla
                  cargar.getPlatillos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },
            actualizarPlatillo(){
                 if (this.validarinput()) {
                    return;
                }

                let cargar = this;
                let url = '/platillos/actualizar';

                axios.put(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'precio' : this.precio,
                    'folio' : this.folio,
                    'id_categoriaP' : this.id_categoriaP,
                    // 'estado' : this.estado,
                    'id_plato' : this.id_plato
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_platillo').modal('hide');
       
                  //actualizatabla
                  cargar.getPlatillos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

                 this.errormensaje=0;
            },

            activar(id){
                 let cargar = this;
                 let url = '/platillos/activar';

                var id = id;
                Swal.fire({
                title: '¿Quieres activar el producto?',
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
                    axios.put('/platillos/activar',{
                        'estado': estado,
                        'id_plato' : id
                    }).then(function (json) {

                        cargar.getPlatillos();  

                        Swal.fire({
                        title:'Se activó',
                        text:"El producto fue activada con exito",
                        icon:'success',
                        confirmButtonColor:'#f31809'
                       })
                    });  
                }
                });
            },
           
           desactivar(id){
                 let cargar = this;
                 let url = '/platillos/desactivar';
                var id = id;
                Swal.fire({
                title: '¿Quieres desactivar el producto?',
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
                    axios.put('/platillos/desactivar',{
                        'estado': estado,
                        'id_plato' : id
                    }).then(function (json) {
                        cargar.getPlatillos();
                        Swal.fire({
                        title:"Se desactivó",
                        text:"El producto fue desactivada",
                        icon:'success',
                        confirmButtonColor:'#f31809'
                        })
                    });  
                }
                });
            }

        },

        mounted() {
           this.getPlatillos();

        }
    }
</script>



