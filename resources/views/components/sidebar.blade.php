@auth
<div class="main-sidebar sidebar-style-modern bg-white shadow-sm">
    <aside id="sidebar-wrapper" class="h-100 overflow-y-auto">
        <!-- Brand -->
        <div class="sidebar-brand py-3 px-4 text-xl font-bold text-primary border-bottom">
            <a href="">Cashier APP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm d-none d-lg-block py-2 px-3 text-lg font-semibold">
            <a href="">CA</a>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu list-unstyled mt-3">
            <!-- Dashboard -->
            <li class="menu-header text-uppercase text-muted small px-4 mb-3">Dashboard</li>
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ url('home') }}">
                    <i class="fas fa-fire me-3 text-info"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Superadmin --}}
            @if (Auth::user()->role == 'superadmin')
            <!-- Menu -->
            <li class="menu-header text-uppercase text-muted small px-4 mb-3 mt-4">Menu</li>
            <li class="{{ Request::is('product') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('products.index') }}">
                    <i class="fas fa-shopping-bag me-3 text-info"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="{{ Request::is('sales') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('sales.index') }}">
                    <i class="fas fa-shopping-cart me-3 text-info"></i>
                    <span>Penjualan</span>
                </a>
            </li>

            <!-- User -->
            <li class="menu-header text-uppercase text-muted small px-4 mb-3 mt-4">User</li>
            <li class="{{ Request::is('user') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('user.index') }}">
                    <i class="fas fa-user-shield me-3 text-info"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="{{ Request::is('members') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('members.index') }}">
                    <i class="fas fa-user me-3 text-info"></i>
                    <span>Member</span>
                </a>
            </li>
            @endif

            {{-- User --}}
            @if (Auth::user()->role == 'user')
            <!-- Menu -->
            <li class="menu-header text-uppercase text-muted small px-4 mb-3 mt-4">Menu</li>
            <li class="{{ Request::is('product') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('products.index') }}">
                    <i class="fas fa-shopping-bag me-3 text-info"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="{{ Request::is('sales') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('sales.index') }}">
                    <i class="fas fa-shopping-cart me-3 text-info"></i>
                    <span>Penjualan</span>
                </a>
            </li>

            <!-- User -->
            <li class="menu-header text-uppercase text-muted small px-4 mb-3 mt-4">User</li>
            <li class="{{ Request::is('members') ? 'active' : '' }}">
                <a class="nav-link d-flex align-items-center px-4 py-2 rounded hover-bg-light" href="{{ route('members.index') }}">
                    <i class="fas fa-user me-3 text-info"></i>
                    <span>Member</span>
                </a>
            </li>
            @endif
        </ul>
    </aside>
</div>
@endauth
