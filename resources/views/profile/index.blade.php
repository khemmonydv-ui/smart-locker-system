<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen flex items-start justify-center py-10 px-4">

  <div class="w-full max-w-[1000px] space-y-6">

    <!-- Header card -->
    <div class="bg-white border w-[1000px] border-gray-200 rounded-lg p-8 flex flex-col items-center text-center">
      <div class="w-24 h-24 rounded-full bg-gray-200">
         @if ($profile->avatar)
            <img src="{{ asset('storage/' . $profile->avatar) }}" class="w-full h-full object-cover" alt="Avatar">
        @endif
      </div>
      <h1 class="mt-4 text-2xl font-medium text-gray-900">{{ $profile->name }}</h1>
      <span class="mt-2 inline-block px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
        Active
      </span>
    </div>

    <!-- Details card -->
    <div class="bg-white w-[1000px] border border-gray-200 rounded-lg p-6">
      <dl class="space-y-5">

        <div class="flex items-start gap-3">
          <span class="mt-0.5 pt-2  text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          </span>
          <div>
            <dt class="text-md text-gray-400">{{ $profile->name }}</dt>
            <dd class="text-lg font-medium text-gray-900">Alex Johnson</dd>
          </div>
        </div>

        <div class="flex items-start gap-3">
          <span class="mt-0.5 pt-2 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
          </span>
          <div>
            <dt class="text-md text-gray-400">Email</dt>
            <dd class="text-lg font-medium text-gray-900">{{ $profile->email }}</dd>
          </div>
        </div>

        <div class="flex items-start gap-3">
          <span class="mt-0.5 pt-2 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.362 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.338 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </span>
          <div>
            <dt class="text-md text-gray-400">Phone</dt>
            <dd class="text-lg font-medium text-gray-900">{{ $profile->phone ?? '—' }}</dd>
          </div>
        </div>

        <div class="flex items-start gap-3">
          <span class="mt-0.5 pt-2 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </span>
          <div>
            <dt class="text-md text-gray-400">Member since</dt>
            <dd class="text-lg font-medium text-gray-900">{{ $profile->created_at->format('F Y') }}</dd>
          </div>
        </div>

        <div class="flex items-start gap-3">
          <span class="mt-0.5 pt-2 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
          </span>
          <div>
            <dt class="text-md text-gray-400">Total sessions</dt>
            <dd class="text-lg font-medium text-gray-900">14</dd>
          </div>
        </div>

      </dl>
    </div>

    <!-- Actions card -->
    <div class=" w-[1000px] bg-white border border-gray-200 rounded-lg overflow-hidden">

      <a href="{{ route('profile.edit') }}" class="w-full flex items-center gap-3 px-6 py-4 text-lg font-medium text-gray-900 hover:bg-gray-50 border-b border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>

            Edit Profile
      </a>

      <button class="w-full flex items-center gap-3 px-6 py-4 text-lg font-medium text-gray-900 hover:bg-gray-50 border-b border-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        Change Password
      </button>

      <button class="w-full flex items-center gap-3 px-6 py-4 text-lg font-medium text-gray-900 hover:bg-gray-50 border-b border-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        Usage History
      </button>

      <button class="w-full flex items-center gap-3 px-6 py-4 text-lg font-medium text-red-500 hover:bg-red-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
        Logout
      </button>

    </div>

  </div>

</body>
</html>
