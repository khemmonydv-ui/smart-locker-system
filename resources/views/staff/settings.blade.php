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
            :subtitle="$subtitle ?? 'Manage your account preferences'"
        />

        <main class="page-content">

            {{-- Success message after saving --}}
            @if (session('success'))
                <div class="badge success" style="margin-bottom: 16px;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation errors from either form below --}}
            @if ($errors->any())
                <div class="badge pending" style="margin-bottom: 16px; display:block;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Admin Account --}}
            <div class="content-card" style="max-width: 640px; padding: 24px; gap: 5px">
                <h3 style="margin-bottom: 20px;">Admin Account</h3>

                <form action="{{ route('staff.settings.account') }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Admin Name</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                        class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                        style="border: 1px solid var(--border-color);"
                    >

                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        <button type="submit" class="primary-button">Save Account</button>

                        <button
                            type="button"
                            onclick="document.getElementById('password-fields').classList.toggle('hidden')"
                            class="notification-button"
                            style="width:auto; padding: 0 16px; font-size: 13px;"
                        >
                            Change Password
                        </button>
                    </div>
                </form>

                {{-- Change Password (kept as a separate form, since HTML doesn't
                     allow a form inside another form) --}}
                <div
                    id="password-fields"
                    class="{{ $errors->has('current_password') || $errors->has('password') ? '' : 'hidden' }}"
                    style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border-color);"
                >
                    <form action="{{ route('staff.settings.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Current Password</label>
                        <input
                            type="password"
                            name="current_password"
                            autocomplete="current-password"
                            required
                            class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                            style="border: 1px solid var(--border-color);"
                        >

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">New Password</label>
                        <input
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg px-3 py-2 text-sm mb-4"
                            style="border: 1px solid var(--border-color);"
                        >

                        <label style="display:block; font-size:13px; font-weight:500; margin-bottom:6px;">Confirm New Password</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            required
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