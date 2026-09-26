<aside class="sidebar" id="sidebar">

    <div class="sidebar-brand">
        <div class="brand-icon">
            <img src="{{ asset('images/smart-locker.png') }}" alt="Smart Locker logo" class="brand-logo">
        </div>
        <div class="brand-text">
            <h2>Smart Locker</h2>
            <span>Management System</span>
        </div>
    </div>

    <nav class="sidebar-nav">

        <a href="{{ url('staff/dashboard') }}"
           class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"
           @if(request()->is('dashboard')) aria-current="page" @endif>
            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ url('/locations') }}"
           class="nav-item {{ request()->is('locations*') ? 'active' : '' }}"
           @if(request()->is('locations*')) aria-current="page" @endif>
            <i class="fa-solid fa-location-dot"></i>
            <span>Locations</span>
        </a>

        <a href="{{ url('tatt/locker') }}"
           class="nav-item {{ request()->is('lockers*') ? 'active' : '' }}"
           @if(request()->is('lockers*')) aria-current="page" @endif>
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Lockers</span>
        </a>

        <a href="{{ url('staff/user') }}"
           class="nav-item {{ request()->is('users*') ? 'active' : '' }}"
           @if(request()->is('users*')) aria-current="page" @endif>
            <i class="fa-solid fa-users"></i>
            <span>Users</span>
        </a>

        <a href="{{ url('/locker-usage') }}"
           class="nav-item {{ request()->is('locker-usage*') ? 'active' : '' }}"
           @if(request()->is('locker-usage*')) aria-current="page" @endif>
            <i class="fa-solid fa-clock-rotate-left"></i>
            <span>Locker Usage</span>
        </a>

        <a href="{{ url('/maintenance') }}"
           class="nav-item {{ request()->is('maintenance*') ? 'active' : '' }}"
           @if(request()->is('maintenance*')) aria-current="page" @endif>
            <i class="fa-solid fa-screwdriver-wrench"></i>
            <span>Maintenance</span>
        </a>

        <a href="{{ url('/settings') }}"
           class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"
           @if(request()->is('settings*')) aria-current="page" @endif>
            <i class="fa-solid fa-gear"></i>
            <span>Settings</span>
        </a>

    </nav>

    <div class="sidebar-bottom">

        <form method="POST" action="">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>

    </div>

</aside>

{{-- Dims the page behind the sidebar when it's open on phone/tablet.
     Needs the matching CSS in sidebar-additions.css. --}}
<div class="sidebar-overlay" id="sidebarOverlay" hidden></div>

<script>
    (function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleButtons = document.querySelectorAll('.mobile-menu-button');

        function openSidebar() {
            sidebar.classList.add('open'); // matches .sidebar.open in your CSS
            overlay.hidden = false;
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.hidden = true;
            document.body.style.overflow = '';
        }

        toggleButtons.forEach((btn) =>
            btn.addEventListener('click', () => {
                sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
            })
        );

        overlay.addEventListener('click', closeSidebar);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeSidebar();
        });
    })();
</script>
