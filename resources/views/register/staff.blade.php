<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Register - SmartLocker</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-[#2e2a9c] to-[#146a8b] flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl p-8 shadow-xl">

        <h1 class="text-2xl font-bold text-gray-900">
            Staff Register
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Create your SmartLocker staff account
        </p>


        <form
            action="{{ route('register.staff.store') }}"
            method="POST"
            class="mt-6">

            @csrf


            <!-- Name -->
            <label class="block text-sm font-semibold mb-2">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                class="w-full h-11 px-4 border rounded-lg mb-4"
                placeholder="Enter your name"
            >

            @error('name')
                <p class="text-sm text-red-500 mb-3">
                    {{ $message }}
                </p>
            @enderror


            <!-- Email -->
            <label class="block text-sm font-semibold mb-2">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full h-11 px-4 border rounded-lg mb-4"
                placeholder="Enter your email"
            >

            @error('email')
                <p class="text-sm text-red-500 mb-3">
                    {{ $message }}
                </p>
            @enderror


            <!-- Password -->
            <label class="block text-sm font-semibold mb-2">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full h-11 px-4 border rounded-lg mb-4"
                placeholder="Enter your password"
            >

            @error('password')
                <p class="text-sm text-red-500 mb-3">
                    {{ $message }}
                </p>
            @enderror


            <!-- Confirm Password -->
            <label class="block text-sm font-semibold mb-2">
                Confirm Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full h-11 px-4 border rounded-lg"
                placeholder="Confirm your password"
            >


            <!-- Button -->
            <button
                type="submit"
                class="w-full mt-6 h-11 bg-[#5748fa] text-white rounded-lg font-semibold hover:opacity-90">

                Create Staff Account

            </button>

        </form>


        <!-- Back to Login -->
        <div class="text-center mt-5">

            <a
                href="{{ route('login') }}"
                class="text-sm text-[#5748fa] font-semibold hover:underline">

                Back to Login

            </a>

        </div>

    </div>

</body>

</html>