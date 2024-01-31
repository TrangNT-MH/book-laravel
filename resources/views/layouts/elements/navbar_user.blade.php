<!-- partial:partials/_navbar.html -->
<nav class="navbar navbar-menu-wrapper default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo-dark"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('images/logo-mini.svg')}}" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1 shadow-none">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome stellar dashboard!</h5>
        <ul class="nav navbar-nav navbar-nav-right ml-auto">
            <form class="search-form d-none d-md-block" action="#">
                <i class="icon-magnifier"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
            <li class="nav-item cart-dropdown" id="cart-preview">
                <div class="cart-icon">
                    <a href="{{ route('user.cart') }}" class="nav-link">
                        <i class="icon-basket-loaded"></i>
                        <span id="cart-badge"
                              class="badge badge-danger">{{ Cart::instance('cart')->content()->count() }}</span>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="icon-chart"></i>
                </a>
            </li>
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <img class="img-xs rounded-circle ml-2" src="{{ asset('images/faces/face8.jpg') }}"
                         alt="Profile image"> <span
                        class="font-weight-normal"> {{ auth()->user()->name }} </span></a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset('images/faces/face8.jpg') }}"
                             alt="Profile image">
                        <p class="mb-1 mt-3">{{ auth()->user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route('user.profile', auth()->user()->getAuthIdentifier()) }}" class="dropdown-item">
                        <i class="dropdown-item-icon icon-user text-primary"></i> My Profile
                    </a>
                    {{--                    <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>--}}
                    <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
                    {{--                    <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a>--}}
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="dropdown-item-icon icon-power text-primary"></i>Sign Out
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
    @if(str_contains(Route::currentRouteName(), 'book') )
        <div class="sub-header">
            <ul class="navbar sub-navbar">
                @foreach($allGenres as $category => $genres)
                    <li class="nav-item dropdown d-none d-xl-inline-flex genre-dropdown">
                        <span class="nav-link dropdown-toggle dropdown-toggle-category" id="CateDropdown" href="#"
                              data-toggle="dropdown"
                              aria-expanded="false">
                            <span class="font-weight-normal"> {{$category}} </span>
                        </span>
                        <div class="dropdown-menu-category dropdown-menu navbar-dropdown"
                             aria-labelledby="CateDropdown">
                            @foreach($genres as $genre)
                                <a href="{{ route('user.profile', auth()->user()->getAuthIdentifier()) }}"
                                   class="dropdown-item">
                                    {{ $genre }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</nav>
<!-- partial -->
