<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{route('dashboard')}}">Monza</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{route('dashboard')}}">MZ</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header active">Dashboard</li>
        <li class="nav-item {{ set_active('dashboard')}}">
            <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header ">Product</li>
        <li class="nav-item {{ set_active(['brand.index','brand.create','brand.edit'])}}">
          <a href="{{route('brand.index')}}" class="nav-link"><i class="fab fa-font-awesome-flag"></i><span>Brands</span></a>
        </li>
        <li class="nav-item {{ set_active(['category.index','category.create','category.edit'])}}">
          <a href="{{route('category.index')}}" class="nav-link"><i class="fab fa-elementor"></i><span>Categories</span></a>
        </li>
        <li class="{{set_active(['product.index','product.create','product.edit','product.trash'])}} dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-table"></i><span>Product</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active('product.index')}}"><a class="nav-link" href="{{route('product.index')}}">Product</a></li>
                <li class="{{set_active('product.trash')}}"><a class="nav-link" href="{{route('product.trash')}}">Deleted Product</a></li>
            </ul>
        </li>


        {{-- @can('manage_users')
        <li class="{{set_active(['user.index','user.trash'])}} dropdown">
            <a href="" class="nav-link has-dropdown"><i class="fas fa-address-book"></i><span>User</span></a>
            <ul class="dropdown-menu">
                <li class="{{set_active('user.index')}}"><a class="nav-link" href="{{route('user.index')}}">User</a></li>
                @role('SuperAdmin')
                <li class="{{set_active('user.trash')}}"><a class="nav-link" href="{{route('user.trash')}}">Deleted User</a></li>
                @endrole
            </ul>
        </li>
        @endcan --}}

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a>
      </div>
  </aside>
</div>
