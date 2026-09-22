<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verta Assess - @yield('title', 'Dashboard')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    
    <!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased bg-[#F7F9FC]">
    {{-- Sidebar: fixed kiri --}}
    <aside style="position:fixed;top:0;left:0;width:252px;height:100vh;overflow-y:auto;z-index:40;" class="flex flex-col pt-7 pb-5 px-4.5 bg-[#102A43]">
        <div class="flex items-center pb-7 gap-3 px-2 border-b border-b-solid border-b-[#DDE6ED2E]">
          <div class="w-9.5 h-9.5 flex items-center justify-center rounded-[11px] shrink-0 bg-[#147D92]">
            <div class="flex font-['Inter',system-ui,sans-serif] font-extrabold text-white text-[19px]/6">
              V
            </div>
          </div>
          <div class="flex flex-col gap-0.5">
            <div class="tracking-[-0.02em] font-['Inter',system-ui,sans-serif] font-bold text-white text-base/5">
              Verta Assess
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#AFC2D0] text-xs/4">
              Control center
            </div>
          </div>
        </div>
        <div class="flex flex-col pt-6.5 gap-1.5">
          <div class="pb-1.25 px-2.5">
            <div class="tracking-widest font-['Inter',system-ui,sans-serif] font-bold text-[#89A1B3] text-[11px]/4">
              ADMINISTRASI
            </div>
          </div>
          <a href="{{ url('/hr/dashboard') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 {{ request()->is('hr/dashboard*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors cursor-pointer no-underline">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <rect x="3" y="3" width="7" height="7" rx="1" fill="none" stroke="{{ request()->is('hr/dashboard*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="14" y="3" width="7" height="7" rx="1" fill="none" stroke="{{ request()->is('hr/dashboard*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="3" y="14" width="7" height="7" rx="1" fill="none" stroke="{{ request()->is('hr/dashboard*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="14" y="14" width="7" height="7" rx="1" fill="none" stroke="{{ request()->is('hr/dashboard*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/dashboard*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Dashboard
            </div>
          </a>
          <a href="{{ url('/hr/question-categories') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 {{ request()->is('hr/question-categories*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors cursor-pointer no-underline">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z" fill="none" stroke="{{ request()->is('hr/question-categories*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/question-categories*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Kategori soal
            </div>
          </a>
          <a href="{{ url('/hr/question-bank') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 {{ request()->is('hr/question-bank*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors cursor-pointer no-underline">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="{{ request()->is('hr/question-bank*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="9" cy="7" r="4" fill="none" stroke="{{ request()->is('hr/question-bank*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" fill="none" stroke="{{ request()->is('hr/question-bank*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" fill="none" stroke="{{ request()->is('hr/question-bank*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/question-bank*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Bank soal
            </div>
          </a>
          <a href="{{ url('/hr/test-packages') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 {{ request()->is('hr/test-packages*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors cursor-pointer no-underline">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <circle cx="12" cy="12" r="3" fill="none" stroke="{{ request()->is('hr/test-packages*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06-2 2-.06-.06A1.65 1.65 0 0 0 16 18.4a1.65 1.65 0 0 0-1 1.51V20h-3v-.09A1.65 1.65 0 0 0 11 18.4a1.65 1.65 0 0 0-1.82.33l-.06.06-2-2 .06-.06A1.65 1.65 0 0 0 7.6 15a1.65 1.65 0 0 0-1.51-1H6v-3h.09A1.65 1.65 0 0 0 7.6 10a1.65 1.65 0 0 0-.33-1.82l-.06-.06 2-2 .06.06A1.65 1.65 0 0 0 11 5.6h.01A1.65 1.65 0 0 0 12 4.09V4h3v.09A1.65 1.65 0 0 0 16 5.6h.01a1.65 1.65 0 0 0 1.82-.33l.06-.06 2 2-.06.06A1.65 1.65 0 0 0 19.4 9v.01A1.65 1.65 0 0 0 20.91 10H21v3h-.09A1.65 1.65 0 0 0 19.4 14Z" fill="none" stroke="{{ request()->is('hr/test-packages*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/test-packages*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Paket tes
            </div>
          </a>
          <a href="{{ url('/hr/test-sessions') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 cursor-pointer {{ request()->is('hr/test-sessions*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors decoration-none">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" fill="none" stroke="{{ request()->is('hr/test-sessions*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/test-sessions*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Sesi tes
            </div>
          </a>
          <a href="{{ url('/hr/candidates') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 cursor-pointer {{ request()->is('hr/candidates*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors decoration-none">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="{{ request()->is('hr/candidates*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="9" cy="7" r="4" fill="none" stroke="{{ request()->is('hr/candidates*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19 8v6" fill="none" stroke="{{ request()->is('hr/candidates*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22 11h-6" fill="none" stroke="{{ request()->is('hr/candidates*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/candidates*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Kandidat
            </div>
          </a>
          <a href="{{ url('/hr/reports') }}" class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 cursor-pointer {{ request()->is('hr/reports*') ? 'bg-[#1D4C63] text-white' : 'hover:bg-[#1D4C63] text-[#B7C8D5]' }} transition-colors decoration-none">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M3 3v18h18" fill="none" stroke="{{ request()->is('hr/reports*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m7 16 4-5 3 3 5-7" fill="none" stroke="{{ request()->is('hr/reports*') ? '#75D5D0' : '#B7C8D5' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] {{ request()->is('hr/reports*') ? 'font-semibold text-white' : 'font-medium text-[#B7C8D5]' }} text-sm/5">
              Laporan
            </div>
          </a>
        </div>
        <div class="grow basis-[0%]"></div>
        <div class="flex items-center pt-4.5 gap-2.5 px-2 border-t border-t-solid border-t-[#DDE6ED2E]">
          <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#D1F0ED] size-9">
            <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#125A6B] text-[13px]/4.5">
              NP
            </div>
          </div>
          <div class="flex flex-col grow basis-[0%] gap-0.5">
            <div class="font-['Inter',system-ui,sans-serif] font-semibold text-white text-[13px]/4.5">
              Nadia Putri
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#AFC2D0] text-xs/4">
              HR Admin
            </div>
          </div>
          <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#AFC2D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </aside>

      {{-- Main area: margin-left sesuai lebar sidebar --}}
      <div style="margin-left:252px;min-height:100vh;display:flex;flex-direction:column;">
        {{-- Navbar: fixed di atas --}}
        <nav style="position:fixed;top:0;left:252px;right:0;height:72px;z-index:30;" class="flex items-center justify-between px-10 bg-white border-b border-[#DDE6ED]">
          <div class="flex items-center gap-2.5">
            <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#6B8192] text-sm/5">
              HR Admin
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#B5C3CC] text-sm/5">
              /
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#102A43] text-sm/5">
              @yield('page_title', 'Ringkasan')
            </div>
          </div>
          <div class="flex items-center gap-2.5">
            <div class="flex items-center justify-center rounded-[10px] shrink-0 border border-solid border-[#DDE6ED] size-9">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <circle cx="12" cy="12" r="10" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.09 9a3 3 0 1 1 5.83 1c0 2-3 2-3 4" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 17h.01" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="flex items-center justify-center rounded-[10px] relative shrink-0 border border-solid border-[#DDE6ED] size-9">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 21h4" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="absolute top-2 right-2 rounded-[3px] bg-[#147D92] border border-solid border-[#FFFFFF] size-1.5"></div>
            </div>
          </div>
        </nav>
        {{-- Content: padding-top untuk offset navbar --}}
        <main style="padding-top:72px;flex:1;">
          <div class="py-9.5 pb-10 flex flex-col gap-6.5 px-10">
            @yield('content')
          </div>
        </main>
      </div>
</body>
</html>
