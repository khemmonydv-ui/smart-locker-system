@props([
    'title' => 'Dashboard',
    'subtitle' => 'Overview of your Smart Locker System',
])

<header class="navbar">

    <button type="button" class="mobile-menu-button" aria-label="Open menu" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="page-heading">
        <h1>{{ $title }}</h1>
    </div>

</header>