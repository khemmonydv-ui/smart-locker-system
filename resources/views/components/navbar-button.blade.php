@props([
'title' => 'Dashboard',

])

<header class="navbar">

    <button type="button" class="mobile-menu-button" aria-label="Open menu" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="page-heading">
        <h1>{{ $title }}</h1>
    </div>

    <!-- Right side -->
    <button
        type="button"
        onclick="openAdd()"
        class="flex items-center gap-2 bg-[var(--button)] text-white px-4 py-2 rounded-lg">
        <i class="fa-solid fa-plus"></i>
        Add Location
    </button>

    </a>

</header>