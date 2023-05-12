<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="nav-icon cil-speedometer"></i>

            {{ __('Dashboard') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('commandes.index') }}">
        <i class="nav-icon fa-solid fa-cart-shopping"></i>

            {{ __('Commandes') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('livraisons.index') }}">
        <i class="nav-icon fas fa-shipping-fast"></i>

            {{ __('Livraisons') }}
        </a>
    </li>
   




    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <i class="cil-star nav-icon"></i>

            Resource
        </a>

        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tailleurs.index') }}" target="_top">
                    <i class="cil-cut nav-icon"></i>
                    Tailleurs
                </a>
            </li>
            <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <i class="cil-people nav-icon"></i>

            {{ __('Clients') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('vetements.index') }}">
        <i class="nav-icon fa-solid fa-shirt"></i>
            {{ __('Vetements') }}
        </a>
    </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('couleurs.index') }}" target="_top">
                    <i class="cil-color-fill nav-icon"></i>

                    Couleurs
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('functions.index') }}" target="_top">
                    <i class="cil-bug nav-icon"></i>

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
                    <i class="nav-icon cil-find-in-page"></i>


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
        <a class="nav-link nav-group-toggle" href="#">h
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
