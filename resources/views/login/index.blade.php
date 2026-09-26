<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SmartLocker – Sign In</title>

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
          },
          colors: {
            brand: '#5748fa'
          },
        },
      },
    };
  </script>
</head>

<body class="font-sans antialiased">
  <main class="min-h-screen flex items-center justify-center px-4 py-10 bg-gradient-to-r from-[#2e2a9c] to-[#146a8b]">
    <div class="w-full max-w-[450px] flex flex-col items-center">

      <!-- Logo + title -->
      <div class="w-16 h-16 rounded-2xl bg-white/15 border border-white/25 flex items-center justify-center">
        <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
          <path d="M7 11V7a5 5 0 0 1 10 0v4" />
        </svg>
      </div>

      <h1 class="mt-5 text-4xl leading-10 font-extrabold tracking-tight text-white">SmartLocker</h1>
      <p class="mt-2 text-[15px] leading-5 tracking-wide text-white/75">School Locker Management System</p>

      <!-- Card -->
      <div class="mt-[30px] w-full bg-white rounded-3xl p-9 shadow-2xl shadow-black/20">

        <form action="{{route('users.login')}}" class="mt-7" method="POST">
          @csrf
          <!-- Email -->
          <label for="email" class="block text-sm leading-5 font-semibold text-slate-900 mb-1.5">Email Address</label>
          <input id="email" type="email" value="amirah@school.edu.my" autocomplete="email"
            class="w-full h-12 px-4 rounded-xl border border-slate-200 bg-white text-sm text-slate-600
                   focus:outline-none focus:border-brand focus:ring-4 focus:ring-brand/15 transition" />

          <!-- Password -->
          <label for="password" class="block mt-5 text-sm leading-5 font-semibold text-slate-900 mb-1.5">Password</label>
          <div class="relative">
            <input id="password" type="password" value="password" autocomplete="current-password"
              class="w-full h-12 pl-4 pr-12 rounded-xl border border-slate-200 bg-white text-sm text-slate-400 tracking-[0.2em]
                     focus:outline-none focus:border-brand focus:ring-4 focus:ring-brand/15 transition" />
            <button id="toggle-pw" type="button" aria-label="Show password"
              class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-500 transition">
              <svg class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2.06 12.35a1 1 0 0 1 0-.7 10.75 10.75 0 0 1 19.88 0 1 1 0 0 1 0 .7 10.75 10.75 0 0 1-19.88 0" />
                <circle cx="12" cy="12" r="3" />
              </svg>
            </button>
          </div>

          <!-- Remember / forgot -->
          <div class="mt-[26px] h-5 flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer select-none">
              <input type="checkbox"
                class="w-4 h-4 rounded border-slate-300 text-brand focus:ring-brand/30 focus:ring-2 focus:ring-offset-0" />
              <span class="text-sm font-medium text-slate-500">Remember me</span>
            </label>
            <a href="#" class="text-sm font-semibold text-brand hover:underline">Forgot password?</a>
          </div>

          <!-- Submit -->
          <button type="submit" 
            class="mt-[26px] w-full h-12 rounded-xl bg-brand text-white text-[15px] font-semibold
                   flex items-center justify-center gap-2 hover:brightness-110 active:brightness-95 transition">
            Register
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="m9 18 6-6-6-6" />
            </svg>
          </button>
        </form>
      </div>

      <p class="mt-[29px] text-[13px] leading-5 text-white/75 text-center">
        © 2026 SmartLocker System - School Management
      </p>
    </div>
  </main>

  <script>
    // Tab switching (User / Staff)
    const tabs = {
      user: document.getElementById('tab-user'),
      staff: document.getElementById('tab-staff'),
    };
    const active = ['bg-white', 'text-brand', 'shadow-sm', 'font-semibold'];
    const idle = ['text-slate-500', 'font-medium'];

    function setTab(name) {
      for (const [key, el] of Object.entries(tabs)) {
        const on = key === name;
        el.classList.remove(...(on ? idle : active));
        el.classList.add(...(on ? active : idle));
      }
    }
    tabs.user.addEventListener('click', () => setTab('user'));
    tabs.staff.addEventListener('click', () => setTab('staff'));

    // Show / hide password
    const pw = document.getElementById('password');
    document.getElementById('toggle-pw').addEventListener('click', () => {
      const show = pw.type === 'password';
      pw.type = show ? 'text' : 'password';
      pw.classList.toggle('tracking-[0.2em]', !show);
      pw.classList.toggle('text-slate-400', !show);
      pw.classList.toggle('text-slate-600', show);
    });
  </script>
</body>

</html>