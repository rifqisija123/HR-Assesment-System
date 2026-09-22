@extends('layouts.hradmin')

@section('title', 'Sesi tes')
@section('page_title', 'Sesi tes')

@section('content')
<!-- Flatpickr Datepicker Assets -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
  function initDateRangePicker(el) {
    if (typeof flatpickr === 'undefined') return;
    flatpickr(el, {
      mode: 'range',
      dateFormat: 'd M Y',
      locale: (flatpickr.l10ns && flatpickr.l10ns.id) ? flatpickr.l10ns.id : 'default',
      conjunction: ' - ',
      onReady: function(selectedDates, dateStr, instance) {
        const btnContainer = document.createElement('div');
        btnContainer.className = 'flatpickr-footer-container';
        
        const infoText = document.createElement('span');
        infoText.className = 'flatpickr-footer-info';
        infoText.innerText = 'Pilih rentang tanggal';

        const resetBtn = document.createElement('button');
        resetBtn.type = 'button';
        resetBtn.className = 'flatpickr-footer-reset-btn';
        resetBtn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg> Reset Tanggal';
        
        resetBtn.addEventListener('click', function() {
          instance.clear();
        });
        
        btnContainer.appendChild(infoText);
        btnContainer.appendChild(resetBtn);
        instance.calendarContainer.appendChild(btnContainer);
      }
    });
  }
</script>

<style>
  .flatpickr-calendar {
    font-family: 'Inter', system-ui, sans-serif !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
    border: 1px solid #EDF2F5 !important;
  }
  .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange, 
  .flatpickr-day.selected.inRange, .flatpickr-day.startRange.inRange, .flatpickr-day.endRange.inRange, 
  .flatpickr-day.selected:focus, .flatpickr-day.startRange:focus, .flatpickr-day.endRange:focus, 
  .flatpickr-day.selected:hover, .flatpickr-day.startRange:hover, .flatpickr-day.endRange:hover {
    background: #147D92 !important;
    border-color: #147D92 !important;
  }
  .flatpickr-day.inRange {
    box-shadow: -5px 0 0 #E2F4F3, 5px 0 0 #E2F4F3 !important;
    background: #E2F4F3 !important;
    border-color: #E2F4F3 !important;
    color: #147D92 !important;
  }
  .flatpickr-footer-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 12px;
    border-top: 1px solid #EDF2F5;
    background-color: #F8FAFC;
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
  }
  .flatpickr-footer-info {
    color: #7890A0;
    font-size: 11px;
    font-weight: 500;
    font-family: 'Inter', system-ui, sans-serif;
  }
  .flatpickr-footer-reset-btn {
    color: #62798A;
    font-size: 12px;
    font-weight: 600;
    font-family: 'Inter', system-ui, sans-serif;
    background: none;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.15s ease;
  }
  .flatpickr-footer-reset-btn:hover {
    color: #102A43;
  }
</style>

<div class="flex justify-between items-end gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      PELAKSANAAN ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Sesi tes
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Jadwalkan tes, kirim undangan, dan pantau progres kandidat.
    </div>
  </div>
  <a href="{{ url('/hr/test-sessions/create') }}" class="flex items-center bg-[#147D92] rounded-[10px] shrink-0 gap-[9px] h-[42px] px-4 cursor-pointer hover:bg-[#126f82] transition-colors no-underline">
    <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
      <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
    </svg>
    <div class="text-white font-['Inter',system-ui,sans-serif] text-[14px]/[20px] font-[650]">
      Buat sesi tes
    </div>
  </a>
</div>

