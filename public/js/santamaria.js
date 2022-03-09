//muestra y oculta el sidebar
const btnToggle = document.querySelector('.toggle-btn');
btnToggle.addEventListener('click', function () {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('contenedor-sistema').classList.toggle('active-side')

});
//muestra y oculta el submenu -- tambien agrega la clase de la flecha que está en el li 
const btnSidebar = document.querySelector('.sidebar-btn');
btnSidebar.addEventListener('click', function() {
    document.getElementById('sidebar-show').classList.toggle('show-submenu');
    document.getElementById("flecha").classList.toggle('fa-caret-up');
});
