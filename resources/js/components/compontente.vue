<template>

   <p>Hola mundo</p>
</template>

<script>
    
    import moment from "moment";

    export default {
        data(){
            return{
               prueba: 'hola mundo cruel', 
                      

            }
        },

        computed:{
           
        },

        methods: {
   
            getHabitaciones(){
            var i = this;
            let  url = '/habitaciones';
            axios.get(url).then(function (response) {
              //console.log(response);
              i.habitaciones = response.data;

            }).catch(function (error) {
              console.log(error);
            });

            },
            //traer huespedes
            gethuespedes(){
              var i = this;
            let  url = '/huespedes';
              axios.get(url).then(function (response) {
                //console.log(response);
                i.huespedes = response.data;

              }).catch(function (error) {
                console.log(error);
              });
            },
            //agregar insersion de huesped
          
          
         },
                
        mounted() {
           this.getHabitaciones();
          //  this.obtener_fecha_hoy();
        }
    }
</script> 
