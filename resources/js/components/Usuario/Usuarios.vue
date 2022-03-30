<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3>Usuarios</h3>
            <button type="button" class="btn color-primario" v-on:click="activarModal('usuario','registrar')">
                <i class="fas fa-plus"></i> Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="usuario in usuarios_sis" :key="usuario.id_usuario">
                        <td>{{usuario.id_usuario}}</td>
                        <td>{{usuario.usuario}}</td>
                        <td>{{usuario.rol.nombre}}</td>
                        <td class="col-5">
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fas fa-pen"></i> Editar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Notes Modal -->
        <div class="modal fade"  style="display: none;" id="modal_usuario" tabindex="-1" role="dialog" aria-labelledby="reminder-modal">
            <div class="modal-dialog modal-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header color-secundario">
                        <h5 class="modal-title" v-if="bandera==true">REGISTRAR USUARIO</h5>
                        <h5 class="modal-title" v-if="bandera==false">ACTUALIZAR USUARIO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="cerrarmodal()">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="ms-form-group">
                                <label>Usuario</label>
                                <input type="text" placeholder="Nombre de usuario" class="form-control" v-model="usuario">
                            </div>
                            <div class="ms-form-group">
                                <label>Contraseña</label>
                                <input type="password" placeholder="" class="form-control" v-model="password">
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
                            <button type="button" class="btn color-primario shadow-none" v-if="bandera==true" >Registrar</button>
                            <button type="button" class="btn color-primario shadow-none" v-if="bandera==false"  data-dismiss="modal">Actualizar</button>
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
                id_usuario:0,
                usuario:'',
                password:'',
                bandera:false,
                usuarios_sis:[],
                mostrarError: 0,
                errormensaje:[],
                rols:[]
            }
        },
        methods: {
            mostrarUsuarios(){
                axios.get('/get_usuarios').then(response => {
                    this.usuarios_sis = response.data;
                    console.log();

                })
                .catch(e => {
                    // Podemos mostrar los errores en la consola
                    console.log(e);
                })
            },
            getRoles(){
                let cap = this;

                axios.get('/get_roles').then(function (response) {

                    let respuesta = response.data;
                    cap.rols = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            activarModal(modelo, accion, data=[]){
               switch (modelo) {
                    case 'usuario':{
                        switch (accion) {
                            case 'registrar':{
                               //mostrar modal
                               $('#modal_usuario').modal('show');
                                    this.usuario='';
                                    this.password='';
                                   
                                    this.bandera=true;
                                break;
                            }
                            case 'actualizar':{
                                $('#modal_usuario').modal('show');
                                this.bandera=false;
                                //         // this.id_categoria = data['id_categoria_obj'];
                                //         // this.nombre = data['nombre'];
                                //         // this.descripcion = data['descripcion'];
                        
                                break;
                            }
                        }
                    }
            
                }
            },
            validarinput(){
                //
                this.mostrarError=0;
                this.errormensaje=[];
                //
                if(!this.usuario) this.errormensaje.push("El nombre es requerido");
                //
                if(this.errormensaje.length) this.mostrarError= 1;
                //
                return this.mostrarError;
            },
            cerrarmodal(){                    
                $('#modal_usuario').modal('hide');
                this.usuario='';
                this.contraseña='';
                this.errormensaje=0;
            },
            registrarUsuario(){
                if(this.validarinput()){
                    return
                }
                //
                let cargar = this;
                let url = '/usuarios/registrar';
                //
                axios.post(url,{
                    'usuario': this.usuario,
                    'password':this.password,
                    'id_usuario':this.id_usuario
                }).then(function(response){
                    $('#modal-usuario').modal('hide');
                    //
                    cargar.mostrarUsuarios();
                })
                .catch(function(error){
                    console.log(error);

                });
                this.errormensaje=0;
            },
            actualizarUsuario(){
                if(this.validarinput()){
                    return;
                }
                //
                let cargar = this;
                let url = '/usuario/actualizar';
                //
                axios.put(url,{
                    'usuario': this.usuario,
                    'password':this.password,
                    'id_usuario':this.id_usuario
                }).then(function(response){
                    $('#modal-usuario').modal('hide');
                    //
                    cargar.mostrarUsuarios();
                })
                .catch(function(error){
                    console.log(error);
                });
                this.errormensaje=0;
            }
        },
        mounted() {
            this.mostrarUsuarios();
        }
    }
</script>