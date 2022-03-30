@extends('auth.contenido')

@section('contenido')
<div class="contenedor-sesion">
    <div class="contenedor-avatar">
        <img class="avatar-sesion" src="{{asset('assets/img/avatar-log.jpg')}}" alt="">
    </div>
    <div class="contenedor-validar">
        <form method="POST" action="{{ route('login') }}" class="">
            @csrf
    
            <div class="form-sesion">
                <label for="email">Usuario</label>
                <div>
                    <input id="usuario" type="text" class="form-control {{$errors->has('usuario' ? 'is-invalid' : '')}}" name="usuario" value="{{ old('usuario') }}" required autocomplete="usuario" autofocus>
                    @error('usuario')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
    
            <div class="form-sesion">
                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
    
                <div class="col-md-6 ">
                    <input id="password" type="password" class="form-control {{$errors->has('password' ? 'is-invalid' : '')}}" name="password" required autocomplete="current-password">
    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="boton-validar">
                <button type="submit">Acceder</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection
