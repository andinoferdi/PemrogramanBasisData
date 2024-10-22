<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item">
                <a href="{{ route('barang.index') }}" class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
                    Barang
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('satuan.index') }}" class="nav-link {{ Request::is('satuan*') ? 'active' : '' }}">
                    Satuan
                </a>
            </li>
        </ul>
    </div>
</nav>
