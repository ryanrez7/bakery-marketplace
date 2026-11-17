<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Bakery Marketplace</h2>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('menus.index') }}" class="{{ request()->routeIs('menus.*') ? 'active' : '' }}">
                    Katalog Bakery
                </a>
            </li>
            <li>
                <a href="{{ route('stores.index') }}" class="{{ request()->routeIs('stores.*') ? 'active' : '' }}">
                    Daftar Toko
                </a>
            </li>
            <li>
                <a href="#">Keranjang</a>
            </li>
            <li>
                <a href="#">Pesanan Saya</a>
            </li>
            <li>
                <a href="#">Profil</a>
            </li>
        </ul>
    </nav>
</aside>