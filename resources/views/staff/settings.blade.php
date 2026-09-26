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

    <x-sidebar />

    <div class="main-wrapper">

        <x-navbar
            :title="$title ?? 'Settings'"
            :subtitle="$subtitle ?? 'Manage system and account preferences'"
        />

        <main class="page-content">

            @if (session('success'))
                <div class="badge success" style="margin-bottom: 16px;">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="badge pending" style="margin-bottom: 16px; display:block;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- System Information --}}
            <div class="content-card" style="max-width: 640px; padding: 24px; margin-bottom: 24px;">
                <h3 style="margin-bottom: 20px;">System Information</h3>

                <form action="{{ route('settings.system') }}" method="POST">
                    @csrf

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">System Name</label>
                    <input
                        type="text"
                        name="system_name"
                        value="{{ old('system_name', $systemSettings['system_name']) }}"
                        placeholder="SmartHub Locker System"
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    {{-- TODO: rename these two once the real fields are confirmed --}}
                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Field Two</label>
                    <input
                        type="text"
                        name="field_two"
                        value="{{ old('field_two', $systemSettings['field_two']) }}"
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Field Three</label>
                    <input
                        type="text"
                        name="field_three"
                        value="{{ old('field_three', $systemSettings['field_three']) }}"
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    <button type="submit" class="primary-button">Save Changes</button>
                </form>
            </div>

            {{-- Admin Account --}}
            <div class="content-card" style="max-width: 640px; padding: 24px; gap: 5px">
                <h3 style="margin-bottom: 20px;">Admin Account</h3>

                <form action="{{ route('settings.account') }}" method="POST">
                    @csrf

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Admin Name</label>
                    <input
                        type="text"
                        name="name"
                        value=""
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Email</label>
                    <input
                        type="email"
                        name="email"
                        value=""
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4 "
                        style="border: 1px solid var(--border-color);"
                    >

                    
                    <button
                        type="button"
                        onclick="document.getElementById('password-fields').classList.toggle('hidden')"
                        class="notification-button"
                        style="width:auto; padding: 0 16px; font-size: 13px;"
                    >
                        Change Password
                    </button>
                </form>

                <div id="password-fields" class="hidden" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border-color);">
                    <form action="{{ route('settings.password') }}" method="POST">
                        @csrf

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                            style="border: 1px solid var(--border-color);"
                        >

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">New Password</label>
                        <input
                            type="password"
                            name="password"
                            class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                            style="border: 1px solid var(--border-color);"
                        >

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Confirm New Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                            style="border: 1px solid var(--border-color);"
                        >

                        <button type="submit" class="primary-button">Update Password</button>
                    </form>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>