@extends('layouts.reviewer')

@section('title', 'Riwayat penilaian')
@section('page_title', 'Riwayat penilaian')

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
      defaultDate: ['01 Agu 2026', '31 Agu 2026'],
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

<div x-data="{
  search: '',
  selectedSessionFilter: '',
  selectedResultFilter: '',
  openSessionFilter: false,
  openResultFilter: false,
  historyData: [
    {
      id: 1,
      name: 'Andi Pratama',
      initials: 'AP',
      avatarBg: '#DCEFF0',
      avatarText: '#147D92',
      essayDetail: 'Essay #04 · Kompetensi manajerial',
      sessionName: 'Leadership Trainee — B08',
      score: '86 / 100',
      isPass: true,
      resultText: 'Lulus',
      evaluatedAt: '10 Agu 2026 · 09.42 WIB'
    },
    {
      id: 2,
      name: 'Sari Wulandari',
      initials: 'SW',
      avatarBg: '#F0ECF9',
      avatarText: '#6B4FA1',
      essayDetail: 'Essay #04 · Kompetensi manajerial',
      sessionName: 'Leadership Trainee — B08',
      score: '74 / 100',
      isPass: false,
      resultText: 'Tidak lulus',
      evaluatedAt: '10 Agu 2026 · 11.15 WIB'
    },
    {
      id: 3,
      name: 'Bima Saputra',
      initials: 'BS',
      avatarBg: '#E7F5EC',
      avatarText: '#198754',
      essayDetail: 'Essay #02 · Analisis logika',
      sessionName: 'Graduate Development',
      score: '91 / 100',
      isPass: true,
      resultText: 'Lulus',
      evaluatedAt: '06 Agu 2026 · 14.30 WIB'
    },
    {
      id: 4,
      name: 'Reza Firmansyah',
      initials: 'RF',
      avatarBg: '#E6F4F7',
      avatarText: '#147D92',
      essayDetail: 'Essay #01 · Strategi penjualan',
      sessionName: 'Sales Associate — Q3',
      score: '80 / 100',
      isPass: true,
      resultText: 'Lulus',
      evaluatedAt: '05 Agu 2026 · 16.05 WIB'
    },
    {
      id: 5,
      name: 'Dewi Anggraini',
      initials: 'DA',
      avatarBg: '#FFF3E0',
      avatarText: '#D97706',
      essayDetail: 'Essay #03 · Negosiasi & komunikasi',
      sessionName: 'Sales Associate — Q3',
      score: '68 / 100',
      isPass: false,
      resultText: 'Tidak lulus',
      evaluatedAt: '04 Agu 2026 · 10.20 WIB'
    }
  ],
  get filteredHistory() {
    return this.historyData.filter(item => {
      const matchesSearch = !this.search.trim() || 
        item.name.toLowerCase().includes(this.search.toLowerCase()) || 
        item.sessionName.toLowerCase().includes(this.search.toLowerCase()) ||
        item.essayDetail.toLowerCase().includes(this.search.toLowerCase());
      
      const matchesSession = !this.selectedSessionFilter || item.sessionName === this.selectedSessionFilter;
      const matchesResult = !this.selectedResultFilter || item.resultText === this.selectedResultFilter;

      return matchesSearch && matchesSession && matchesResult;
    });
  },
  exportData() {
    alert('Mengekspor data riwayat penilaian (' + this.filteredHistory.length + ' item)...');
  }
}" class="flex flex-col gap-[22px]">

  {{-- Page Header Section --}}
  <div class="flex items-end justify-between gap-6">
    <div class="flex flex-col gap-[8px]">
      <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">
        ARSIP PENILAIAN
      </div>
      <h1 class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold m-0">
        Riwayat penilaian
      </h1>
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">
        Lihat kembali skor, catatan, dan hasil essay yang sudah difinalisasi.
      </div>
    </div>

    {{-- Top Action Controls --}}
    <div class="flex items-center gap-[10px] shrink-0">
      {{-- Date Range Picker Direct Calendar --}}
      <div class="relative">
        <div class="flex items-center border border-[#D9E2EA] rounded-[10px] gap-2.5 h-[42px] px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
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

      {{-- Export Button --}}
      <button 
        type="button"
        @click="exportData()"
        class="flex items-center h-[42px] px-[15px] bg-[#17879A] hover:bg-[#147D92] rounded-[10px] gap-[8px] cursor-pointer transition-colors border-none shadow-xs text-white"
      >
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
          <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
        <span class="font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">
          Ekspor
        </span>
      </button>
    </div>
  </div>

  {{-- Stat Cards Row --}}
  <div class="flex gap-[16px]">
    {{-- Stat Card 1: Essay dinilai --}}
    <div class="flex flex-1 items-center gap-[14px] bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] px-[20px] min-h-[76px]">
      <div class="flex items-center justify-center shrink-0 w-[38px] h-[38px] bg-[#E6F4F7] rounded-[11px]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">✓</span>
      </div>
      <div class="flex flex-col gap-[4px]">
        <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Essay dinilai
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
          86
        </div>
      </div>
    </div>

    {{-- Stat Card 2: Rata-rata skor --}}
    <div class="flex flex-1 items-center gap-[14px] bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] px-[20px] min-h-[76px]">
      <div class="flex items-center justify-center shrink-0 w-[38px] h-[38px] bg-[#F0ECF9] rounded-[11px]">
        <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">↗</span>
      </div>
      <div class="flex flex-col gap-[4px]">
        <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Rata-rata skor
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
          82,6
        </div>
      </div>
    </div>

    {{-- Stat Card 3: Kandidat lulus --}}
    <div class="flex flex-1 items-center gap-[14px] bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] px-[20px] min-h-[76px]">
      <div class="flex items-center justify-center shrink-0 w-[38px] h-[38px] bg-[#E7F5EC] rounded-[11px]">
        <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">★</span>
      </div>
      <div class="flex flex-col gap-[4px]">
        <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Kandidat lulus
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
          53
        </div>
      </div>
    </div>

    {{-- Stat Card 4: Catatan dibuat --}}
    <div class="flex flex-1 items-center gap-[14px] bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] px-[20px] min-h-[76px]">
      <div class="flex items-center justify-center shrink-0 w-[38px] h-[38px] bg-[#FFF3E0] rounded-[11px]">
        <span class="text-[#D97706] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">✎</span>
      </div>
      <div class="flex flex-col gap-[4px]">
        <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Catatan dibuat
        </div>
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">
          31
        </div>
      </div>
    </div>
  </div>

  {{-- History Table Container Card --}}
  <div class="bg-white border border-[#DCE6EC] rounded-[14px] flex flex-col overflow-hidden">
    
    {{-- Search & Filters Toolbar --}}
    <div class="flex items-center justify-between h-[74px] py-[18px] px-[20px] shrink-0 gap-4">
      {{-- Search Bar --}}
      <div class="flex items-center border border-[#D9E2EA] rounded-[10px] shrink-0 gap-[10px] h-[40px] px-[12px] w-[320px] focus-within:border-[#147D92] transition-colors">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="shrink-0">
          <circle cx="11" cy="11" r="7" stroke="#A0AEC0" stroke-width="2"/>
          <path d="m20 20-4-4" stroke="#A0AEC0" stroke-width="2" stroke-linecap="round"/>
        </svg>
        <input 
          type="text" 
          x-model="search"
          placeholder="Cari kandidat atau sesi..." 
          class="bg-transparent border-none outline-none text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] w-full placeholder:text-[#A0AEC0]"
        />
      </div>

      {{-- Filters --}}
      <div class="flex items-center gap-[10px]">
        {{-- Session Filter Dropdown --}}
        <div class="relative" @click.away="openSessionFilter = false">
          <button 
            type="button"
            @click="openSessionFilter = !openSessionFilter"
            class="flex items-center h-[40px] px-[14px] bg-white border border-[#D9E2EA] rounded-[10px] gap-[18px] cursor-pointer hover:border-[#147D92] transition-colors outline-none"
          >
            <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium" x-text="selectedSessionFilter || 'Semua sesi'"></span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 shrink-0" :class="openSessionFilter ? 'rotate-180' : ''">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>

          {{-- Session Filter Popover --}}
          <div 
            x-show="openSessionFilter"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 top-[46px] z-30 w-[240px] bg-white border border-[#DCE6EC] rounded-[10px] shadow-lg py-1.5 overflow-hidden"
            style="display: none;"
          >
            <button
              type="button"
              @click="selectedSessionFilter = ''; openSessionFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedSessionFilter === '' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Semua sesi</span>
              <span x-show="selectedSessionFilter === ''" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
            <button
              type="button"
              @click="selectedSessionFilter = 'Leadership Trainee — B08'; openSessionFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedSessionFilter === 'Leadership Trainee — B08' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Leadership Trainee — B08</span>
              <span x-show="selectedSessionFilter === 'Leadership Trainee — B08'" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
            <button
              type="button"
              @click="selectedSessionFilter = 'Sales Associate — Q3'; openSessionFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedSessionFilter === 'Sales Associate — Q3' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Sales Associate — Q3</span>
              <span x-show="selectedSessionFilter === 'Sales Associate — Q3'" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
            <button
              type="button"
              @click="selectedSessionFilter = 'Graduate Development'; openSessionFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedSessionFilter === 'Graduate Development' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Graduate Development</span>
              <span x-show="selectedSessionFilter === 'Graduate Development'" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
          </div>
        </div>

        {{-- Result Filter Dropdown --}}
        <div class="relative" @click.away="openResultFilter = false">
          <button 
            type="button"
            @click="openResultFilter = !openResultFilter"
            class="flex items-center h-[40px] px-[14px] bg-white border border-[#D9E2EA] rounded-[10px] gap-[18px] cursor-pointer hover:border-[#147D92] transition-colors outline-none"
          >
            <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium" x-text="selectedResultFilter || 'Semua hasil'"></span>
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 shrink-0" :class="openResultFilter ? 'rotate-180' : ''">
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </button>

          {{-- Result Filter Popover --}}
          <div 
            x-show="openResultFilter"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 top-[46px] z-30 w-[180px] bg-white border border-[#DCE6EC] rounded-[10px] shadow-lg py-1.5 overflow-hidden"
            style="display: none;"
          >
            <button
              type="button"
              @click="selectedResultFilter = ''; openResultFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedResultFilter === '' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Semua hasil</span>
              <span x-show="selectedResultFilter === ''" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
            <button
              type="button"
              @click="selectedResultFilter = 'Lulus'; openResultFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedResultFilter === 'Lulus' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Lulus</span>
              <span x-show="selectedResultFilter === 'Lulus'" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
            <button
              type="button"
              @click="selectedResultFilter = 'Tidak lulus'; openResultFilter = false"
              class="w-full text-left px-3.5 py-2 text-[12px] font-['Inter',system-ui,sans-serif] flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
              :class="selectedResultFilter === 'Tidak lulus' ? 'bg-[#EAF6F7] text-[#147D92] font-bold' : 'text-[#52677A]'"
            >
              <span>Tidak lulus</span>
              <span x-show="selectedResultFilter === 'Tidak lulus'" class="text-[#147D92] font-bold text-[14px]">&check;</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- Table Header --}}
    <div class="flex items-center h-[44px] px-[20px] bg-[#F8FAFC] border-y border-[#E6EDF2] shrink-0">
      <div class="w-[270px] shrink-0 text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        KANDIDAT
      </div>
      <div class="w-[190px] shrink-0 text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        SESI TES
      </div>
      <div class="w-[100px] shrink-0 text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        SKOR
      </div>
      <div class="w-[120px] shrink-0 text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        HASIL
      </div>
      <div class="w-[180px] shrink-0 text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        DINILAI PADA
      </div>
      <div class="flex-1 text-right text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px] font-bold tracking-[0.08em]">
        AKSI
      </div>
    </div>

    {{-- Table Rows --}}
    <div class="flex flex-col">
      <template x-for="item in filteredHistory" :key="item.id">
        <div class="flex items-center min-h-[78px] px-[20px] bg-white border-b border-[#E6EDF2] hover:bg-[#F8FAFC] transition-colors">
          {{-- Candidate Info --}}
          <div class="w-[270px] shrink-0 flex items-center gap-[12px]">
            <div 
              class="w-[34px] h-[34px] rounded-full flex items-center justify-center shrink-0"
              :style="'background-color: ' + item.avatarBg"
            >
              <span 
                class="font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-extrabold"
                :style="'color: ' + item.avatarText"
                x-text="item.initials"
              ></span>
            </div>
            <div class="flex flex-col gap-[4px] min-w-0 pr-2">
              <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate" x-text="item.name"></div>
              <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate" x-text="item.essayDetail"></div>
            </div>
          </div>

          {{-- Session Name --}}
          <div class="w-[190px] shrink-0 text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]" x-text="item.sessionName"></div>

          {{-- Score --}}
          <div 
            class="w-[100px] shrink-0 font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-extrabold"
            :class="item.isPass ? 'text-[#147D92]' : 'text-[#D97706]'"
            x-text="item.score"
          ></div>

          {{-- Pass/Fail Badge --}}
          <div class="w-[120px] shrink-0">
            <span 
              class="inline-block py-[6px] px-[10px] rounded-full font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold"
              :class="item.isPass ? 'bg-[#E7F5EC] text-[#198754]' : 'bg-[#FFF3E0] text-[#B16A00]'"
              x-text="item.resultText"
            ></span>
          </div>

          {{-- Evaluated At Date & Time --}}
          <div class="w-[180px] shrink-0 text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]" x-text="item.evaluatedAt"></div>

          {{-- Action Button Menu --}}
          <div class="flex-1 flex justify-end relative" x-data="{ menuOpen: false }" @click.away="menuOpen = false">
            <button 
              type="button" 
              @click="menuOpen = !menuOpen"
              class="text-[#7A8A9A] hover:text-[#102A43] p-1 rounded hover:bg-gray-100 transition-colors border-none bg-transparent cursor-pointer font-bold text-[18px]/[22px]"
            >
              ⋯
            </button>
            <div 
              x-show="menuOpen"
              x-transition.opacity.duration.150ms
              class="absolute right-0 top-7 z-20 w-[150px] bg-white border border-[#DCE6EC] rounded-[8px] shadow-lg py-1 flex flex-col"
              style="display: none;"
            >
              <button 
                type="button"
                @click="alert('Melihat detail penilaian ' + item.name); menuOpen = false"
                class="w-full text-left px-3 py-2 text-[12px] text-[#324A5F] hover:bg-[#F7F9FC] font-['Inter',system-ui,sans-serif] border-none bg-transparent cursor-pointer flex items-center gap-2"
              >
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                Lihat detail
              </button>
              <button 
                type="button"
                @click="alert('Mencetak hasil essay ' + item.name); menuOpen = false"
                class="w-full text-left px-3 py-2 text-[12px] text-[#324A5F] hover:bg-[#F7F9FC] font-['Inter',system-ui,sans-serif] border-none bg-transparent cursor-pointer flex items-center gap-2"
              >
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9V2h12v7M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                Cetak hasil
              </button>
            </div>
          </div>
        </div>
      </template>

      <div x-show="filteredHistory.length === 0" class="p-8 text-center text-[#7A8A9A] text-[13px]">
        Tidak ada data riwayat penilaian yang cocok dengan filter.
      </div>
    </div>

    {{-- Pagination (Matching Kandidat.blade.php) --}}
    <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5] bg-white shrink-0">
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
        Menampilkan 1-<span x-text="filteredHistory.length"></span> dari 86 penilaian
      </div>
      <div class="flex items-center gap-2.5">
        <button type="button" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors cursor-pointer border-solid disabled:opacity-50 disabled:cursor-not-allowed" disabled>
          Sebelumnya
        </button>
        <div class="flex items-center gap-1 mx-1">
          <button type="button" class="size-8 rounded-[6px] bg-[#147D92] text-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center border-none cursor-pointer">1</button>
          <button type="button" class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors border-none cursor-pointer">2</button>
          <button type="button" class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors border-none cursor-pointer">3</button>
          <span class="text-[#62798A] px-1 text-[13px]">...</span>
          <button type="button" class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors border-none cursor-pointer">18</button>
        </div>
        <button type="button" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors cursor-pointer border-solid">
          Selanjutnya
        </button>
      </div>
    </div>
  </div>
</div>
@endsection
