<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo-dark"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('images/logo-mini.svg')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome stellar dashboard!</h5>
        <ul class="navbar-nav navbar-nav-right ml-auto">
            <form class="search-form d-none d-md-block" action="#">
                <i class="icon-magnifier"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
            <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li>
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <img class="img-xs rounded-circle ml-2" src="{{ asset('images/faces/default.png') }}" alt="Profile image"> <span
                        class="font-weight-normal"> {{ auth()->user()->name }} </span></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header" style="display: flex; flex-direction: column; align-items: center;">
                        <img class="img-md rounded-circle" src="{{ asset('images/faces/default.png') }}"
                             alt="Profile image" style="max-width: 100px">
                        <p class="mb-1 mt-3">{{ auth()->user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}    </p>
                    </div>
                    <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i>My Profile</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i>Messages</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i>Activity</a>
                    <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i>FAQ</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
