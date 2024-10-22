<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle">Dashboard</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Master
            </li>

            <!-- Link ke Barang -->
            <li class="sidebar-item {{ Request::is('barang*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('barang.index') }}">
                    <i class="align-middle" data-feather="box"></i>
                    <span class="align-middle">Barang</span>
                </a>
            </li>

            <!-- Link ke Satuan -->
            <li class="sidebar-item {{ Request::is('satuan*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('satuan.index') }}">
                    <i class="align-middle" data-feather="grid"></i>
                    <span class="align-middle">Satuan</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
