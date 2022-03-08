<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Hola esto es vue js {{prueba}} <button v-on:click="oprimir()">Mensaje</button>
                    </div>

                    <div>
                        <table>
                            <tr v-for="objeto in array" :key="objeto.id_objeto">
                                <td>{{objeto.nombre}}</td>
                                <td>{{objeto.descripcion}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
               prueba: 'hola mundo cruel', 
               array:[]
            }
        },

        computed:{

        },

        methods: {
            getObjetos(){

                let cap = this;

                axios.get('/objetos_almacen').then(function (response) {
                    // handle success
                    console.log(response);

                    let respuesta = response.data;

                    cap.array = respuesta.objetos.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
            oprimir(){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    
                    console.log('hecho');
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                }
                });
            }
        },

        mounted() {
           this.getObjetos();

        }
    }
</script>
