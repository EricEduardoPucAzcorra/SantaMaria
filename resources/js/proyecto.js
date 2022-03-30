
 require('./bootstrap');
 
 window.Vue = require('vue').default;
 
 //agrego componentes
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('almacen-component', require('./components/Almacen/Almacen.vue').default);
 Vue.component('categorias_objeto-component', require('./components/Almacen/CategoriaObjeto.vue').default);
 Vue.component('habitaciones-component', require('./components/Hotel/Habitaciones/Habitacion.vue').default);
 Vue.component('reservar-component', require('./components/Hotel/Reservar/Reservar.vue').default);
 Vue.component('usuarios-component',require('./components/Usuario/Usuarios.vue').default);
 Vue.component('mesa-component', require('./components/Mesa/Mesa.vue').default);
 Vue.component('comanda-component', require('./components/Restaurante/Comanda.vue').default);


 //codigo vue js
 const app = new Vue({
     el: '#vue',
     data:{
        menu:0,
        prueba:'hola mundo',
        comanda:0,
     },
     methods:{

     }

 });
 