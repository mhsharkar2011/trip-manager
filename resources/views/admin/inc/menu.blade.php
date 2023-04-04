<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll bg-dark">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul class="bg-dark text-white sidebar navbar-nav" style="border:1px solid #132">
          <li class="menu-title">
              <span>Main</span>
          </li>
          <li class="{{set_active(['home','em/dashboard'])}} submenu">
              <a href="#" class="{{ set_active(['home','em/dashboard']) ? 'noti-dot' : '' }}">
                  <i class="la la-dashboard"></i>
                  <span> Dashboard</span> <span class="menu-arrow"></span>
              </a>
              <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                  <li><a class="{{set_active(['home'])}}" href="{{ route('admin.dashboard.index') }}">Admin Dashboard</a></li>
              </ul>
          </li>

          <li class="menu-title">
            <span>Employees</span>
        </li>
        <li class="{{set_active(['home','em/dashboard'])}} submenu">
          <a href="#" class="{{ set_active(['home','em/dashboard']) ? 'noti-dot' : '' }}">
              <i class="fas fa-fw fa-users"></i>
              <span>Employees</span> <span class="menu-arrow"></span>
          </a>
          <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
              <li><a class="{{set_active(['home'])}}" href="{{ route('admin.employees.card') }}">All Employees</a></li>
              <li><a class="{{set_active(['home'])}}" href="{{ route('admin.dashboard.index') }}">Manager</a></li>
              <li><a class="{{set_active(['home'])}}" href="{{ route('admin.drivers.index') }}">Drivers</a></li>
              <li><a class="{{set_active(['home'])}}" href="{{ route('admin.users.index') }}">Users</a></li>
          </ul>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="{{ route('admin.vehicles.index') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Vehicles</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
            <a class="nav-link" href="{{ route('admin.trip-packages.index') }}">
              <i class="fa-solid fa-cubes"></i>
              <span>Packages</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="{{ route('admin.trips.index') }}">
            <i class="fa-solid fa-plane-departure"></i>
            <span>Trips</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-coins"></i>
            <span>Trips Earning</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="{{ route('admin.customers.index') }}">
            <i class="fa-solid fa-person-walking-luggage"></i>
            <span>Customers</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-clipboard-user"></i>
            <span>Attendance</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-person-walking-arrow-right"></i>
            <span>Leave</span></a>
        </li>

        <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
          <a class="nav-link" href="#">
            <i class="fa-solid fa-chalkboard-user"></i>
            <span>Planing Board</span></a>
        </li>
      </ul>
    </div>
  </div>
</div>
