<div class="sidebar">
    <div class="logo-details">
        <i class="fas fa-search"></i>
        <span class="logo_name">Santa María</span>
    </div>
    <ul class="nav-links">
        <li v-on:click="menu=0">
            <a href="">
                <i class="fas fa-home"></i>
                <span class="link_name">inicio</span>
            </a>
            <ul class="sub-menu blank">
                <li v-on:click="menu=0"><a href="#" class="link_name" >Inicio</a></li>
            </ul>
        </li>
        <li v-on:click="menu=1">
            <a href="#">
                <i class="fas fa-user"></i>
                <span class="link_name">Usuarios</span>
            </a>
            <ul class="sub-menu blank">
                <li v-on:click="menu=1"><a href="#" class="link_name">Usuarios</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="">
                    <i class="fas fa-hamburger"></i>
                    <span class="link_name">Restaurante</span>
                </a>
                <i  class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li ><a href="" class="link_name">Restaurante</a></li>
                <li  v-on:click="menu=2"><a href="#">Categorias</a></li>
                <li  v-on:click="menu=3"><a href="">Productos</a></li>
                <li  v-on:click="menu=4"><a href="">Comandas historial</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="">
                    <i class="fas fa-cubes"></i>
                    <span class="link_name">Almacen</span>
                </a>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li  ><a href="#" class="link_name">Almacen</a></li>
                <li v-on:click="menu=5"><a href="#">Objetos</a></li>
                <li v-on:click="menu=6"><a href="#">Categorias</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="">
                    <i class="fas fa-cubes"></i>
                    <span class="link_name">Hotel</span>
                </a>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="" class="link_name">Almacen</a></li>
                <li v-on:click="menu=7"><a href="#">Reservar</a></li>
                <li v-on:click="menu=8"><a href="#">Habitaciones</a></li>
                <li v-on:click="menu=9"><a href="#">Detalles reservas</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="assets/img/people/people-3.jpg" alt="profile">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{Auth::User()->usuario}}</div>
                    <div class="job">{{Auth::User()->rol->nombre}}</div>
                </div>
                <a href="{{ route('salir') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt" ></i></a>
                <form id="logout-form" action="{{ route('salir') }}" method="POST" class="d-none">
                    @csrf
                </form> 
            </div>
        </li>
    </ul>
</div>