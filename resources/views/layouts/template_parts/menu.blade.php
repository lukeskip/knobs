<!-- STARTS: MENU  -->
<header>
    <div id='cssmenu' >
        <ul>
            <li><a href='/'>Knobs</a></li>
            @if(Auth::guest())
                <li><a href='/register'>Regístrate</a></li>
                <li><a href='{{route("critic-landing")}}'>Regístrate como productor</a></li>
                <li><a href='/login'>Entrar</a></li>
            @endif
            
            @yield('menu-items-first')

            <!-- STARTS: MENU FOR ADMIN -->
            @if(get_role() == 'admin')

                <li><a href='/admin/dashboard'>Dashboard</a></li>
                <li><a href='/admin/options'>Opciones</a></li>
                <li><a href='/profiles'>Críticos</a></li>
                <li><a href='/admin/users'>Usuarios</a></li>
                <li><a href='/admin/songs'>Canciones registradas</a></li>
                <li><a href='/admin/coupons'>Cupones</a></li>
                <li><a href='/admin/payments'>Pagos</a></li>
                <li><a href='/admin/payments/users'>Pagos a Usuarios</a></li>
                <li><a href='/log-viewer' target="_blank">Errores</a></li>
                
                <!-- <li><a href='#'>Administradores</a></li>
                <li><a href='#'>Estadísticas</a></li> -->
                
            @endif
            <!-- ENDS: MENU FOR ADMIN -->

            <!-- STARTS: MENU FOR CRITIC -->
            @if(get_role() == 'critic')
            
                @if(Auth::user()->profiles)
                    <li>
                        <a href='/profiles/{{Auth::user()->profiles->id}}/edit'/>
                        Perfil
                        </a>
                    </li>
                @endif
                <li><a href='/critic/dashboard'>Dashboard</a></li>
                <li><a href='/reviews'>Mis Knobs</a></li>
                        
            @endif
            <!-- ENDS: MENU FOR ADMIN -->
        
            <!-- STARTS: MENU FOR MUSICIAN -->
            @if(get_role() == 'musician')
                    
                <li><a href='/songs/create'>Registrar Canción</a></li>
                <li><a href='/songs'>Mis canciones</a></li>
                <li><a href='{{route("profiles.create")}}'>Registrarme como Crítico</a></li>
                
            @endif
            <!-- ENDS: MENU FOR ADMIN -->

            @yield('menu-items-last')

            @if(!Auth::guest())
                <li><a href='/logout'>Salir</a></li>
            @endif
        </ul>
    </div>
    <div class="addition"></div>
</header>
<!-- ENDS: MENU FOR ADMIN -->