<template>
    <div class="col-md-12">
        <div class="m-5">
            <h6>Detalles de comandas</h6>
        
        </div>
        <div class="m-5">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                      <th scope="col">Fecha</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Num mesa</th>
                      <th scope="col">Folio producto</th>
                      <th scope="col">Producto</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="detalle in detalles" :key="detalle.id_comanda">
                        <td>{{detalle.fecha_comanda}}</td>
                        <td>{{detalle.estado}}</td>
                        <td>{{detalle.descripcion}}</td>
                        <td>{{detalle.num_mesa}}</td>
                        <td>{{detalle.folio}}</td>
                        <td>{{detalle.nombre_producto}}</td>
                        <td>{{detalle.cantidad_plato}}</td>
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



