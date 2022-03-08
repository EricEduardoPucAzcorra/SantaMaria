

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 //agrego componentes
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('almacen-component', require('./components/Almacen/Almacen.vue').default);
 
 //codigo vue js
 const app = new Vue({
     el: '#vue',
 });
 