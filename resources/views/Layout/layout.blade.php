<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="CautaVet">
    <title>@yield('titulo')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    @yield('custom_css')
</head>


<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="">Dashboard</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
            aria-label="Hide Sidebar"></a>
        <!-- Navbar Right Menu-->
        <ul class="app-nav">
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown"
                    aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                     <li><a class="dropdown-item" href="{{ route('editprofile', ['id'=>Auth::user()->id]) }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                          <i class="fa fa-arrow-down"></i>  {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        @include('Modules.aside')
    </aside>
    <main class="app-content">
        <div class="app-title">
            <div>
                <div class="row">
                    <div class="col-md-12">
                        @yield('title_content')
                    </div>
                </div>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                @yield('breadcrumb')
            </ul>
        </div>
        @yield('content')
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="/js/plugins/pace.min.js"></script>
    <!--Cambiar aca para produccion-->
    <script src="/js/vuedev.js"></script>
    <script src="https://unpkg.com/axios@0.19.0/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script><script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    @yield('custom_javas')
</body>

</html>
