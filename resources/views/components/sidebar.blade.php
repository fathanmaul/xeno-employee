<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="@if(request()->routeIs('dashboard')) active @endif"><a class="nav-link"
                href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
        <li class="menu-header">Features</li>
        <li class="dropdown @if (request()->routeIs('employees.*')) active @endif">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Employees</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('employees.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('employees.create') }}">New Employee</a></li>
                <li class="{{ request()->routeIs('employees.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('employees.index') }}">List Employee</a></li>
            </ul>
        </li>
        <li class="dropdown @if (request()->routeIs('presences.*')) active @endif">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Presence</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('presences.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('presences.create') }}">New Presence</a></li>
                <li class="{{ request()->routeIs('presences.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('presences.index') }}">List Presence</a></li>
            </ul>
        </li>
        <li class="dropdown @if (request()->routeIs('salary.*')) active @endif">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                <span>Salary</span></a>
            <ul class="dropdown-menu">
                <li class="{{ request()->routeIs('salary.create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('salary.create') }}">New Salary</a></li>
                <li class="{{ request()->routeIs('salary.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('salary.index') }}">List Salary</a></li>
                <li class="{{ request()->routeIs('salary.monthly') ? 'active' : '' }}"><a class="nav-link" href="{{ route('salary.monthly') }}">Monthly Salary</a></li>
            </ul>
        </li>
    </ul>
</aside>