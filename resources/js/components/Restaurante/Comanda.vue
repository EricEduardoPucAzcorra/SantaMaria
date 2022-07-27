<template>
<div>  
    <div class="col-md-12" >
        <div class="m-5">
            <h3 class="texto-principal">Comanda</h3>
            <div class="row">
                <div class="col-md-4">
                    <h6>Realiza : <i class="fas fa-user"></i> {{user.usuario}}</h6>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <label class="col-sm-2">Mesa</label>
                        <div class="col-sm-8">
                            <select class="form-control" v-model="id_mesa">
                                <option value="0" disabled>Seleccione una mesa</option>
                                <option v-for="mesa in mesas" :key="mesa.id_mesa" v-bind:value="mesa.id_mesa">{{mesa.num_mesa}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>Fecha:</h6> <p>{{fecha}}</p>
                </div>
            </div>

            <div class="ms-panel-body">
               <div class="col-md-12">
                    <form class="needs-validation" novalidate>
                        <div class="form-row" style="display: flex; margin-top:5%;">
                            <div class="card col-md-6 m-2 p-2">
                                <div class="mb-3">
                                    <label for="validationCustom03">Eligir platillo</label>
                                    <div class="input-group">
                                        <div class="col-xl-12 col-md-12"> 
                                            <div class="needs-validation clearfix">
                                                <table class="table table-hover">
                                                    <thead class="encabezado-tabla">                            
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="contenido-tabla">
                                                        <tr v-for="comida in comidas" :key="comida.id_plato">
                                                            <td hidden="">{{comida.id_plato}}</td>
                                                            <td>{{comida.nombre}}</td>
                                                            <td>{{comida.precio}}</td>
                                                            <td class="col-2 text-center">
                                                                <button type="button" class="btn btn-outline-success btn-sm btn-sm" @click="insertProducto(comida.id_plato)"><i class="fas fa-plus"></i></button>
                                                            </td>
                                                        </tr>
                                                            
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3" style="">
                                    <label for="validationCustom03">Eligir bebida</label>
                                    <div class="input-group">
                                        <div class="col-xl-12 col-md-12"> 
                                            <div class="needs-validation clearfix">
                                                <table class="table  table-hover">
                                                    <thead class="encabezado-tabla">
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="contenido-tabla">
                                                        <tr v-for="refresco in refrescos" :key="refresco.id_plato">
                                                            <td hidden="">{{refresco.id_plato}}</td>
                                                            <td>{{refresco.nombre}}</td>
                                                            <td>{{refresco.precio}}</td>
                                                            <td class="col-2 text-center">
                                                                <button type="button" class="btn btn-outline-success btn-sm" @click="insertProducto(refresco.id_plato)"><i class="fas fa-plus"></i></button>
                                                            </td>
                                                        </tr> 
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-6 m-2 p-2">
                                <div class="col-md-12" style="border-color:red;">
                                    <label for="validationCustom03">Comanda</label>
                                    <div class="input-group">
                                        <div class="col-xl-12 col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="encabezado-tabla">
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Precio</th>
                                                            <th>Cantidad</th>
                                                            <th>Opciones</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="contenido-tabla">
                                                        <tr v-for="(producto,index) in historial" :key="producto.id_plato">
                                                            <td >{{producto.nombre}}</td>
                                                            <td>{{producto.precio}}</td>
                                                            <td class="col-3">
                                                                <input class="form-control" type="number" name="" v-model.number="cantidades[index]" placeholder="Cantidad">
                                                            </td>
                                                            <td class="col-2 text-center">
                                                                <button type="button" class="btn btn-outline-danger btn-sm" @click="eliminarhistorial(index)"><i class="fas fa-times"></i></button>
                                                            </td>
                                                            <td>{{ totalProducto(index) }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>          
                                                <h6>Total: <strong>{{subTotal}}</strong></h6>
                                                <br>
                                                <div class="ms-form-group">
                                                    <label>Comentario</label>
                                                    <input type="text" class="form-control" v-model="descripcion">
                                                </div>
                                                <button  type="button" class="btn color-primario mt-3" @click="createcomand()">Realizar comanda</button>
                                            </div>
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
</div>


</template>

<script>
    let fecha=new Date();
    let dia_semana=[
        'Domingo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado'
    ];
    let mes=[
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'

    ];
    let traer_fecha = dia_semana[fecha.getDay()] + ", " + fecha.getDate() + " de " + mes[fecha.getMonth()] + " del " + fecha.getFullYear();
    let user = document.head.querySelector('meta[name="usuario_log"]');

    export default {
        data(){
            return{
                fecha:'',
                //arrays
                productos:[],
                comidas:[],
                refrescos:[],
                mesas:[],
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
                //datos de la comanda
                descripcion:'',
                id_mesa:0,
                
            }
        }, 
        computed:{
            user(){
                return JSON.parse(user.content);
            },
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
            todosProductos(){
                    var i = this;
                    let  url = '/productos';
                    axios.get(url).then(function (response) {
                        //console.log(response);
                        i.productos = response.data; 
                    }).catch(function (error) {
                    console.log(error);
                    });   
            },
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

            getMesas(){
                var i = this;
                    let  url = '/mesas';
                    axios.get(url).then(function (response) {
                        //console.log(response);
                        i.mesas = response.data; 
                    }).catch(function (error) {
                    console.log(error);
                    });  
            },

            insertProducto(id){
                //capturo id
                var id = id;
                //array que insertara con push
                let listproductos={};

                // let i = this;

                let id_p = 0;

                //me filtraeras los datos que viene del response
                var filter = this.productos.filter(function (response) {
                    if (response.id_plato == id) return response;
                });       
                
                //console.log(filter);

                //id_p = filter.id_plato;

                //vereifico si el filter es mayor que 0
                if (filter.length > 0) {
                    //recorro el filer con el for 

                    //let count = 0;

                    listproductos = {
                            id_plato: filter[0].id_plato,
                            nombre: filter[0].nombre,
                            precio: filter[0].precio,
                            cantidad_plato:1,
                          
                        };
                        var encontrado = false;
                        let k;
                        for(k in this.historial){
                            if(this.historial[k].id_plato == id){
                                encontrado = true;
                                
                                alert('Ya esta insertado');
                            }
                        }
                        
                        if(!encontrado){
                            this.historial.push(listproductos);
                        }
                       
                       //console.log(listproductos);
                }




            },
            eliminarhistorial(index){
                this.historial.splice(index,1);
            },


            createcomand(){
                var i = this;
                var array = this.historial;

                var comanda = {
                    'estado':'ACEPTADO',
                    'descripcion':this.descripcion,
                    'id_mesa':this.id_mesa
                };


                Swal.fire({
                title: '¿Estas seguro de dar de alta a la comanda?',
                text: "",
                icon: 'danger',
                showCancelButton: true,
                confirmButtonColor: '#f31809',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    let me = this;
                    let estado = 0;
                    //realizo peticion
                   let  url = '/create_comanda';
                    axios.post(url, 
                        { 
                        
                        'producto':array, 
                        'comandas':comanda 
                            
                        }
                        ).then(function (response) {
                            //console.log(response);
                            i.historial = [];

                            
                        }).catch(function (error) {
                            console.log(error);
                    });  
                   

                }
                });

                //console.log(comanda);

                 
            }
        },
        mounted() {
            this.getComidas();
            this.getRefrescos();
            this.todosProductos();
            this.getMesas();
            console.log('Component mounted.')
            this.fecha=traer_fecha;
        }
    }
</script>

