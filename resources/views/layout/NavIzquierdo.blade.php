<div class="sidebar">
    <div class="logo-details">
        <i class="fas fa-search"></i>
        <span class="logo_name">Sanrta María</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="">
                <i class="fas fa-home"></i>
                <span class="link_name">inicio</span>
            </a>
            <ul class="sub-menu blank">
                <li><a href="" class="link_name">Inicio</a></li>
            </ul>
        </li>
        <li>
            <a href="{{ url('/usuarios') }}">
                <i class="fas fa-user"></i>
                <span class="link_name">Usuarios</span>
            </a>
            <ul class="sub-menu blank">
                <li><a href="{{ url('/usuarios') }}" class="link_name">Usuarios</a></li>
            </ul>
        </li>
        <li>
            <div class="icon-link">
                <a href="">
                    <i class="fas fa-hamburger"></i>
                    <span class="link_name">Restaurante</span>
                </a>
                <i class="fas fa-chevron-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a href="" class="link_name">Restaurante</a></li>
                <li><a href="">Item 1</a></li>
                <li><a href="">Item 2</a></li>
                <li><a href="">Item 3</a></li>
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
                <li><a href="" class="link_name">Almacen</a></li>
                <li><a href="{{ url('/almacen') }}">Objetos</a></li>
                <li><a href="{{ url('/categoria_objs') }}">Categorias</a></li>
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
                <li><a href="{{ url('/reservar') }}">Reservar</a></li>
                <li><a href="{{ url('/categoria_objs') }}">Habitaciones</a></li>
                <li><a href="{{ url('/categoria_objs') }}">Detalles reservas</a></li>
            </ul>
        </li>
        <li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="assets/img/people/people-3.jpg" alt="profile">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ Auth::user()->name }}</div>
                    <div class="job">Programmer</div>
                </div>
                <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt" ></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</div>