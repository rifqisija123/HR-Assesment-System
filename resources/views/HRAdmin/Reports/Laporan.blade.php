@extends('layouts.hradmin')

@section('title', 'Laporan')
@section('page_title', 'Laporan')

@section('content')

{{-- Flatpickr Assets --}}
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
        resetBtn.addEventListener('click', function() { instance.clear(); });

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
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1) !important;
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
  .flatpickr-footer-reset-btn:hover { color: #102A43; }
</style>

{{-- Page Header --}}
<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">
      INSIGHT ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">
      Laporan
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">
      Pantau performa sesi dan distribusi hasil kandidat secara menyeluruh.
    </div>
  </div>
  <div class="flex items-center gap-2.5 shrink-0">
    {{-- Date range picker --}}
    <div class="relative">
      <div class="flex items-center border border-[#DDE6ED] rounded-[10px] gap-2.5 h-[42px] px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
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
    {{-- Ekspor button --}}
    <button type="button" class="flex items-center gap-2 h-[42px] px-4 bg-[#17879A] rounded-[10px] cursor-pointer hover:bg-[#147D92] transition-colors border-none">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 5v14M5 18l7 7 7-7" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <span class="text-white font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">Ekspor laporan</span>
    </button>
  </div>
</div>

{{-- Stat Cards --}}
<div class="flex gap-4">
  {{-- Sesi selesai --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E6F4F7] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="3" y="3" width="7" height="7" rx="1" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="14" y="3" width="7" height="7" rx="1" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="3" y="14" width="7" height="7" rx="1" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <rect x="14" y="14" width="7" height="7" rx="1" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Sesi selesai</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">18</div>
      <div class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">↑ 12% vs bulan lalu</div>
    </div>
  </div>

  {{-- Kandidat dinilai --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#F0ECF9] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="12" cy="12" r="9" stroke="#6B4FA1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <circle cx="12" cy="12" r="4" stroke="#6B4FA1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Kandidat dinilai</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">86</div>
      <div class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">↑ 8% vs bulan lalu</div>
    </div>
  </div>

  {{-- Rata-rata skor --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E7F5EC] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 3v18h18" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="m7 16 4-5 3 3 5-7" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Rata-rata skor</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">78,4</div>
      <div class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">↑ 4,2 poin</div>
    </div>
  </div>

  {{-- Rasio lulus --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#FFF3E0] rounded-[11px]">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Rasio lulus</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">62%</div>
      <div class="text-[#B16A00] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">Dari 86 kandidat dinilai</div>
    </div>
  </div>
</div>

{{-- Chart Row --}}
<div class="flex gap-4">

  {{-- Performa sesi tes --}}
  <div class="flex flex-col flex-[1.35] gap-[18px] bg-white border border-[#DCE6EC] rounded-[14px] p-[22px]">
    <div class="flex items-start justify-between">
      <div class="flex flex-col gap-1.5">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[15px]/[18px] font-extrabold">
          Performa sesi tes
        </div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Rata-rata skor per sesi pada periode terpilih
        </div>
      </div>
      <button type="button" class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold bg-transparent border-none cursor-pointer hover:underline shrink-0">
        Lihat detail →
      </button>
    </div>

    <div class="flex flex-col gap-[17px]">
      {{-- Bar: Leadership Trainee B08 --}}
      <div class="flex items-center gap-3.5">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
          Leadership Trainee B08
        </div>
        <div class="flex-1 h-[9px] rounded-full bg-[#E6EDF2]">
          <div class="h-[9px] rounded-full bg-[#147D92]" style="width: 86%"></div>
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold shrink-0 w-[42px] text-right">
          86,0
        </div>
      </div>
      {{-- Bar: Graduate Development --}}
      <div class="flex items-center gap-3.5">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
          Graduate Development
        </div>
        <div class="flex-1 h-[9px] rounded-full bg-[#E6EDF2]">
          <div class="h-[9px] rounded-full bg-[#2A9D8F]" style="width: 81%"></div>
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold shrink-0 w-[42px] text-right">
          81,4
        </div>
      </div>
      {{-- Bar: Sales Associate Q3 --}}
      <div class="flex items-center gap-3.5">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
          Sales Associate Q3
        </div>
        <div class="flex-1 h-[9px] rounded-full bg-[#E6EDF2]">
          <div class="h-[9px] rounded-full bg-[#6B4FA1]" style="width: 74%"></div>
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold shrink-0 w-[42px] text-right">
          74,8
        </div>
      </div>
      {{-- Bar: Management Associate --}}
      <div class="flex items-center gap-3.5">
        <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[180px]">
          Management Associate
        </div>
        <div class="flex-1 h-[9px] rounded-full bg-[#E6EDF2]">
          <div class="h-[9px] rounded-full bg-[#D97706]" style="width: 69%"></div>
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold shrink-0 w-[42px] text-right">
          69,2
        </div>
      </div>
    </div>
  </div>

  {{-- Distribusi hasil --}}
  <div class="flex flex-col flex-[0.8] gap-[18px] bg-white border border-[#DCE6EC] rounded-[14px] p-[22px]">
    <div class="flex flex-col gap-1.5">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[15px]/[18px] font-extrabold">
        Distribusi hasil
      </div>
      <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Status kandidat yang sudah dinilai
      </div>
    </div>

    <div class="flex items-center gap-5 pt-2.5 pb-1">
      {{-- Donut chart (CSS-only approximation) --}}
      <div class="relative flex items-center justify-center shrink-0 size-[116px]">
        {{-- Outer ring segments via conic-gradient --}}
        <div class="absolute inset-0 rounded-full" style="background: conic-gradient(#198754 0% 61.6%, #D97706 61.6% 85.9%, #A0AEC0 85.9% 100%);"></div>
        {{-- Inner white circle --}}
        <div class="relative flex flex-col items-center justify-center size-[78px] rounded-full bg-white z-10">
          <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[22px]/[28px] font-extrabold">86</span>
          <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[10px]/[12px]">dinilai</span>
        </div>
      </div>

      {{-- Legend --}}
      <div class="flex flex-col gap-3">
        <div class="flex items-center gap-2">
          <span class="inline-block shrink-0 size-[9px] rounded-[3px] bg-[#198754]"></span>
          <span class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Lulus</span>
          <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold">53</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="inline-block shrink-0 size-[9px] rounded-[3px] bg-[#D97706]"></span>
          <span class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Tidak lulus</span>
          <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold">21</span>
        </div>
        <div class="flex items-center gap-2">
          <span class="inline-block shrink-0 size-[9px] rounded-[3px] bg-[#A0AEC0]"></span>
          <span class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Review</span>
          <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold">12</span>
        </div>
      </div>
    </div>
  </div>

</div>

{{-- Laporan sesi terbaru table --}}
<div class="flex flex-col bg-white border border-[#DCE6EC] rounded-[14px] overflow-hidden">

  {{-- Table toolbar --}}
  <div class="flex items-center justify-between shrink-0 h-[62px] px-5 border-b border-[#E6EDF2]">
    <div class="flex flex-col gap-1">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[15px]/[18px] font-extrabold">
        Laporan sesi terbaru
      </div>
      <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Ringkasan hasil yang siap dibagikan
      </div>
    </div>
    <div class="flex items-center gap-2">
      <button type="button" class="flex items-center justify-center h-[34px] px-3 border border-[#D9E2EA] rounded-[8px] bg-white hover:bg-gray-50 transition-colors cursor-pointer">
        <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">CSV</span>
      </button>
      <button type="button" class="flex items-center justify-center h-[34px] px-3 border border-[#D9E2EA] rounded-[8px] bg-white hover:bg-gray-50 transition-colors cursor-pointer">
        <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">XLSX</span>
      </button>
      <button type="button" class="flex items-center justify-center h-[34px] px-3.5 bg-[#E6F4F7] rounded-[8px] hover:bg-[#D0ECF2] transition-colors cursor-pointer border-none">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Lihat semua →</span>
      </button>
    </div>
  </div>

  {{-- Table header --}}
  <div class="flex items-center shrink-0 h-[38px] px-5 bg-[#F8FAFC]">
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em] shrink-0 w-[310px]">
      NAMA SESI
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em] shrink-0 w-[130px]">
      SELESAI
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em] shrink-0 w-[150px]">
      RATA-RATA
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em] shrink-0 w-[150px]">
      STATUS
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em] flex flex-1 justify-end">
      DIPERBARUI
    </div>
  </div>

  {{-- Row 1 --}}
  <div class="flex items-center min-h-[50px] px-5 border-t border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[310px]">
      Leadership Trainee — Batch 08
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
      28 / 32
    </div>
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[150px]">
      86,0
    </div>
    <div class="shrink-0 w-[150px]">
      <span class="inline-block px-[9px] py-[5px] rounded-full bg-[#E7F5EC]">
        <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Selesai</span>
      </span>
    </div>
    <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] flex flex-1 justify-end">
      08 Agu 2026
    </div>
  </div>

  {{-- Row 2 --}}
  <div class="flex items-center min-h-[50px] px-5 border-t border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[310px]">
      Graduate Development Program
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
      48 / 48
    </div>
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[150px]">
      81,4
    </div>
    <div class="shrink-0 w-[150px]">
      <span class="inline-block px-[9px] py-[5px] rounded-full bg-[#E7F5EC]">
        <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Selesai</span>
      </span>
    </div>
    <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] flex flex-1 justify-end">
      06 Agu 2026
    </div>
  </div>

  {{-- Row 3 --}}
  <div class="flex items-center min-h-[50px] px-5 border-t border-[#E6EDF2] hover:bg-gray-50/50 transition-colors">
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0 w-[310px]">
      Sales Associate — Q3 Hiring
    </div>
    <div class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[130px]">
      0 / 20
    </div>
    <div class="text-[#A0AEC0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[150px]">
      Belum tersedia
    </div>
    <div class="shrink-0 w-[150px]">
      <span class="inline-block px-[9px] py-[5px] rounded-full bg-[#E6F4F7]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Berjalan</span>
      </span>
    </div>
    <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] flex flex-1 justify-end">
      11 Agu 2026
    </div>
  </div>

</div>

@endsection
