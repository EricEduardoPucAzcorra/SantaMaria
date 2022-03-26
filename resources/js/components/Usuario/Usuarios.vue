<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3>Usuarios</h3>
            <button type="button" class="btn btn-secondary">
                <i class="icon-plus"></i>Nuevo
            </button>
        </div>
        <div class="m-5">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="usuario in usuarios_sis" :key="usuario.id">
                        <td>{{usuario.id_usuario}}</td>
                        <td>{{usuario.usuario}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                id:0,
                name:'',
                email:'',
                usuarios_sis:[],
            }
        },
        
        methods: {
            mostrarUsuarios(){


                axios.get('/get_usuarios').then(response => {
                        this.usuarios_sis = response.data;
                    })
                    .catch(e => {
                        // Podemos mostrar los errores en la consola
                        console.log(e);
                    })
            }
        },
        mounted() {
            this.mostrarUsuarios();
        }
    }
</script>