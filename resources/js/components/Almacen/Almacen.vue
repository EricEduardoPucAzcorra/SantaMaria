<template>
  <div class="col-md-12">
    <div class="m-5">
      <h3 class="texto-principal">Recursos materiales</h3>
      <button type="button" class="btn color-primario" v-on:click="activarModal('recurso','registrar')" >
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
            <th scope="col">Cantidad</th>
            <th scope="col">Stock</th>
            <th scope="col">Categoría</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody class="contenido-tabla">
          <tr v-for="recurso in objetos_almacen" :key="recurso.id_objeto">
            <td>{{recurso.id_objeto}}</td>
            <td>{{recurso.nombre}}</td>
            <td>{{recurso.descripcion}}</td>
            <td>{{recurso.cantidad}}</td>
            <td>{{recurso.stock}}</td>
            <td hidden="">{{recurso.id_categoria_obj}}</td>
            <td>{{recurso.nombre_categoria}}</td>
            <td>
              <template v-if="recurso.condicion">
                <span class="badge badge-success">Activo</span>
              </template>
              <template v-else>                              
               <span class="badge badge-secondary">Inactivo</span>
              </template>
            </td>
            <td>
              <button class="btn btn-outline-success" type="button" @click="activarModal('recurso','actualizar', recurso)">
                <i class="fas fa-pen"></i> Editar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Notes Modal -->
    <div class="modal fade"  style="display: none;" id="modal_recurso" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header color-secundario">
            <h5 class="modal-title" v-if="bandera==true">REGISTRAR RECURSO</h5>
            <h5 class="modal-title" v-if="bandera==false">ACTUALIZAR RECURSO</h5>
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
                <label>Descripción</label>
                <textarea name="" id="" class="form-control" v-model="descripcion"></textarea>
              </div>
              <div class="ms-form-group">
                <label>Cantidad</label>
                <input type="number" class="form-control" v-model="cantidad">
              </div>
              <div class="ms-form-group">
                <label for="">Categoría</label>
                <select v-model="id_categoria_obj" class="form-control">
                  <option value="0" disabled>Selecione</option>
                  <option  v-for="cat in cat_selects" :key="cat.id_categoria_obj" v-bind:value="cat.id_categoria_obj">{{cat.nombre}}</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-light" @click="cerrarmodal()">Cerrar</button>
              <button type="button" class="btn color-primario shadow-none" v-if="bandera==true" @click="registrarRecurso()" >Registrar</button>
              <button type="button" class="btn color-primario shadow-none" v-if="bandera==false" @click="actualizarRecurso()" data-dismiss="modal">Actualizar</button>
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
               id_objeto:0,
               prueba: 'hola mundo cruel', 
               objetos_almacen:[],
               nombre:'',
               descripcion:'',
               cantidad:'',
               id_categoria_obj:0,
               bandera:false,
               cat_selects:[]


            }
        },

        computed:{

        },

        methods: {
            getRecursos(){

                let cap = this;

                axios.get('/objetos_almacen').then(function (response) {
                    // handle success
                    //console.log(response);

                    let respuesta = response.data;

                    cap.objetos_almacen = respuesta.objetos.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },

            getSelectCat(){

                let cap = this;

                axios.get('/select_cat').then(function (response) {
                    // handle success
                    //console.log(response);

                    let respuesta = response;

                    cap.cat_selects = respuesta.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
        
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                   case 'recurso':{
                       //taigo categorias
                       this.getSelectCat();
                       
                       switch (accion) {
                           case 'registrar':{
                               //mostrar modal
                               $('#modal_recurso').modal('show');
                                    this.nombre='';
                                    this.descripcion='';
                                    this.cantidad='';
                                    this.id_categoria_obj='';
                                    this.bandera=true;
                               break;
                           }
                           case 'actualizar':{
                                $('#modal_recurso').modal('show');
                                this.bandera=false;
                                this.id_objeto = data['id_objeto'];
                                this.nombre = data['nombre'];
                                this.descripcion = data['descripcion'];
                                this.cantidad = data['cantidad'];
                                this.id_categoria_obj = data['id_categoria_obj']; 

                               break;
                           }

                       }
                   }
               }
            
            },

            cerrarmodal(){
                
                $('#modal_recurso').modal('hide');
                this.nombre='';
                this.descripcion='';
                this.cantidad='';
                this.id_categoria_obj='';

            },
            registrarRecurso(){

                let cargar = this;
                let url = '/objetos_almacen/registrar';

                axios.post(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'cantidad' : this.cantidad,
                    'stock' : 0,
                    'id_categoria_obj' : this.id_categoria_obj
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_recurso').modal('hide');
                   
                  //actualizatabla
                  cargar.getRecursos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            actualizarRecurso(){
                let cargar = this;
                let url = '/objetos_almacen/actualizar';

                axios.put(url,{
                    'nombre' : this.nombre,
                    'descripcion' : this.descripcion,
                    'cantidad' : this.cantidad,
                    'stock' : 0,
                    'id_categoria_obj' : this.id_categoria_obj,
                    'id_objeto' : this.id_objeto
                }).then(function (response) {
                  //c3rra modal
                  $('#modal_recurso').modal('hide');

                  
                  //actualizatabla
                  cargar.getRecursos();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            }

        },

        mounted() {
           this.getRecursos();

        }
    }
</script>



