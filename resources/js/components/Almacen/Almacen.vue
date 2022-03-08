<template>
    <div>
        <div class="ms-panel ms-widget ms-crypto-widget">
            <div class="ms-panel-header">
                <h6>Recursos materiales <button type="button" class="btn btn-secondary" v-on:click="activarModal('recurso','registrar')" >
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button></h6>
                
            </div>
            <div class="ms-panel-body p-0">
            
                <div class="tab-content">
                <div  class="tab-pane active show fade in" id="btc">
                
                   <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Stock</th>
                      <th scope="col">Categoria</th>
                      <th>Estado</th>
                       <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
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
                            
                                  Activo
                              
                          </template>
                          <template v-else>
                              
                                  Inactivo
                             
                          </template>
                      </td>
                      <td>
                          <button  type="button" @click="activarModal('recurso','actualizar', recurso)">Editar</button>
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
             
                   
                </div>
    
                </div>

            </div>
        </div>

        <!-- Notes Modal -->
         <div class="modal fade"  style="display: none;" id="modal_recurso" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary">
              <h5 class="modal-title has-icon text-white" v-if="bandera==true">REGISTRAR RECURSO</h5>
              <h5 class="modal-title has-icon text-white" v-if="bandera==false">ACTUALIZAR RECURSO</h5>
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

                <div class="ms-form-group">
                  <label>Cantidad</label>
                  <input type="number" placeholder="cantidad" class="form-control" v-model="cantidad">
                </div>

                <div class="ms-form-group">
                    <label for="">Categoria</label>
                    <select v-model="id_categoria_obj" class="form-control">
                        <option value="0" disabled>Selecione</option>
                        <option  v-for="cat in cat_selects" :key="cat.id_categoria_obj" v-bind:value="cat.id_categoria_obj">{{cat.nombre}}</option>
                       
                    </select>
                </div>
<!-- 
                <div class="ms-form-group"> <span class="ms-option-name fs-14">Estado</span>
                  <label class="ms-switch float-right">
                    <input type="checkbox"> <span class="ms-switch-slider round"></span>
                  </label>
                </div> -->
                <!-- <div class="row">
                  <div class="col-md-6">
                    <div class="ms-form-group">
                      <input type="text" class="form-control datepicker" name="reminder-date" value="" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="ms-form-group">
                      <select class="form-control" name="reminder-time">
                        <option value="">12:00 pm</option>
                        <option value="">1:00 pm</option>
                        <option value="">2:00 pm</option>
                        <option value="">3:00 pm</option>
                        <option value="">4:00 pm</option>
                      </select>
                    </div>
                  </div>
                </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" @click="cerrarmodal()">Cerrar</button>
                <button type="button" class="btn btn-secondary shadow-none" v-if="bandera==true" @click="registrarRecurso()" >Registrar</button>
                 <button type="button" class="btn btn-secondary shadow-none" v-if="bandera==false" @click="actualizarRecurso()" data-dismiss="modal">Actualizar</button>
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
                     this.nombre='';
                    this.descripcion='';
                    this.cantidad='';
                    this.id_categoria_obj='';
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

                    this.nombre='';
                    this.descripcion='';
                    this.cantidad='';
                    this.id_categoria_obj='';
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



