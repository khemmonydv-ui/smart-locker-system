<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $title ?? 'Smart Locker System' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<div class="app-layout">
<!-- sidebar -->
<x-sidebar />
<div class="main-wrapper">
<!-- navbar -->
<x-navbar
:title="$title ?? 'User'"
/>

<!-- page-content -->
<main class="page-content">



    <x-user-table :users="$users" />

</main>

</div>
</div>

@stack('scripts')

</body>

</html>