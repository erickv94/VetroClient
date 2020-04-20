<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/images/logopet.png" alt="User Image" width="170">
    <div>

    </div>
</div>
<ul class="app-menu">
    <li>
        <a class="app-menu__item {{isActive('/')}} " href="{{route('welcome')}}">
            <img src="/images/home.svg" alt="" width="25px"> &nbsp;
            <span class="app-menu__label">Home</span></a>
    </li>
    @can('products.index')
    <li>
        <a class="app-menu__item {{isActive('products')}}" href="{{route('products.index')}}">
            <img src="/images/animals.svg" alt="" width="25px">&nbsp;
            <span class="app-menu__label">Products</span></a>
    </li>
    @endcan @role('admin')
    <li>
        <a class="app-menu__item {{isActive('users')}}" href="{{route('users.index')}}">
            <img src="/images/users.svg" alt="" width="25px">&nbsp;
            <span class="app-menu__label">Users</span></a>
    </li>
    @endrole @can('prices.index')
    <li>
        <a class="app-menu__item {{isActive('prices')}}" href="{{route('prices.index')}}">
            <img src="/images/price.svg" alt="" width="25px">&nbsp;
            <span class="app-menu__label">Prices</span></a>
    </li>
    @endcan
    @can('logs.check')
    <li>
        <a class="app-menu__item {{isActive('logs')}}" href="{{route('logs.index')}}">
            <img src="/images/logs.svg" alt="" width="25px">&nbsp;
            <span class="app-menu__label">Logs</span></a>
    </li>
    @endcan
</ul>