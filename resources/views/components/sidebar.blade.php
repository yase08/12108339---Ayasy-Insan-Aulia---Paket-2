<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard-ecommerce.html">Kasir</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard-ecommerce.html">SA</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            @if (Auth::user()->role == 'admin')
                <li class="{{ Request::is('dashboard/user*') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('user') }}"><i class="fas fa-user"></i> <span>User</span></a></li>
            @endif
            <li class="{{ Request::is('dashboard/product*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('product') }}"><i class="fas fa-box"></i> <span>Product</span></a></li>
            <li class="{{ Request::is('dashboard/sale*') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('sale') }}"><i class="fas fa-shopping-cart"></i> <span>Sale</span></a></li>
            </li>
        </ul>
    </aside>
</div>
