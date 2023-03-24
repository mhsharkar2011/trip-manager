<ul class="bg-dark text-white sidebar navbar-nav" style="border:1px solid #132">
    <li class="nav-item shadow-sm p-1 mb-1 rounded-1 " style="border-bottom:1px solid #495057">
      <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    
    <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>All Users</span>
      </a>
    </li>

    <li class="{{set_active(['all/employee/list','all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page'])}} submenu">
                    <a href="#" class="{{ set_active(['all/employee/list','all/employee/card','form/holidays/new','form/leaves/new',
                    'form/leavesemployee/new','form/leavesettings/page','attendance/page',
                    'attendance/employee/page','form/departments/page','form/designations/page',
                    'form/timesheet/page','form/shiftscheduling/page','form/overtime/page']) ? 'noti-dot' : '' }}">
                        <i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span>
                    </a>
                    <ul style="{{ request()->is('/*') ? 'display: block;' : 'display: none;' }}">
                        <li><a class="{{set_active(['all/employee/list','all/employee/card'])}}" href="{{ route('admin.all-employee-card') }}">All Employees</a></li>
                        <li><a class="{{set_active(['form/leavesemployee/new'])}}" href="{{route('form/leavesemployee/new')}}">Leaves (Driver)</a></li>
                        <li><a class="{{set_active(['form/leavesettings/page'])}}" href="{{ route('form/leavesettings/page') }}">Leave Settings</a></li>
                        <li><a class="{{set_active(['attendance/employee/page'])}}" href="{{ route('attendance/employee/page') }}">Attendance (Driver)</a></li>
                        <li><a class="{{set_active(['form/overtime/page'])}}" href="{{ route('form/overtime/page') }}">Overtime</a></li>
                    </ul>
      </li>

    <li class="nav-item shadow-sm p-1 mb-1 rounded-1" style="border-bottom:1px solid #495057">
      <a class="nav-link" href="{{ route('admin.drivers.index') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Drivers</span></a>
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