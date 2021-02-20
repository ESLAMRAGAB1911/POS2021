<!--header start-->
<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="{{ route('pos') }}" class="logo"><b>P<span>OS</span></b></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <ul class="nav top-menu">
            <!-- settings start -->

            <!-- inbox dropdown end -->
            <!-- notification dropdown start-->
            <li id="header_notification_bar" class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-warning">{{ __('site.lang') }}</span>
                </a>
                <ul class="dropdown-menu">
                    <div class="notify-arrow notify-arrow-yellow"></div>
                    <ul>
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>


                </ul>
            </li>
            <!-- notification dropdown end -->
        </ul>
        <!--  notification end -->
    </div>
    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            <li>
                <form class="logout" method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-dropdown-link href="{{ route('logout') }}" style="color:white" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                        {{ __('site.Logout') }}
                    </x-jet-dropdown-link>
                </form>
            </li>
        </ul>
    </div>
</header>
<!--header end-->
<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered"><img src="{{ asset('userImage') }}/{{ auth()->user()->image }}"
                    style="object-fit: cover;" class="img-circle" width="100" height="100"></a></p>
            <h5 class="centered">{{ auth()->user()->name }}</h5>
            <li class="mt">
                <a href="{{ route('pos') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ __('site.Dashboard') }}</span>
                </a>
            </li>
            @if (auth()
        ->user()
        ->hasPermission('users-read'))
                <li class="mt">
                    <a href="{{ route('users.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('site.users') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()
        ->user()
        ->hasPermission('categories-read'))
                <li class="mt">
                    <a href="{{ route('categories.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('site.categories') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()
        ->user()
        ->hasPermission('products-read'))
                <li class="mt">
                    <a href="{{ route('products.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('site.products') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()
        ->user()
        ->hasPermission('clients-read'))
                <li class="mt">
                    <a href="{{ route('clients.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('site.clients') }}</span>
                    </a>
                </li>
            @endif
            @if (auth()
        ->user()
        ->hasPermission('orders-read'))
                <li class="mt">
                    <a href="{{ route('orders.index') }}">
                        <i class="fa fa-dashboard"></i>
                        <span>{{ __('site.orders') }}</span>
                    </a>
                </li>
            @endif
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
