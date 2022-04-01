<template>
    <div class="col-md-12">
        <div class="m-5">
            <h4>Detalles de reservas</h4>
        </div>
        <div class="m-5">
            <table class="table table-hover">
                <thead class="encabezado-tabla">
                    <tr>
                        <th scope="col">Fecha</th>
                        <th>Numero habitacion</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Tipo habitacion</th>
                        <th scope="col">Total</th>
                        <!-- <th scope="col">Comentario</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Folio del producto</th>
                        <th scope="col">Total</th> -->
                    </tr>
                </thead>
                <tbody class="contenido-tabla">
                    <tr v-for="detalleRH in detalles_reservasH" :key="detalleRH.id_detalle_reserva">
                        <td>{{detalleRH.fecha_registro}}</td>
                        <td>{{detalleRH.num_habitacion}}</td>
                        <td>{{detalleRH.num_folio}}</td>
                        <td>{{detalleRH.tipo_h}}</td>
                        <td>$ {{detalleRH.total}}</td>
                    
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
               detalles_reservasH:[],
               bandera:false,
               selec_selects:[],
               mostrarError: 0,
               errormensaje:[],
            }
        },

        computed:{

        },

        methods: {
            getReservasH(){

                let cap = this;

                var url = '/reservars/detalles';
                axios.get(url).then(function (response) {

                    let respuesta = response.data;

                    cap.detalles_reservasH = respuesta;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
  
        },

        mounted() {
           this.getReservasH();

        }
    }
</script>



