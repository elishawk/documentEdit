<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.employees.index') }}" class="nav-link {{ Request::is('admin.employees*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Employees</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-file-alt text-white"></i>
        <p>Documents</p>
    </a>
</li>
