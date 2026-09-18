<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fa-solid fa-box"></i>
        </div>

        <div class="brand-text">
            <h2>Smart Locker</h2>
            <span>Management System</span>
        </div>
    </div>

    <nav class="sidebar-nav">

        <p class="nav-section-title">MAIN MENU</p>

        <a href="{{ url('/dashboard') }}"
           class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ url('/lockers') }}"
           class="nav-item {{ request()->is('lockers*') ? 'active' : '' }}">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Lockers</span>
        </a>

        <a href="{{ url('/locker-usage') }}"
           class="nav-item {{ request()->is('locker-usage*') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Locker Usage</span>
        </a>

        <a href="{{ url('/locations') }}"
           class="nav-item {{ request()->is('locations*') ? 'active' : '' }}">
            <i class="fa-solid fa-location-dot"></i>
            <span>Locations</span>
        </a>

        <a href="{{ url('/maintenance') }}"
           class="nav-item {{ request()->is('maintenance*') ? 'active' : '' }}">
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <span>Maintenance</span>
        </a>

        <p class="nav-section-title">SYSTEM</p>

        <a href="{{ url('/users') }}"
           class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
        </a>

        <a href="{{ url('/settings') }}"
           class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>

    </nav>

    <div class="sidebar-bottom">

        <div class="sidebar-help">
            <div class="help-icon">
                <i class="fa-solid fa-circle-question"></i>
            </div>

            <div>
                <strong>Need Help?</strong>
                <p>Contact support</p>
            </div>
        </div>

        <form method="" action="">
            @csrf

            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>