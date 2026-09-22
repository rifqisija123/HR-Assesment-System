@extends('layouts.hradmin')

@section('title', 'Kategori soal')
@section('page_title', 'Kategori soal')

@section('content')
<!-- Flatpickr Datepicker Assets -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
  function initDateRangePicker(el) {
    if (typeof flatpickr === 'undefined') return;
    const today = new Date();
    flatpickr(el, {
      mode: 'range',
      dateFormat: 'd M Y',
      defaultDate: [today, today],
      locale: (flatpickr.l10ns && flatpickr.l10ns.id) ? flatpickr.l10ns.id : 'default',
      conjunction: ' - ',
      onReady: function(selectedDates, dateStr, instance) {
        const btnContainer = document.createElement('div');
        btnContainer.style.cssText = 'display:flex; align-items:center; justify-content:space-between; padding:8px 12px; border-top:1px solid #EDF2F5; background-color:#F8FAFC; border-bottom-left-radius:12px; border-bottom-right-radius:12px;';
        
        const infoText = document.createElement('span');
        infoText.style.cssText = 'color:#7890A0; font-size:11px; font-weight:500; font-family:Inter,system-ui,sans-serif;';
        infoText.innerText = 'Pilih rentang';

        const resetBtn = document.createElement('button');
        resetBtn.type = 'button';
        resetBtn.style.cssText = 'color:#62798A; font-size:12px; font-weight:600; font-family:Inter,system-ui,sans-serif; background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;';
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
</style>

<div x-data="{}">
  <!-- Page Header -->
  <div class="flex justify-between items-end gap-6 mb-6">
    <div class="flex flex-col gap-2">
      <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
        MATERI ASESMEN
      </div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
        Kategori soal
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
        Kelola kategori dan pengelompokan materi asesmen secara terstruktur.
      </div>
    </div>
    <a href="{{ url('/hr/question-categories/create') }}" class="flex items-center bg-[#147D92] rounded-[10px] shrink-0 gap-[9px] h-[42px] px-4 cursor-pointer hover:bg-[#126f82] transition-colors no-underline">
      <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
        <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
      </svg>
      <div class="text-white font-['Inter',system-ui,sans-serif] text-[14px]/[20px] font-[650]">
        Tambah kategori
      </div>
    </a>
  </div>

  <!-- Table Card -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] overflow-hidden">
    <!-- Toolbar -->
    <div class="flex items-center justify-between border-b border-[#EDF2F5] shrink-0 gap-4 h-[76px] py-4 px-5">
      <div class="flex items-center border border-[#DDE6ED] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[340px] focus-within:border-[#147D92] transition-colors">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <circle cx="11" cy="11" r="7" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m20 20-4-4" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <input type="text" placeholder="Cari nama kategori atau deskripsi..." class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full placeholder:text-[#92A4B0]">
      </div>
      <div class="flex gap-2.5">
        <!-- Date Range Picker Direct Calendar -->
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

        <!-- Status Filter -->
        <div class="relative">
          <select class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <!-- Tipe Filter -->
        <div class="relative">
          <select class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua tipe</option>
            <option value="Pilihan Ganda">Pilihan Ganda</option>
            <option value="Essay">Essay</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Table Header -->
    <div class="flex items-center bg-[#F3F7F9] shrink-0 h-[42px] px-5">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] flex-1 min-w-0">
        KATEGORI & DESKRIPSI
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[130px]">
        JUMLAH SOAL
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[110px]">
        TIPE
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[110px]">
        STATUS
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[170px]">
        TERAKHIR DIPERBARUI
      </div>
      <div class="shrink-0 w-[38px]"></div>
    </div>

    <!-- Table Rows -->
    <div class="flex flex-col">
      <!-- Row 1 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 h-[72px] px-5 hover:bg-gray-50/50 transition-colors">
        <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Logika & Penalaran
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            Mengukur kemampuan berpikir logis, analitis, dan penyelesaian masalah dasar.
          </div>
        </div>
        <div class="shrink-0 w-[130px]">
          <div class="flex items-center gap-1.5">
            <span class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">14</span>
            <span class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">soal</span>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 w-[96px]">
            <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan ganda</div>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 w-[76px]">
            <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Aktif</div>
          </div>
        </div>
        <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[170px] truncate">
          08 Agu 2026 &middot; Nadia Putri
        </div>
        <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
          <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Edit
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Delete
            </button>
          </div>
        </div>
      </div>

      <!-- Row 2 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 h-[72px] px-5 hover:bg-gray-50/50 transition-colors">
        <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Kompetensi Bidang
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            Evaluasi keahlian teknis, pemahaman domain pekerjaan, dan studi kasus profesional.
          </div>
        </div>
        <div class="shrink-0 w-[130px]">
          <div class="flex items-center gap-1.5">
            <span class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">20</span>
            <span class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">soal</span>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 w-[84px]">
            <div class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Essay</div>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 w-[76px]">
            <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Aktif</div>
          </div>
        </div>
        <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[170px] truncate">
          07 Agu 2026 &middot; Nadia Putri
        </div>
        <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
          <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Edit
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 8v13H3V8" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1 3h22v5H1z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 12h4" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Arsip
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Delete
            </button>
          </div>
        </div>
      </div>

      <!-- Row 3 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 h-[72px] px-5 hover:bg-gray-50/50 transition-colors">
        <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Kepemimpinan & Manajerial
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            Penilaian potensi kepemimpinan, pengambilan keputusan, dan manajemen tim.
          </div>
        </div>
        <div class="shrink-0 w-[130px]">
          <div class="flex items-center gap-1.5">
            <span class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">12</span>
            <span class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">soal</span>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 w-[96px]">
            <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan ganda</div>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 w-[76px]">
            <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Aktif</div>
          </div>
        </div>
        <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[170px] truncate">
          05 Agu 2026 &middot; Nadia Putri
        </div>
        <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
          <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Edit
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 8v13H3V8" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1 3h22v5H1z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 12h4" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Arsip
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Delete
            </button>
          </div>
        </div>
      </div>

      <!-- Row 4 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 h-[72px] px-5 hover:bg-gray-50/50 transition-colors">
        <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Kemampuan Bahasa & Komunikasi
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            Ujian komprehensif tata bahasa, pemahaman bacaan, dan komunikasi tertulis.
          </div>
        </div>
        <div class="shrink-0 w-[130px]">
          <div class="flex items-center gap-1.5">
            <span class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">8</span>
            <span class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">soal</span>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 w-[84px]">
            <div class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Essay</div>
          </div>
        </div>
        <div class="shrink-0 w-[110px]">
          <div class="flex items-center justify-center bg-[#F0F3F5] rounded-[6px] h-6 w-[76px]">
            <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Nonaktif</div>
          </div>
        </div>
        <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[170px] truncate">
          01 Agu 2026 &middot; Rizky Mahendra
        </div>
        <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
          <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Edit
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 8v13H3V8" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M1 3h22v5H1z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M10 12h4" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Arsip
            </button>
            <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
        Menampilkan 1-4 dari 4 kategori
      </div>
      <div class="flex items-center gap-2.5">
        <button class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
          Sebelumnya
        </button>
        
        <div class="flex items-center gap-1 mx-1">
          <button class="size-8 rounded-[6px] bg-[#147D92] text-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center">1</button>
        </div>

        <button class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
          Selanjutnya
        </button>
      </div>
    </div>
  </div>

</div>
@endsection
