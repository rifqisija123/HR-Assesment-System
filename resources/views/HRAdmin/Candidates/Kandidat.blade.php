@extends('layouts.hradmin')

@section('title', 'Kandidat')
@section('page_title', 'Kandidat')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">DATA PESERTA</div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">Kandidat</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">Kelola peserta, undangan token, dan riwayat asesmen dalam satu tempat.</div>
  </div>
  <div class="flex items-center gap-2.5 shrink-0">
    <a href="{{ url('/hr/candidates/import') }}" class="flex items-center gap-2 h-[42px] px-4 bg-white border border-[#B8CBD6] rounded-[10px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M12 19V5M5 12l7-7 7 7" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">Impor kandidat</span>
    </a>
    <a href="{{ url('/hr/candidates/create') }}" class="flex items-center gap-2 h-[42px] px-[18px] bg-[#17879A] rounded-[10px] cursor-pointer hover:bg-[#147D92] transition-colors no-underline">
      <span class="text-white font-['Inter',system-ui,sans-serif] text-[18px]/[100%] font-bold">+</span>
      <span class="text-white font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">Tambah kandidat</span>
    </a>
  </div>
</div>

{{-- Stat Cards --}}
<div class="flex gap-4">
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E6F4F7] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="9" cy="7" r="4" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M23 21v-2a4 4 0 0 0-3-3.87" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 3.13a4 4 0 0 1 0 7.75" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Total kandidat</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">128</div>
    </div>
  </div>
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E7F5EC] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><polyline points="20 6 9 17 4 12" stroke="#198754" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Undangan terkirim</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">46</div>
    </div>
  </div>
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#FFF3E0] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 8v4" stroke="#D97706" stroke-width="2" stroke-linecap="round"/><path d="M12 16h.01" stroke="#D97706" stroke-width="2" stroke-linecap="round"/></svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Belum mulai</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">19</div>
    </div>
  </div>
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#F0ECF9] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="#6B4FA1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Selesai tes</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">12</div>
    </div>
  </div>
</div>

