<nav class="main-header navbar navbar-expand navbar-info navbar-light ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="btn btn-success" href="{{ route('admin.cashier') }}">
                <i class="fas fa-shopping-cart"></i> Point of Sales
            </a>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <span class="text-white float-right">{{ auth()->user()->username ?? 'Admin' }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Tentang Saya</span>
                <div class="dropdown-divider">Pengaturan Akun</div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Pengaturan Akun
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                    class="dropdown-item">
                    <i class="fa fa-window-close mr-2"></i> Keluar
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </li>
    </ul>
    <img src="{{ asset('template/dist/img/avatar.png') }}" alt="AdminLTE Logo" class="img-circle"
        style="max-width:30px;">
    </ul>
</nav>
