@extends('layouts.hradmin')

@section('title', 'Paket tes')
@section('page_title', 'Paket tes')

@section('content')
<div class="flex items-end justify-between">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">
      KONTEN ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">
      Paket tes
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">
      Gabungkan soal menjadi paket siap pakai untuk setiap kebutuhan rekrutmen.
    </div>
  </div>
  <a href="{{ url('/hr/test-packages/create') }}" class="flex items-center bg-[#17879A] text-white rounded-[10px] gap-2 h-[42px] px-[18px] cursor-pointer hover:bg-[#147587] transition-colors no-underline">
    <span class="font-['Inter',system-ui,sans-serif] text-[18px] font-bold leading-none">+</span>
    <span class="font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">Buat paket tes</span>
  </a>
</div>

<div class="flex gap-4">
  <!-- Card 1: Paket aktif -->
  <div class="flex items-center bg-white border border-[#DCE6EC] rounded-[14px] flex-1 gap-[14px] min-h-[76px] py-[18px] px-5">
    <div class="flex items-center justify-center bg-[#E7F5EC] rounded-[11px] shrink-0 size-[38px]">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#198754" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12" />
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Paket aktif
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
        12
      </div>
    </div>
  </div>

  <!-- Card 2: Dipakai sesi aktif -->
  <div class="flex items-center bg-white border border-[#DCE6EC] rounded-[14px] flex-1 gap-[14px] min-h-[76px] py-[18px] px-5">
    <div class="flex items-center justify-center bg-[#E6F4F7] rounded-[11px] shrink-0 size-[38px]">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#147D92" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="7" y1="17" x2="17" y2="7" />
        <polyline points="7 7 17 7 17 17" />
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Dipakai sesi aktif
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
        7
      </div>
    </div>
  </div>

  <!-- Card 3: Soal terhubung -->
  <div class="flex items-center bg-white border border-[#DCE6EC] rounded-[14px] flex-1 gap-[14px] min-h-[76px] py-[18px] px-5">
    <div class="flex items-center justify-center bg-[#F0ECF9] rounded-[11px] shrink-0 size-[38px]">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6B4FA1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="4" y1="9" x2="20" y2="9" />
        <line x1="4" y1="15" x2="20" y2="15" />
        <line x1="10" y1="3" x2="8" y2="21" />
        <line x1="16" y1="3" x2="14" y2="21" />
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Soal terhubung
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
        246
      </div>
    </div>
  </div>
</div>

<div class="flex flex-col bg-white border border-[#DCE6EC] rounded-[14px] overflow-hidden">
  <!-- Filters & Search -->
  <div class="flex items-center justify-between shrink-0 h-[74px] py-[18px] px-5 bg-white">
    <div class="flex items-center border border-[#D9E2EA] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[340px]">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
      <input type="text" placeholder="Cari nama paket tes..." class="w-full bg-transparent border-none outline-none text-[#102A43] placeholder-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[13px]/[16px]">
    </div>

    <div class="flex items-center gap-[10px]">
      <div class="relative">
        <select class="appearance-none h-10 pl-3.5 pr-8 border border-[#D9E2EA] rounded-[10px] bg-white text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] outline-none cursor-pointer hover:bg-gray-50 transition-colors">
          <option value="">Semua status</option>
          <option value="aktif">Aktif</option>
          <option value="nonaktif">Nonaktif</option>
          <option value="draft">Draft</option>
        </select>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </div>

      <div class="relative">
        <select class="appearance-none h-10 pl-3.5 pr-8 border border-[#D9E2EA] rounded-[10px] bg-white text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] outline-none cursor-pointer hover:bg-gray-50 transition-colors">
          <option value="">Semua durasi</option>
          <option value="45">45 menit</option>
          <option value="60">60 menit</option>
          <option value="75">75 menit</option>
          <option value="90">90 menit</option>
          <option value="120">120 menit</option>
        </select>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
          <polyline points="6 9 12 15 18 9" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Table Header -->
  <div class="flex items-center bg-[#F8FAFC] border-y border-[#E6EDF2] shrink-0 h-[44px] px-5">
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] flex-1 min-w-0 pr-4">
      PAKET TES
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">
      SOAL
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">
      DURASI
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[130px]">
      SESI AKTIF
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">
      STATUS
    </div>
    <div class="shrink-0 w-[38px]"></div>
  </div>

  <!-- Table Content -->
  <div class="flex flex-col">
    <!-- Item 1 -->
    <div class="flex items-center border-b border-[#E6EDF2] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#E7F4F1] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[16px]/[20px] font-bold">A</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Assessment Dasar
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Diperbarui 08 Agu 2026 &middot; Nadia Putri
          </div>
        </div>
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        40 soal
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px]">
        60 menit
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
        4 sesi
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#E7F5EC] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#198754] shrink-0"></span>
          <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Aktif</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#102A43] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="5" cy="12" r="1" />
            <circle cx="12" cy="12" r="1" />
            <circle cx="19" cy="12" r="1" />
          </svg>
        </button>

        <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-8 w-36 bg-white rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit
          </button>
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 6h18"/>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
            </svg>
            Hapus
          </button>
        </div>
      </div>
    </div>

    <!-- Item 2 -->
    <div class="flex items-center border-b border-[#E6EDF2] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#E6F0F5] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[16px]/[20px] font-bold">S</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Sales & Service
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Diperbarui 07 Agu 2026 &middot; Nadia Putri
          </div>
        </div>
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        32 soal
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px]">
        45 menit
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
        2 sesi
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#E6F4F7] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#147D92] shrink-0"></span>
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Aktif</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#102A43] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="5" cy="12" r="1" />
            <circle cx="12" cy="12" r="1" />
            <circle cx="19" cy="12" r="1" />
          </svg>
        </button>

        <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-8 w-36 bg-white rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit
          </button>
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 6h18"/>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
            </svg>
            Hapus
          </button>
        </div>
      </div>
    </div>

    <!-- Item 3 -->
    <div class="flex items-center border-b border-[#E6EDF2] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#F0ECF9] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[16px]/[20px] font-bold">G</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Kompetensi & Logika
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Diperbarui 03 Agu 2026 &middot; Siti Rahma
          </div>
        </div>
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        54 soal
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px]">
        75 menit
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
        0 sesi
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#F3F5F7] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#9AA7B3] shrink-0"></span>
          <span class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Draft</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#102A43] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="5" cy="12" r="1" />
            <circle cx="12" cy="12" r="1" />
            <circle cx="19" cy="12" r="1" />
          </svg>
        </button>

        <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-8 w-36 bg-white rounded-lg shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Edit
          </button>
          <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 6h18"/>
              <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
            </svg>
            Hapus
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Footer / Pagination -->
  <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5]">
    <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
      Menampilkan 1-3 dari 12 paket tes
    </div>
    <div class="flex items-center gap-2.5">
      <button class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
        Sebelumnya
      </button>
      
      <div class="flex items-center gap-1 mx-1">
        <button class="size-8 rounded-[6px] bg-[#147D92] text-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center">1</button>
        <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">2</button>
        <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">3</button>
        <span class="text-[#62798A] px-1">...</span>
        <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">4</button>
      </div>

      <button class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors">
        Selanjutnya
      </button>
    </div>
  </div>
</div>
@endsection
