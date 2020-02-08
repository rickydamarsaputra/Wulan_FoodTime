    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <!-- Admin Dropdown Menu -->
        <li class="nav-item dropdown">
          <h6 class="d-inline-block">{{ auth()->user()->name }}</h5>
            <a class="nav-link d-inline-block" data-toggle="dropdown" href="#" aria-expanded="false">
              <i class="fas fa-user-shield"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="{{ route('auth.logout') }}" class="dropdown-item dropdown-footer bg-danger font-weight-bold"><i class="fas fa-sign-out-alt mx-2"></i>Logout</a>
            </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->