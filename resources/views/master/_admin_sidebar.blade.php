<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <span class="brand-text font-weight-light ml-3"><b class="font-weight-bold">FoodTime</b> Admin Page</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the icon font library -->
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.menus') }}" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>List Menus</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.transaction') }}" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>Transaction</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>