<div class="app-sidebar__user"><img class="app-sidebar__user-avatar"
    src="/images/logopet.png" alt="User Image" width="170" >
<div>

</div>
</div>
<ul class="app-menu">
<li><a class="app-menu__item {{isActive('/')}} " href="{{route('home')}}">
    <img src="/images/home.svg" alt="" width="25px"> &nbsp;
    <span class="app-menu__label">Home</span></a></li>
<li><a class="app-menu__item {{isActive('products')}}" href="{{route('products.index')}}">
    <img src="/images/animals.svg" alt="" width="25px">&nbsp;
    <span class="app-menu__label">Products</span></a></li>
</ul>
