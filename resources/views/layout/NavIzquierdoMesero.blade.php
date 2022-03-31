<div class="sidebar">
    <div class="logo-details">
        <i class="fas fa-search"></i>
        <span class="logo_name">Santa María</span>
    </div>
    <ul class="nav-links">
        <li v-on:click="menu=0">
            <a href="#">
                <i class="fas fa-home"></i>
                <span class="link_name">inicio</span>
            </a>
            <ul class="sub-menu blank">
                <li v-on:click="menu=0"><a href="#" class="link_name" >Inicio</a></li>
            </ul>
        </li>
        <li v-on:click="menu=1">
            <a href="#">
                <i class="fas fa-concierge-bell"></i>
                <span class="link_name">Comandas</span>
            </a>
            <ul class="sub-menu blank">
                <li v-on:click="menu=1"><a href="#" class="link_name">Realizar comandas</a></li>
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