<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="nav-icon cil-speedometer"></i>

            {{ __('Dashboard') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <i class="nav-icon cil-user"></i>
            {{ __('Clients') }}
        </a>
    </li>




    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Resource
        </a>

        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('functions.index') }}" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Fonctions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('fournisseurs.index') }}" target="_top">
                    <i class=" nav-icon cil-factory"></i>
                    Fournisseurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('typeProduits.index') }}" target="_top">
                    <i class="nav-icon cil-page"></i>

                    Type des vetements
                </a>
            </li>
        </ul>

    </li>
    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">

            <i class="nav-icon cil-settings"></i>

            Administration
        </a>

        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="nav-icon cil-user"></i>

                    {{ __('Users') }}
                </a>
            </li>
        </ul>

    </li>

   <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('About us') }}
        </a>
    </li>-->
    <!--<li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Two-level menu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Child menu
                </a>
            </li>
        </ul>
    </li>-->
</ul>
