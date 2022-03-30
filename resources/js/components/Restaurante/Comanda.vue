<template>
 
<div>  
     <div class="col-xl-12 col-md-12" >
          <div class="ms-panel">
            <div class="ms-panel-header" style="display: flex; margin-top:5%;">
              <h6>Comanda</h6> <h6 style="margin-left: 10px;">Realiza : <i class="fa-solid fa-user"></i></h6>
              <h6 style="margin-left: 10px;">Fecha:</h6>
              <input type="text" >
            </div>
            <div class="ms-panel-body">
              <form class="needs-validation" novalidate>
               
                <div class="form-row" style="display: flex; margin-top:5%; border-color:red;">
                  <div class="col-md-4 mb-3">
                    <label for="validationCustom03">Eligir producto</label>
                    <div class="input-group">
                       <div class="col-xl-10 col-md-10">
                                     
                     <div class="needs-validation clearfix">
                        
                            <table class="table  thead-default">
                                <thead>
                            
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Opciones</th>
                                </thead>
                                <tbody>
                                   <tr v-for="comida in comidas" :key="comida.id_plato">
                                       <td hidden="">{{comida.id_plato}}</td>
                                       <td>{{comida.nombre}}</td>
                                       <td>{{comida.precio}}</td>
                                       <td>
                                           <button type="button" class="btn btn-success btn-sm btn-sm" @click="insertProducto(comida.id_plato)">+</button>
                                       </td>
                                   </tr>   
                                </tbody>
                            </table>

                     </div>
                   </div>
                    </div>
                  </div>

                  <div class="col-md-4 mb-3" style="border-color:red;">
                    <label for="validationCustom03">Eligir producto</label>
                    <div class="input-group">
                       <div class="col-xl-10 col-md-10">
                                     
                     <div class="needs-validation clearfix">
                        
                            <table class="table  table-default">
                            <thead>
                              <th>Nombre</th>
                              <th>Precio</th>
                              <th>Opciones</th>
                            </thead>
                            <tbody>
                                <tr v-for="refresco in refrescos" :key="refresco.id_plato">
                                       <td hidden="">{{refresco.id_plato}}</td>
                                       <td>{{refresco.nombre}}</td>
                                       <td>{{refresco.precio}}</td>
                                       <td>
                                           <button type="button" class="btn btn-success btn-sm btn-sm" @click="insertProducto(refresco.id_plato)">+</button>
                                       </td>
                                </tr> 
                            </tbody>
                        </table>

                      </div>
                   </div>
                    </div>
                  </div>

                  <div class="col-md-4 mb-3" style="border-color:red;">
                    <label for="validationCustom03">Eligir producto</label>
                    <div class="input-group">
                       <div class="col-xl-10 col-md-10">
                                     
                        <div class="table-responsive">
                        
                           <table class="table  table-default">
                                    <thead>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Opciones</th>
                                    </thead>
                                    <tbody>
                                    

                                    <tr v-for="(producto,index) in historial" :key="producto.id_plato">
                                       <td >{{producto.nombre}}</td>
                                       <td>{{producto.precio}}</td>
                                       <td><input class="form-control" type="number" name="" v-model.number="cantidades[index]" placeholder="Cantidad"></td>
                                       <td>
                                           <button type="button" class="btn btn-success btn-sm btn-sm" @click="eliminarhistorial(index)">+</button>
                                       </td>
                                       <td>{{ totalProducto(index) }}</td>
                                    </tr> 

                                   </tbody>
                            </table>
                                
                            

                            Total: {{subTotal}}

                            <br>
                            
                            <button  type="button" class="btn btn-success" @click="createcomand()">Realizar comanda</button>
                        </div>
                   </div>
                    </div>
                  </div>
                 
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
                //arrays
                comidas:[],
                refrescos:[],
                //carrito
                carrito:[],
                //history datas comandas
                historial:[],
                //identificador del plato
                id_plato:0,
                //cantidades
                cantidades:[1,1,1,1,1,1],
                //variable para campturar el valor de la multiplicacion de cantidad y precio
                //para obtener el iva
                auxSubtotal:0,

            }
        }, 
        computed:{
            //metodo para calcular el total de cantidad de productos
            totalProducto(){
                //recibe un parametro id , para recibir parametros es la sig manera
                return (id_plato)=>{
                    //va a cacular los precios y el total
                    var total=0;
                    //esta variable obtiene los valores del array ventas, esecificamente el precio 
                    //y lo multiplica por el valor que sera asginado en el input array cantidades
                    total=this.historial[id_plato].precio * this.cantidades[id_plato];


                    //ACTUALIZO EL TOTAL PARA HACER EL CAMBIO EN EL ARRAY
                    //sera igual al total multiplicado
                    this.historial[id_plato].total=total;
                    //actualizo la cantidad 
                    //sera igual al valor que viene del input
                    this.historial[id_plato].cantidad=this.cantidades[id_plato];

                    //retorna los datos 
                    //el tofixed permite mandar datos
                    return total.toFixed(1);
                }
            },

            //metodo para calcular el subototal

            subTotal(){
                let total=0;
                //recorre el array ventas 
                for (var i = this.historial.length -1; i >= 0; i--) {
                    //suma los valor de la ventaas almacenados en el campo total
                    total=total+this.historial[i].total;
                }
                
                //la variable auxiliar captura el valor total que ejecuta este computed
                this.auxSubtotal=total.toFixed(1);
                //al salir retorna los datos en decimal
                return total.toFixed(1);
            },

      
            // noArticulos(){
            //     let acum=0;
            //     //conteo en el campo cantidad
            //     for (var i = this.ventas.length - 1; i >= 0; i--) {
            //         //captura el conteo
            //         acum=acum + this.ventas[i].cantidad;	
            //     }
            //     //envia vista
            //     return acum;
            // }
        },
        methods: {
            getComidas(){
                    var i = this;
                    let  url = '/comidas';
                    axios.get(url).then(function (response) {
                        //console.log(response);
                        i.comidas = response.data; 
                    }).catch(function (error) {
                    console.log(error);
                    });   
            },

             getRefrescos(){
                    var i = this;
                    let  url = '/refrescos';
                    axios.get(url).then(function (response) {
                        //console.log(response);
                        i.refrescos = response.data; 
                    }).catch(function (error) {
                    console.log(error);
                    });   
            },

            insertProducto(id){
                //capturo id
                this.id_plato = id;
                //array que insertara con push
                let listproductos={};

                let i = this;

                let id_p = 0;

                let encontrado=false;
                axios.get('/insertproduct',{
                    params:{
                        'id_plato':this.id_plato
                    }
                })
                .then(function (json) {
                    //en el carrito capturo los datos
                    i.carrito = json.data;
                    // array list dproductos
                    listproductos = {
                        id_plato:json.data.id_plato,
                        nombre: json.data.nombre,
                        precio: json.data.precio,
                        cantidad: 1,
                        total:json.data.precio
                    };
                    //verifico si existe la consulta
                    if (i.carrito) {
					//enviamelo a la vista con push
					//en una variable de historial almaceno los productos a comandar
                     id_p = i.carrito.id_plato;
                     
                     let k;
                      for(k in i.historial){
                          if(i.historial[k].id_plato == id_p){
                              encontrado = true;
                             
                              alert('Ya esta insertado');
                          }
                      }
                      
                      if(!encontrado){
                          i.historial.push(listproductos);
                      }
                            
                    }

                    //console.log(response);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });


            },
            eliminarhistorial(index){
                this.historial.splice(index,1);
            },

            createcomand(){
                var i = this;
                var array = this.historial;

                let  url = '/create_comanda';
                axios.post(url,this.historial).then(function (response) {
                        console.log(response);
                      
                    }).catch(function (error) {
                        console.log(error);
                });   
            }
        },
        mounted() {
            this.getComidas();
            this.getRefrescos();
            console.log('Component mounted.')
        }
    }
</script>