<div class="flex gap-4">
  <!-- Card 1: Sedang berjalan -->
  <div class="flex items-center bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[14px] py-4 px-[18px]">
    <div class="flex items-center justify-center bg-[#E7F6EE] rounded-[10px] shrink-0 size-[36px]">
      <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <circle cx="12" cy="12" r="9" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="m9 12 2 2 4-4" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="flex flex-col gap-[3px]">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium">
        Sedang berjalan
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[28px] font-[750]">
        4 sesi
      </div>
    </div>
  </div>

  <!-- Card 2: Terjadwal -->
  <div class="flex items-center bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[14px] py-4 px-[18px]">
    <div class="flex items-center justify-center bg-[#E2F4F3] rounded-[10px] shrink-0 size-[36px]">
      <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <rect x="3" y="4" width="18" height="17" rx="2" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M16 2v4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M8 2v4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M3 10h18" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="flex flex-col gap-[3px]">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium">
        Terjadwal
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[28px] font-[750]">
        7 sesi
      </div>
    </div>
  </div>

  <!-- Card 3: Selesai bulan ini -->
  <div class="flex items-center bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[14px] py-4 px-[18px]">
    <div class="flex items-center justify-center bg-[#EFE9FB] rounded-[10px] shrink-0 size-[36px]">
      <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <path d="m5 12 4 4L19 6" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
    </div>
    <div class="flex flex-col gap-[3px]">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium">
        Selesai bulan ini
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[28px] font-[750]">
        18 sesi
      </div>
    </div>
  </div>
</div>