{{-- Table Card --}}
<div class="flex flex-col bg-white border border-[#DCE6EC] rounded-[14px] overflow-hidden">

  {{-- Toolbar --}}
  <div class="flex items-center justify-between shrink-0 h-[74px] py-[18px] px-5">
    <div class="flex items-center border border-[#D9E2EA] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[340px] focus-within:border-[#147D92] transition-colors">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="shrink-0"><circle cx="11" cy="11" r="7" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="m20 20-4-4" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      <input type="text" placeholder="Cari nama atau email kandidat..." class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] w-full placeholder:text-[#A0AEC0]">
    </div>
    <div class="flex items-center gap-2.5">
      <div class="relative">
        <select class="appearance-none h-10 pl-3.5 pr-9 rounded-[10px] border border-[#D9E2EA] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#52677A] text-[12px]/[16px] outline-none focus:border-[#147D92]">
          <option value="">Semua sesi</option>
          <option>Leadership Trainee — B08</option>
          <option>Sales Associate — Q3</option>
          <option>Graduate Development</option>
        </select>
        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
      <div class="relative">
        <select class="appearance-none h-10 pl-3.5 pr-9 rounded-[10px] border border-[#D9E2EA] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#52677A] text-[12px]/[16px] outline-none focus:border-[#147D92]">
          <option value="">Status undangan</option>
          <option value="terkirim">Terkirim</option>
          <option value="dibuka">Dibuka</option>
          <option value="dimulai">Dimulai</option>
          <option value="selesai">Selesai</option>
          <option value="kadaluwarsa">Kadaluwarsa</option>
          <option value="dibatalkan">Dibatalkan</option>
        </select>
        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
      </div>
    </div>
  </div>

  {{-- Table Header --}}
  <div class="flex items-center shrink-0 h-[44px] px-5 bg-[#F8FAFC] border-t border-b border-[#E6EDF2]">
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] flex-1 min-w-0 pr-4">KANDIDAT</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[175px]">SESI TES</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[145px]">UNDANGAN</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[180px]">PROGRES</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">SKOR</div>
    <div class="shrink-0 w-[38px]"></div>
  </div>

  {{-- Row 1: Andi Pratama — Dimulai / Sedang mengerjakan --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#DCEFF0]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">AP</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Andi Pratama</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">andi.pratama@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Leadership Trainee — B08</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#EEF2FF]">
        <span class="text-[#4338CA] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Dimulai</span>
      </span>
    </div>
    <div class="flex flex-col gap-1.5 shrink-0 w-[180px]">
      <div class="flex justify-between">
        <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">Sedang mengerjakan</span>
        <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">65%</span>
      </div>
      <div class="h-1.5 rounded-full bg-[#E6EDF2]">
        <div class="h-1.5 rounded-full bg-[#147D92]" style="width: 65%"></div>
      </div>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">0 / 100</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
      </div>
    </div>
  </div>

  {{-- Row 2: Sari Wulandari — Dibuka / Belum mulai --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#F0ECF9]">
        <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">SW</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Sari Wulandari</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">sari.wulandari@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Sales Associate — Q3</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#E6F4F7]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Dibuka</span>
      </span>
    </div>
    <div class="flex flex-col gap-1.5 shrink-0 w-[180px]">
      <div class="flex justify-between">
        <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">Belum mulai</span>
        <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">0%</span>
      </div>
      <div class="h-1.5 rounded-full bg-[#E6EDF2]">
        <div class="h-1.5 rounded-full bg-[#D97706]" style="width: 0%"></div>
      </div>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">0 / 100</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kirim ulang
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Edit
        </button>
      </div>
    </div>
  </div>

  {{-- Row 3: Bima Saputra — Selesai / 100% --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#E7F4F1]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">BS</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Bima Saputra</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">bima.saputra@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Graduate Development</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#F0ECF9]">
        <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Selesai</span>
      </span>
    </div>
    <div class="flex flex-col gap-1.5 shrink-0 w-[180px]">
      <div class="flex justify-between">
        <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">Selesai</span>
        <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">100%</span>
      </div>
      <div class="h-1.5 rounded-full bg-[#E6EDF2]">
        <div class="h-1.5 rounded-full bg-[#198754]" style="width: 100%"></div>
      </div>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">0 / 100</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><rect x="9" y="9" width="13" height="13" rx="2" ry="2" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat hasil
        </button>
      </div>
    </div>
  </div>

  {{-- Row 4: Reza Firmansyah — Terkirim / tanpa progres --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#E6F4F7]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">RF</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Reza Firmansyah</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">reza.firmansyah@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Leadership Trainee — B08</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#E7F5EC]">
        <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Terkirim</span>
      </span>
    </div>
    <div class="flex items-center shrink-0 w-[180px]">
      <span class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[13px]/[18px]">—</span>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">—</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kirim ulang
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Edit
        </button>
      </div>
    </div>
  </div>

  {{-- Row 5: Dewi Anggraini — Kadaluwarsa / tanpa progres --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#FFF3E0]">
        <span class="text-[#D97706] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">DA</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Dewi Anggraini</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">dewi.anggraini@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Sales Associate — Q3</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#FFF3E0]">
        <span class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Kadaluwarsa</span>
      </span>
    </div>
    <div class="flex items-center shrink-0 w-[180px]">
      <span class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[13px]/[18px]">—</span>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">—</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kirim ulang
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Edit
        </button>
      </div>
    </div>
  </div>

  {{-- Row 6: Fajar Nugroho — Dibatalkan / tanpa progres --}}
  <div class="flex items-center min-h-[78px] px-5 border-b border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center gap-3 flex-1 min-w-0 pr-4">
      <div class="flex items-center justify-center shrink-0 size-[34px] rounded-full bg-[#F3F4F6]">
        <span class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">FN</span>
      </div>
      <div class="flex flex-col gap-1 min-w-0">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Fajar Nugroho</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">fajar.nugroho@email.com</div>
      </div>
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[175px]">Graduate Development</div>
    <div class="shrink-0 w-[145px]">
      <span class="inline-flex items-center px-2.5 py-1.5 rounded-full bg-[#F3F4F6]">
        <span class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Dibatalkan</span>
      </span>
    </div>
    <div class="flex items-center shrink-0 w-[180px]">
      <span class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[13px]/[18px]">—</span>
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[110px] pl-3">—</div>
    <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
      <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7A8A9A] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0"><circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
      </button>
      <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Lihat detail
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Kirim ulang
        </button>
        <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
          Edit
        </button>
      </div>
    </div>
  </div>

  {{-- Pagination --}}
  <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5]">
    <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
      Menampilkan 1-6 dari 128 kandidat
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
        <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">43</button>
      </div>
      <button class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors">
        Selanjutnya
      </button>
    </div>
  </div>

</div>
@endsection
