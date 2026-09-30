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

<a href="{{ url('/dashboard') }}"
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

<a href="{{ url('/lockers') }}"
class="nav-item {{ request()->is('lockers*') ? 'active' : '' }}"
@if(request()->is('lockers*')) aria-current="page" @endif>
<i class="fa-solid fa-boxes-stacked"></i>
<span>Lockers</span>
</a>

<a href="{{ url('/user') }}"
class="nav-item {{ request()->is('user*') ? 'active' : '' }}"
@if(request()->is('user*')) aria-current="page" @endif>
<i class="fa-solid fa-users"></i>
<span>Users</span>
</a>

<a href="{{ route('staff.locker-usage') }}"
class="nav-item {{ request()->is('staff/locker-usage*') ? 'active' : '' }}"
@if(request()->is('staff/locker-usage*')) aria-current="page" @endif>
<i class="fa-solid fa-clock-rotate-left"></i>
<span>Locker Usage</span>
</a>

<a href="{{ url('/maintenance') }}"
class="nav-item {{ request()->is('maintenance*') ? 'active' : '' }}"
@if(request()->is('maintenance*')) aria-current="page" @endif>
<i class="fa-solid fa-screwdriver-wrench"></i>
<span>Maintenance</span>
</a>

<a href="{{ route('staff.settings.index') }}"
class="nav-item {{ request()->is('staff/settings*') ? 'active' : '' }}"
@if(request()->is('staff/settings*')) aria-current="page" @endif>
<i class="fa-solid fa-gear"></i>
<span>Settings</span>
</a>

</nav>

<div class="sidebar-bottom">

<form method="POST" action="{{route('logout')}}">
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