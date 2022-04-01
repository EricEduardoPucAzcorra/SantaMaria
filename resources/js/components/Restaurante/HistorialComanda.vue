<template>
    <div class="col-md-12">
        <div class="m-5">
            <h3 class="texto-principal">Detalles de comandas</h3>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                        <th scope="col">No. mesa</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Folio del producto</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="detalle in detalles" :key="detalle.id_comanda">
                        <td>{{detalle.num_mesa}}</td>
                        <td>{{detalle.estado}}</td>
                        <td>{{detalle.nombre_producto}}</td>
                        <td>{{detalle.cantidad_plato}}</td>
                        <td>{{detalle.descripcion}}</td>
                        <td>{{detalle.fecha_comanda}}</td>
                        <td>{{detalle.folio}}</td>
                        <td>$ {{detalle.total}}</td>
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
               id_mesa:0,
               prueba: 'hola mundo cruel', 
               mesas:[],
               detalles:[],
               bandera:false,
               selec_selects:[],
               mostrarError: 0,
               errormensaje:[],
            }
        },

        computed:{

        },

        methods: {
            getDetallesComanda(){

                let cap = this;

                axios.get('/detalles_comandas').then(function (response) {

                    let respuesta = response.data;

                    cap.detalles = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
  
        },

        mounted() {
           this.getDetallesComanda();

        }
    }
</script>