<div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] overflow-hidden">
  <!-- Search & Filters -->
  <div class="flex items-center justify-between border-b border-[#EDF2F5] shrink-0 gap-4 h-[76px] py-4 px-5">
    <div class="flex items-center border border-[#DDE6ED] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[280px] focus-within:border-[#147D92] transition-colors">
      <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <circle cx="11" cy="11" r="7" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        <path d="m20 20-4-4" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <input type="text" placeholder="Cari nama sesi atau paket tes..." class="bg-transparent border-none outline-none text-[#102A43] placeholder-[#92A4B0] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full">
    </div>
    <div class="flex gap-2.5">
      <!-- Filter Rentang Tanggal -->
      <div class="relative">
        <div class="flex items-center border border-[#DDE6ED] rounded-[10px] gap-2.5 h-10 px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
            <rect x="3" y="4" width="18" height="18" rx="2" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M16 2v4M8 2v4M3 10h18" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input x-init="initDateRangePicker($el)" type="text" placeholder="Pilih rentang tanggal..." class="bg-transparent border-none outline-none text-[#486174] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium w-[195px] cursor-pointer placeholder:text-[#92A4B0]">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
            <polyline points="6 9 12 15 18 9" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <!-- Filter Rentang Waktu -->
      <div class="relative" x-data="{ timeOpen: false, startTime: '', endTime: '', displayTime: '' }" @click.outside="timeOpen = false">
        <div @click="timeOpen = !timeOpen" class="flex items-center border border-[#DDE6ED] rounded-[10px] gap-2.5 h-10 px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 pointer-events-none">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          <input type="text" readonly :value="displayTime" placeholder="Pilih rentang waktu..." class="bg-transparent border-none outline-none text-[#486174] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium w-[160px] cursor-pointer placeholder:text-[#92A4B0]">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
            <polyline points="6 9 12 15 18 9" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <!-- Popover Dropdown for Time Range -->
        <div x-show="timeOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute left-0 top-11 w-64 bg-white rounded-[12px] shadow-[0_10px_25px_-5px_rgba(0,0,0,0.1)] border border-[#EDF2F5] z-30 p-3 flex flex-col gap-3">
          <div class="flex items-center justify-between gap-2">
            <div class="flex flex-col gap-1 flex-1">
              <span class="text-[#7890A0] text-[11px] font-semibold font-['Inter',system-ui,sans-serif]">Jam Mulai</span>
              <input type="time" x-model="startTime" @change="displayTime = (startTime && endTime) ? `${startTime} - ${endTime}` : (startTime ? `${startTime} - ...` : '')" class="h-9 px-2 rounded-md border border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[12px] text-[#102A43] outline-none focus:border-[#147D92] bg-[#F8FAFC]">
            </div>
            <span class="text-[#94A3B8] text-[12px] font-semibold pt-4">s/d</span>
            <div class="flex flex-col gap-1 flex-1">
              <span class="text-[#7890A0] text-[11px] font-semibold font-['Inter',system-ui,sans-serif]">Jam Selesai</span>
              <input type="time" x-model="endTime" @change="displayTime = (startTime && endTime) ? `${startTime} - ${endTime}` : (endTime ? `... - ${endTime}` : '')" class="h-9 px-2 rounded-md border border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[12px] text-[#102A43] outline-none focus:border-[#147D92] bg-[#F8FAFC]">
            </div>
          </div>
          <div class="flex items-center justify-between pt-2 border-t border-[#EDF2F5]">
            <button type="button" @click="startTime = ''; endTime = ''; displayTime = '';" class="text-[#62798A] text-[11px] font-semibold font-['Inter',system-ui,sans-serif] bg-transparent border-none cursor-pointer flex items-center gap-1 hover:text-[#102A43] transition-colors">
              <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              Reset
            </button>
            <button type="button" @click="timeOpen = false" class="h-7 px-3 rounded-md bg-[#147D92] text-white text-[11px] font-semibold font-['Inter',system-ui,sans-serif] border-none cursor-pointer hover:bg-[#126f82] transition-colors">
              Terapkan
            </button>
          </div>
        </div>
      </div>

      <!-- Status Filter -->
      <div class="relative">
        <select class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
          <option value="">Semua status</option>
          <option value="aktif">Aktif</option>
          <option value="terjadwal">Terjadwal</option>
          <option value="selesai">Selesai</option>
        </select>
        <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Table Header -->
  <div class="flex items-center bg-[#F8FAFC] border-y border-[#E6EDF2] shrink-0 h-[44px] px-5">
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] flex-1 min-w-0 pr-4">
      NAMA SESI
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[180px]">
      PAKET TES
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">
      PESERTA
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[180px]">
      JADWAL
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">
      STATUS
    </div>
    <div class="shrink-0 w-[38px]"></div>
  </div>

  <!-- Table Content -->
  <div class="flex flex-col">
    <!-- Item 1 -->
    <div class="flex items-center border-b border-[#EDF2F5] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#E7F4F1] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[14px]/[18px] font-bold">LT</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Leadership Trainee — Batch 08
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Dibuat 08 Agu 2026 &middot; Nadia Putri
          </div>
        </div>
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
        Assessment Dasar
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        32 kandidat
      </div>
      <div class="flex flex-col gap-1 shrink-0 w-[180px]">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          10 Agu 2026
        </div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">
          09.00 – 16.00 WIB
        </div>
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#E7F5EC] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#198754] shrink-0"></span>
          <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Aktif</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
            <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
    <div class="flex items-center border-b border-[#EDF2F5] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#E6F0F5] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[14px]/[18px] font-bold">SA</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Sales Associate — Q3 Hiring
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Dibuat 08 Agu 2026 &middot; Nadia Putri
          </div>
        </div>
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
        Sales & Service
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        20 kandidat
      </div>
      <div class="flex flex-col gap-1 shrink-0 w-[180px]">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          11 Agu 2026
        </div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">
          09.00 – 17.30 WIB
        </div>
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#E6F4F7] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#147D92] shrink-0"></span>
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Terjadwal</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
            <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
    <div class="flex items-center border-b border-[#EDF2F5] shrink-0 min-h-[78px] px-5 hover:bg-gray-50/50 transition-colors">
      <div class="flex items-center flex-1 gap-3 min-w-0 pr-4">
        <div class="flex items-center justify-center bg-[#F0ECF9] rounded-[10px] shrink-0 size-[34px]">
          <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">GD</span>
        </div>
        <div class="flex flex-col gap-1 min-w-0">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">
            Graduate Development Program
          </div>
          <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">
            Dibuat 01 Agu 2026 &middot; Siti Rahma
          </div>
        </div>
      </div>
      <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
        Kompetensi & Logika
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[110px]">
        48 kandidat
      </div>
      <div class="flex flex-col gap-1 shrink-0 w-[180px]">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          06 Agu 2026
        </div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">
          09.00 – 15.00 WIB
        </div>
      </div>
      <div class="shrink-0 w-[110px]">
        <div class="inline-flex items-center gap-1.5 bg-[#F0ECF9] rounded-full py-[6px] px-[10px]">
          <span class="size-[6px] rounded-full bg-[#6B4FA1] shrink-0"></span>
          <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Selesai</span>
        </div>
      </div>
      <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
        <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
          <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
            <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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
      Menampilkan 1-3 dari 11 sesi tes
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
