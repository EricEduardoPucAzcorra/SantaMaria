

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 //agrego componentes
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('almacen-component', require('./components/Almacen/Almacen.vue').default);
 Vue.component('categorias_objeto-component', require('./components/Almacen/CategoriaObjeto.vue').default);
 Vue.component('reservar-component', require('./components/Hotel/Reservar/Reservar.vue').default);
 
 //codigo vue js
 const app = new Vue({
     el: '#vue',
 });
 