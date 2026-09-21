<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-start justify-center py-10 px-4">

    <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg p-6">
        <h1 class="text-lg font-medium text-gray-900 mb-6">Edit Profile</h1>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs text-gray-400 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div>
                <label class="block text-xs text-gray-400 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $profile->address) }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-blue-600 text-white text-sm font-medium py-2 rounded-md hover:bg-blue-700">
                    Save Changes
                </button>
                <a href="{{ route('profile.index') }}" class="flex-1 text-center border border-gray-300 text-sm font-medium py-2 rounded-md hover:bg-gray-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</body>
</html> 