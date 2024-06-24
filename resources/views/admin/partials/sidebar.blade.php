<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">{{ env('APP_NAME') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fa fa-columns"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-header">Users</li>
        <li class="{{ Request::route()->getName() == 'admin.users' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users') }}">
                <i class="fa fa-users"></i> <span>Users</span>
            </a>
        </li>
        <li class="menu-header">Menu</li>
        <li class="{{ Request::route()->getName() == 'admin.menu' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.menu') }}">
                <i class="fa fa-list"></i> <span>Menu</span>
            </a>
        </li>
        <li class="menu-header">Orders</li>
        <li class="{{ Request::route()->getName() == 'admin.orders.index' ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('admin.orders.index') }}">
                <i class="fa fa-shopping-basket"></i> <span>Orders</span>
            </a>
        </li>
    </ul>
</aside>
