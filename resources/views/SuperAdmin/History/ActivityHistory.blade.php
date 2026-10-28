@extends('layouts.superadmin')
@section('title', 'Riwayat Aktivitas')
@section('page_title', 'Riwayat aktivitas')

@section('content')
<!-- Flatpickr Datepicker Assets -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<style>
  .flatpickr-calendar {
    font-family: 'Inter', system-ui, sans-serif !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
    border: 1px solid #EDF2F5 !important;
    z-index: 99999 !important;
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

<div x-data="activityTable()" x-init="init()" class="flex flex-col gap-6 w-full">

  <!-- Header & Action Buttons -->
  <div class="flex items-end justify-between gap-6">
    <div class="flex flex-col gap-2">
      <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
        AUDIT LOGS
      </div>
      <h1 class="m-0 tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
        Riwayat Aktivitas
      </h1>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
        Pantau dan lacak semua tindakan penting yang dilakukan oleh pengguna, IP, dan peramban (browser).
      </div>
    </div>

    <div class="flex items-center gap-3">
      <!-- Real-time Live Status & Auto-refresh Toggle -->
      <button 
        type="button" 
        @click="toggleAutoRefresh()" 
        id="btn-toggle-autorefresh"
        class="h-10.5 flex items-center shrink-0 px-3.5 rounded-[10px] gap-2 border border-solid cursor-pointer transition-all duration-200 select-none"
        :class="autoRefresh ? 'bg-[#E2F4F3] border-[#147D92] text-[#147D92] hover:bg-[#d0eeec]' : 'bg-white border-[#DDE6ED] text-[#62798A] hover:bg-gray-50'"
        :title="autoRefresh ? 'Sinkronisasi real-time aktif (otomatis refresh tiap 15 detik). Klik untuk menjeda.' : 'Sinkronisasi real-time dijeda. Klik untuk mengaktifkan.'">
        <span class="relative flex size-2 shrink-0">
          <span x-show="autoRefresh" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#147D92] opacity-75"></span>
          <span class="relative inline-flex rounded-full size-2" :class="autoRefresh ? 'bg-[#147D92]' : 'bg-gray-400'"></span>
        </span>
        <span class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-sm/5" x-text="autoRefresh ? 'Real-time' : 'Jeda'">
        </span>
        <svg :class="{'animate-spin': loading}" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l5.67-5.67"/>
        </svg>
      </button>

      <!-- Filter Button -->
      <button 
        type="button" 
        @click="filterOpen = !filterOpen" 
        id="btn-toggle-filter"
        class="h-10.5 flex items-center shrink-0 px-4 rounded-[10px] gap-2.25 border border-solid cursor-pointer transition-all duration-200 select-none relative"
        :class="filterOpen || activeFilterCount > 0 ? 'bg-[#E2F4F3] border-[#147D92] text-[#147D92]' : 'bg-white border-[#DDE6ED] text-[#62798A] hover:bg-gray-50'">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-sm/5">
          Filter
        </span>
        <!-- Active Filter Badge Counter -->
        <span 
          x-show="activeFilterCount > 0" 
          x-text="activeFilterCount" 
          style="display: none;" 
          class="ml-0.5 size-5 rounded-full bg-[#147D92] text-white text-[11px] font-bold flex items-center justify-center shrink-0">
        </span>
      </button>

      <!-- Ekspor Log Dropdown (Biarkan apa adanya sesuai instruksi user) -->
      <div class="relative group">
        <div class="h-10.5 flex items-center shrink-0 px-4 rounded-[10px] gap-2.25 bg-[#147D92] cursor-pointer hover:bg-[#0f677a] transition-colors">
          <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <polyline points="7 10 12 15 17 10" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <line x1="12" y1="15" x2="12" y2="3" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-sm/5">
            Ekspor Log
          </div>
          <svg width="14" height="14" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;" class="ml-1">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        
        <div class="absolute right-0 mt-2 w-44 bg-white rounded-[10px] shadow-lg border border-solid border-[#DDE6ED] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10 flex flex-col overflow-hidden py-1.5">
          <a :href="getExportUrl('xlsx')" href="{{ route('superadmin.activity.export.xlsx') }}" id="btn-export-xlsx" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-[#F8FAFC] transition-colors decoration-none">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M14 2V8H20" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8 13H16" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8 17H16" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M10 9H8" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#314E60] text-[13px]">Ekspor sebagai XLSX</span>
          </a>
          <a :href="getExportUrl('pdf')" href="{{ route('superadmin.activity.export.pdf') }}" id="btn-export-pdf" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-[#F8FAFC] transition-colors decoration-none">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M14 2V8H20" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9 15V11H11C11.5304 11 12.0391 11.2107 12.4142 11.5858C12.7893 11.9609 13 12.4696 13 13C13 13.5304 12.7893 14.0391 12.4142 14.4142C12.0391 14.7893 11.5304 15 11 15H9Z" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#314E60] text-[13px]">Ekspor sebagai PDF</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Collapsible Filter Panel -->
  <div 
    x-show="filterOpen" 
    x-collapse 
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    style="display: none;"
    class="bg-white rounded-[14px] border border-solid border-[#DDE6ED] p-5 shadow-[0_4px_16px_rgba(16,42,67,0.04)]">
    
    <div class="flex items-center justify-between pb-4 mb-4 border-b border-[#EDF2F5]">
      <div class="flex items-center gap-2">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#147D92" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
        </svg>
        <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[14px]">Filter Riwayat Aktivitas</span>
      </div>
      <div class="flex items-center gap-2">
        <button 
          type="button" 
          @click="resetFilters()" 
          class="text-[12px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:text-[#E11D48] transition-colors cursor-pointer bg-transparent border-none">
          Reset Filter
        </button>
        <button 
          type="button" 
          @click="filterOpen = false" 
          class="p-1 rounded-[6px] text-[#7890A0] hover:text-[#314E60] hover:bg-[#F1F5F9] transition-colors border-none bg-transparent cursor-pointer">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>
    </div>

    <!-- Filter Form Inputs -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
      <!-- Filter 1: Pengguna / Akun -->
      <div class="flex flex-col gap-1.5">
        <label class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[12px]">Pengguna (Akun)</label>
        <div class="relative">
          <select 
            x-model="filters.user_id" 
            @change="fetchLogs(1)"
            class="appearance-none h-10 w-full pl-3 pr-9 rounded-[8px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92]">
            <option value="">Semua pengguna</option>
            <option value="system">System Auto (Otomatis)</option>
            @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }} ({{ ucfirst(str_replace('_', ' ', $user->role)) }})</option>
            @endforeach
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#7890A0]" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
        </div>
      </div>

      <!-- Filter 2: Peran / Role -->
      <div class="flex flex-col gap-1.5">
        <label class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[12px]">Peran (Role)</label>
        <div class="relative">
          <select 
            x-model="filters.role" 
            @change="fetchLogs(1)"
            class="appearance-none h-10 w-full pl-3 pr-9 rounded-[8px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92]">
            <option value="">Semua role</option>
            <option value="super_admin">Super Admin</option>
            <option value="hr_admin">HR Admin</option>
            <option value="reviewer">Reviewer</option>
            <option value="system">System</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#7890A0]" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
        </div>
      </div>

      <!-- Filter 3: Tipe Aktivitas -->
      <div class="flex flex-col gap-1.5">
        <label class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[12px]">Tipe Aktivitas</label>
        <div class="relative">
          <select 
            x-model="filters.action" 
            @change="fetchLogs(1)"
            class="appearance-none h-10 w-full pl-3 pr-9 rounded-[8px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92]">
            <option value="">Semua aktivitas</option>
            <option value="create">Create (Tambah Data)</option>
            <option value="update">Update (Ubah Data)</option>
            <option value="delete">Delete (Hapus Data)</option>
            <option value="login">Login (Masuk)</option>
            <option value="logout">Logout (Keluar)</option>
            <option value="get">GET (Akses Halaman)</option>
            <option value="reset_password">Reset Password</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-[#7890A0]" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
        </div>
      </div>

      <!-- Filter 4: Rentang Tanggal (Flatpickr Calendar seperti di Kategori Soal) -->
      <div class="flex flex-col gap-1.5">
        <label class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[12px]">Rentang Tanggal</label>
        <div class="relative">
          <div class="flex items-center border border-solid border-[#DDE6ED] rounded-[8px] gap-2.5 h-10 px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] focus-within:ring-1 focus-within:ring-[#147D92] cursor-pointer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
              <rect x="3" y="4" width="18" height="18" rx="2" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16 2v4M8 2v4M3 10h18" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input 
              id="filter-date-range"
              x-init="initDateRangePicker($el)" 
              type="text" 
              readonly
              placeholder="Pilih rentang tanggal..." 
              class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px] font-medium w-full cursor-pointer placeholder:text-[#92A4B0]">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
              <polyline points="6 9 12 15 18 9" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Active Filter Tags -->
    <div x-show="activeFilterCount > 0" class="flex flex-wrap items-center gap-2 pt-3 mt-3 border-t border-[#EDF2F5]">
      <span class="text-[12px] text-[#62798A] font-medium">Filter aktif:</span>

      <template x-if="filters.user_id">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[6px] bg-[#E2F4F3] text-[#147D92] text-[12px] font-medium">
          Pengguna: <span x-text="getUserFilterLabel()"></span>
          <button type="button" @click="filters.user_id = ''; fetchLogs(1)" class="hover:text-[#0b4855] border-none bg-transparent cursor-pointer p-0">✕</button>
        </span>
      </template>

      <template x-if="filters.role">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[6px] bg-[#E2F4F3] text-[#147D92] text-[12px] font-medium">
          Role: <span x-text="filters.role"></span>
          <button type="button" @click="filters.role = ''; fetchLogs(1)" class="hover:text-[#0b4855] border-none bg-transparent cursor-pointer p-0">✕</button>
        </span>
      </template>

      <template x-if="filters.action">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[6px] bg-[#E2F4F3] text-[#147D92] text-[12px] font-medium">
          Aktivitas: <span x-text="filters.action.toUpperCase()"></span>
          <button type="button" @click="filters.action = ''; fetchLogs(1)" class="hover:text-[#0b4855] border-none bg-transparent cursor-pointer p-0">✕</button>
        </span>
      </template>

      <template x-if="filters.date_from || filters.date_to">
        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[6px] bg-[#E2F4F3] text-[#147D92] text-[12px] font-medium">
          Tanggal: <span x-text="getDateFilterLabel()"></span>
          <button type="button" @click="clearDateFilter()" class="hover:text-[#0b4855] border-none bg-transparent cursor-pointer p-0">✕</button>
        </span>
      </template>
    </div>
  </div>

  <!-- Table Card -->
  <div class="flex flex-col grow basis-[0%] min-w-0 bg-white rounded-[14px] border border-solid border-[#DDE6ED] overflow-clip">
    
    <!-- Toolbar: Search, Show Entries & Total Stats -->
    <div class="flex flex-wrap items-center justify-between p-5 border-b border-b-solid border-[#EDF2F5] gap-4">
      <div class="flex flex-wrap items-center gap-3">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
              <circle cx="11" cy="11" r="8" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="21" y1="21" x2="16.65" y2="16.65" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <input 
            type="text" 
            x-model="filters.search" 
            @input.debounce.350ms="fetchLogs(1)" 
            placeholder="Cari aktivitas, pengguna, atau IP..." 
            class="h-10 pl-10 pr-4 text-sm font-['Inter',system-ui,sans-serif] border border-solid border-[#DDE6ED] rounded-[8px] bg-white outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] w-72 sm:w-80 text-[#314E60] placeholder-[#94A3B8] transition-all">
        </div>
      </div>

      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#62798A] flex items-center gap-2">
        <span x-show="loading" class="inline-block animate-spin size-3.5 border-2 border-[#147D92] border-t-transparent rounded-full mr-1"></span>
        <span x-show="lastSynced && !loading" class="text-[12px] text-[#7890A0] hidden sm:inline" x-text="'Diperbarui: ' + lastSynced"></span>
        <span>
          Menampilkan <span class="font-semibold text-[#102A43]" x-text="meta.total > 0 ? meta.from : 0"></span>-<span class="font-semibold text-[#102A43]" x-text="meta.to"></span> dari <span class="font-semibold text-[#102A43]" x-text="meta.total"></span> aktivitas
        </span>
      </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-[#F8FAFC] border-b border-b-solid border-[#EDF2F5]">
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Waktu</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Pengguna</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Aktivitas</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Entitas</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">IP Address</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Browser</th>
            <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider text-right"></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#EDF2F5]">
          
          <!-- Loading Skeleton -->
          <template x-if="loading && logs.length === 0">
            <template x-for="i in 5" :key="'skel-' + i">
              <tr class="animate-pulse">
                <td class="px-5 py-4"><div class="h-4 w-24 bg-gray-200 rounded mb-1.5"></div><div class="h-3 w-16 bg-gray-100 rounded"></div></td>
                <td class="px-5 py-4"><div class="flex items-center gap-2.5"><div class="size-7 bg-gray-200 rounded-full"></div><div class="space-y-1"><div class="h-4 w-28 bg-gray-200 rounded"></div><div class="h-3 w-16 bg-gray-100 rounded"></div></div></div></td>
                <td class="px-5 py-4"><div class="h-4 w-36 bg-gray-200 rounded"></div></td>
                <td class="px-5 py-4"><div class="h-4 w-24 bg-gray-200 rounded"></div></td>
                <td class="px-5 py-4"><div class="h-4 w-20 bg-gray-200 rounded"></div></td>
                <td class="px-5 py-4"><div class="h-4 w-28 bg-gray-200 rounded"></div></td>
                <td class="px-5 py-4 text-right"><div class="size-6 bg-gray-200 rounded inline-block"></div></td>
              </tr>
            </template>
          </template>

          <!-- Empty State -->
          <template x-if="!loading && logs.length === 0">
            <tr>
              <td colspan="7" class="px-5 py-12 text-center">
                <div class="flex flex-col items-center justify-center gap-2">
                  <div class="flex items-center justify-center size-12 rounded-full bg-[#E2F4F3] text-[#147D92] mb-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                      <circle cx="12" cy="12" r="10"/>
                      <line x1="12" y1="8" x2="12" y2="12"/>
                      <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#102A43] text-[15px]">
                    Tidak ada riwayat aktivitas ditemukan
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px] max-w-sm">
                    Tidak ada log aktivitas yang cocok dengan kata kunci atau filter yang Anda terapkan.
                  </div>
                  <button 
                    type="button" 
                    @click="resetFilters()" 
                    class="mt-2 px-3.5 py-1.5 rounded-[8px] bg-white border border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[13px] font-medium text-[#147D92] hover:bg-[#F8FAFC] cursor-pointer">
                    Hapus Filter
                  </button>
                </div>
              </td>
            </tr>
          </template>

          <!-- Data Rows -->
          <template x-for="log in logs" :key="log.id">
            <tr class="hover:bg-[#F8FAFC] transition-colors cursor-default" :class="loading ? 'opacity-60' : ''">
              
              <!-- Kolom Waktu -->
              <td class="px-5 py-4 whitespace-nowrap">
                <div class="flex items-center gap-1.5 mb-1">
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-[#E2F4F3] text-[#147D92]" x-text="formatTimeAgo(log.created_at, log.time_ago)"></span>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium" x-text="log.date"></div>
                <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0] flex items-center gap-1 mt-0.5">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                  <span x-text="log.time"></span>
                </div>
              </td>

              <!-- Kolom Pengguna -->
              <td class="px-5 py-4">
                <div class="flex items-center gap-2.5">
                  <div class="flex items-center justify-center shrink-0 rounded-full size-7" :class="log.user.style.bg">
                    <div class="font-['Inter',system-ui,sans-serif] font-bold text-[10px]" :class="log.user.style.text" x-text="log.user.initials"></div>
                  </div>
                  <div class="flex flex-col min-w-0">
                    <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium truncate" x-text="log.user.name"></div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]" x-text="log.user.role_label"></div>
                  </div>
                </div>
              </td>

              <!-- Kolom Aktivitas -->
              <td class="px-5 py-4">
                <div class="flex items-center gap-2">
                  <span 
                    class="flex items-center px-2 py-0.5 rounded text-[11px] font-bold border tracking-wider shrink-0" 
                    :class="[log.action_style.bg, log.action_style.text, log.action_style.border]" 
                    x-text="log.action_label">
                  </span>
                  <div class="flex flex-col min-w-0">
                    <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium" x-text="log.description"></div>
                    <template x-if="log.action === 'get' && log.new_values?.path">
                      <div class="font-mono text-[11px] text-[#7890A0]" x-text="log.new_values.path"></div>
                    </template>
                  </div>
                </div>
              </td>

              <!-- Kolom Entitas -->
              <td class="px-5 py-4">
                <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]" x-text="log.entity_type"></div>
                <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]" x-text="log.entity_id"></div>
              </td>

              <!-- Kolom IP Address -->
              <td class="px-5 py-4">
                <div class="font-['Inter',system-ui,sans-serif] text-[13px] font-mono text-[#62798A]" x-text="log.ip_address"></div>
              </td>

              <!-- Kolom Browser -->
              <td class="px-5 py-4">
                <div class="flex items-center gap-1.5">
                  <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]" x-text="log.browser"></div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]" x-text="'/ ' + log.os"></div>
                </div>
              </td>

              <!-- Kolom Action: Detail -->
              <td class="px-5 py-4 text-right">
                <button 
                  type="button" 
                  @click="openDetail(log)" 
                  class="flex items-center justify-center p-1 bg-transparent border-none text-[#147D92] hover:text-[#0f677a] transition-colors cursor-pointer group" 
                  title="Lihat Detail Riwayat">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current drop-shadow-[0_2px_4px_rgba(20,125,146,0.45)] group-hover:drop-shadow-[0_4px_6px_rgba(15,103,122,0.6)] transition-all duration-300 transform group-hover:scale-110">
                    <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>
              </td>
            </tr>
          </template>

        </tbody>
      </table>
    </div>

    <!-- Pagination Controls -->
    <div class="flex flex-wrap items-center justify-between p-5 border-t border-t-solid border-[#EDF2F5] gap-4">
      <div class="flex flex-wrap items-center gap-3">
        <!-- Show Entries Dropdown (Footer) -->
        <div class="flex items-center gap-2">
          <span class="text-[12px] text-[#62798A] font-['Inter',system-ui,sans-serif] whitespace-nowrap">Show:</span>
          <div class="relative">
            <select 
              x-model.number="meta.per_page" 
              @change="fetchLogs(1)" 
              id="select-show-entries-bottom"
              class="appearance-none h-8 pl-2.5 pr-7 text-[12px] font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] bg-white border border-solid border-[#DDE6ED] rounded-[6px] cursor-pointer hover:bg-gray-50 focus:border-[#147D92] outline-none transition-colors">
              <option value="10">10</option>
              <option value="25">25</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
            <svg class="absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none text-[#7890A0]" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
          </div>
          <span class="text-[12px] text-[#62798A] font-['Inter',system-ui,sans-serif] whitespace-nowrap">per halaman</span>
        </div>

        <div class="h-4 w-px bg-[#DDE6ED]"></div>

        <div class="flex gap-2">
          <button 
            type="button" 
            @click="fetchLogs(meta.current_page - 1)" 
            :disabled="meta.current_page <= 1 || loading"
            class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            :class="meta.current_page <= 1 ? 'text-[#A0AEC0]' : 'text-[#62798A] hover:bg-[#F8FAFC]'">
            Sebelumnya
          </button>
          <button 
            type="button" 
            @click="fetchLogs(meta.current_page + 1)" 
            :disabled="meta.current_page >= meta.last_page || loading"
            class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            :class="meta.current_page >= meta.last_page ? 'text-[#A0AEC0]' : 'text-[#102A43] hover:bg-[#F8FAFC]'">
            Selanjutnya
          </button>
        </div>
      </div>

      <!-- Numeric Pages -->
      <div class="flex items-center gap-1">
        <template x-for="(page, idx) in pages" :key="idx">
          <span>
            <template x-if="page === '...'">
              <span class="text-[#62798A] px-1 text-[13px]">...</span>
            </template>
            <template x-if="page !== '...'">
              <button 
                type="button" 
                @click="fetchLogs(page)" 
                class="size-8 rounded-[6px] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors cursor-pointer border-none"
                :class="meta.current_page === page ? 'bg-[#147D92] text-white font-semibold' : 'bg-transparent text-[#62798A] hover:bg-[#F8FAFC]'"
                x-text="page">
              </button>
            </template>
          </span>
        </template>
      </div>
    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- MODAL: SHOW / DETAIL RIWAYAT AKTIVITAS                                   -->
  <!-- ========================================================================= -->
  <div 
    x-show="detailModal" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#102A43]/50 backdrop-blur-sm overflow-y-auto"
    @keydown.escape.window="detailModal = false">

    <!-- Modal Box Container -->
    <div 
      @click.outside="detailModal = false"
      x-show="detailModal"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-4 scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 scale-100"
      x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 scale-100"
      x-transition:leave-end="opacity-0 translate-y-4 scale-95"
      class="bg-white rounded-[16px] shadow-[0_20px_60px_rgba(16,42,67,0.18)] border border-solid border-[#DDE6ED] w-full max-w-2xl overflow-hidden my-8 flex flex-col max-h-[90vh]">

      <!-- Modal Header -->
      <div class="flex items-center justify-between px-6 py-4.5 bg-[#F8FAFC] border-b border-[#EDF2F5] shrink-0">
        <div class="flex items-center gap-3">
          <div class="size-9 rounded-[10px] bg-[#E2F4F3] text-[#147D92] flex items-center justify-center shrink-0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="16" x2="12" y2="12"/>
              <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
          </div>
          <div>
            <div class="flex items-center gap-2">
              <h3 class="m-0 font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[17px]">
                Detail Riwayat Aktivitas
              </h3>
              <span class="px-2 py-0.5 rounded text-[11px] font-mono font-medium bg-[#EDF2F5] text-[#486174]" x-text="'#LOG-' + (selectedLog?.id || '')"></span>
            </div>
            <p class="m-0 font-['Inter',system-ui,sans-serif] text-[12px] text-[#7890A0]">
              Laporan audit lengkap mengenai tindakan pengguna pada sistem
            </p>
          </div>
        </div>

        <button 
          type="button" 
          @click="detailModal = false" 
          class="size-8 rounded-[8px] flex items-center justify-center text-[#7890A0] hover:text-[#102A43] hover:bg-gray-200 transition-colors bg-transparent border-none cursor-pointer">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>

      <!-- Modal Body (Scrollable) -->
      <div class="p-6 overflow-y-auto space-y-5 flex-1 styled-scrollbar">
        
        <!-- Section 1: Profil Pengguna (Akun) -->
        <div class="bg-[#F8FAFC] rounded-[12px] p-4.5 border border-[#EDF2F5]">
          <div class="text-[11px] uppercase tracking-wider font-bold text-[#62798A] font-['Inter'] mb-3">
            Informasi Pengguna
          </div>
          <div class="flex items-center gap-4">
            <div class="flex items-center justify-center size-12 rounded-full shrink-0 font-bold text-[14px]" :class="[selectedLog?.user?.style?.bg, selectedLog?.user?.style?.text]" x-text="selectedLog?.user?.initials"></div>
            <div class="grow min-w-0">
              <div class="flex items-center gap-2 flex-wrap">
                <span class="font-['Inter'] font-bold text-[#102A43] text-[15px]" x-text="selectedLog?.user?.name"></span>
                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold" :class="selectedLog?.user?.role === 'super_admin' ? 'bg-[#D1F0ED] text-[#125A6B]' : (selectedLog?.user?.role === 'hr_admin' ? 'bg-[#EFE9FB] text-[#7257B7]' : (selectedLog?.user?.role === 'reviewer' ? 'bg-[#FFE4E6] text-[#E11D48]' : 'bg-[#E2F4F3] text-[#147D92]'))" x-text="selectedLog?.user?.role_label"></span>
              </div>
              <div class="font-['Inter'] text-[12px] text-[#62798A] mt-0.5" x-text="selectedLog?.user?.email"></div>
            </div>
            <div class="shrink-0 text-right">
              <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold" :class="selectedLog?.user?.is_active ? 'bg-[#E7F6EE] text-[#19734A]' : 'bg-[#F0F3F5] text-[#62798A]'">
                <span class="size-1.5 rounded-full" :class="selectedLog?.user?.is_active ? 'bg-[#198754]' : 'bg-[#7890A0]'"></span>
                <span x-text="selectedLog?.user?.is_active ? 'Akun Aktif' : 'Nonaktif'"></span>
              </span>
            </div>
          </div>
        </div>

        <!-- Section 2: Ringkasan Aktivitas & Waktu -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <!-- Card Kiri: Tindakan -->
          <div class="bg-white rounded-[12px] p-4 border border-[#EDF2F5] shadow-xs">
            <div class="text-[11px] uppercase tracking-wider font-bold text-[#62798A] font-['Inter'] mb-2.5">
              Tindakan Dilakukan
            </div>
            <div class="flex items-center gap-2 mb-2">
              <span 
                class="px-2.5 py-0.5 rounded text-[12px] font-semibold border"
                :class="[selectedLog?.action_style?.bg, selectedLog?.action_style?.text, selectedLog?.action_style?.border]"
                x-text="selectedLog?.action_label">
              </span>
              <span class="font-['Inter'] font-semibold text-[#102A43] text-[13px]" x-text="selectedLog?.entity_type"></span>
            </div>
            <p class="font-['Inter'] text-[13px] text-[#314E60] font-medium m-0 leading-relaxed" x-text="selectedLog?.description"></p>
            <div class="font-['Inter'] text-[11px] text-[#7890A0] mt-1" x-text="'Identifier: ' + (selectedLog?.entity_id || '-')"></div>
          </div>

          <!-- Card Kanan: Waktu Eksekusi -->
          <div class="bg-white rounded-[12px] p-4 border border-[#EDF2F5] shadow-xs">
            <div class="text-[11px] uppercase tracking-wider font-bold text-[#62798A] font-['Inter'] mb-2.5">
              Waktu Eksekusi
            </div>
            <div class="space-y-1.5">
              <div class="flex items-center gap-2">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#62798A" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span class="font-['Inter'] text-[13px] text-[#102A43] font-semibold" x-text="(selectedLog?.date || '') + ' • ' + (selectedLog?.time || '')"></span>
              </div>
              <div class="font-['Inter'] text-[12px] text-[#147D92] font-semibold pl-6 flex items-center gap-1.5">
                <span class="size-1.5 rounded-full bg-[#147D92]"></span>
                <span x-text="formatTimeAgo(selectedLog?.created_at, selectedLog?.time_ago)"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Section 3: Informasi Klien & Jaringan -->
        <div class="bg-white rounded-[12px] p-4.5 border border-[#EDF2F5] shadow-xs">
          <div class="text-[11px] uppercase tracking-wider font-bold text-[#62798A] font-['Inter'] mb-3">
            Informasi Jaringan & Peramban (Client)
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
            <div class="bg-[#F8FAFC] p-3 rounded-[8px] border border-[#EDF2F5]">
              <div class="text-[11px] text-[#7890A0] font-['Inter']">IP Address</div>
              <div class="text-[13px] font-mono font-bold text-[#102A43] mt-0.5" x-text="selectedLog?.ip_address"></div>
            </div>
            <div class="bg-[#F8FAFC] p-3 rounded-[8px] border border-[#EDF2F5]">
              <div class="text-[11px] text-[#7890A0] font-['Inter']">Browser</div>
              <div class="text-[13px] font-semibold text-[#102A43] mt-0.5" x-text="selectedLog?.browser"></div>
            </div>
            <div class="bg-[#F8FAFC] p-3 rounded-[8px] border border-[#EDF2F5]">
              <div class="text-[11px] text-[#7890A0] font-['Inter']">Sistem Operasi</div>
              <div class="text-[13px] font-semibold text-[#102A43] mt-0.5" x-text="selectedLog?.os"></div>
            </div>
          </div>

          <div class="bg-[#F8FAFC] p-3 rounded-[8px] border border-[#EDF2F5] text-left">
            <div class="flex items-center justify-between mb-1">
              <span class="text-[11px] text-[#7890A0] font-['Inter']">User Agent Lengkap:</span>
              <button 
                type="button" 
                @click="copyToClipboard(selectedLog?.user_agent)" 
                class="text-[11px] font-['Inter'] text-[#147D92] hover:underline bg-transparent border-none cursor-pointer flex items-center gap-1">
                <span x-text="copiedUA ? 'Tersalin ✓' : 'Salin'"></span>
              </button>
            </div>
            <div class="text-[11px] font-mono text-[#486174] break-all select-all" x-text="selectedLog?.user_agent"></div>
          </div>
        </div>

        <!-- Section 4: Data & Perubahan (Payload / Values) -->
        <div class="bg-white rounded-[12px] p-4.5 border border-[#EDF2F5] shadow-xs">
          <div class="flex items-center justify-between mb-3">
            <div class="text-[11px] uppercase tracking-wider font-bold text-[#62798A] font-['Inter']">
              Data Perubahan & Parameter
            </div>
            <button 
              type="button" 
              @click="showRawJson = !showRawJson" 
              class="text-[11px] font-['Inter'] text-[#147D92] font-semibold hover:underline bg-transparent border-none cursor-pointer">
              <span x-text="showRawJson ? 'Tutup Format Raw' : 'Lihat Raw JSON'"></span>
            </button>
          </div>

          <!-- Raw JSON View Toggle -->
          <div x-show="showRawJson" style="display: none;" class="mb-4 bg-[#102A43] rounded-[8px] p-3 overflow-x-auto text-left">
            <pre class="font-mono text-[11px] text-[#A0AEC0] m-0" x-text="JSON.stringify({ old_values: selectedLog?.old_values, new_values: selectedLog?.new_values }, null, 2)"></pre>
          </div>

          <!-- Structured Comparison or Payload Table -->
          <template x-if="selectedLog?.old_values && selectedLog?.new_values">
            <div class="overflow-x-auto border border-[#EDF2F5] rounded-[8px]">
              <table class="w-full text-left text-[12px] font-['Inter']">
                <thead>
                  <tr class="bg-[#F8FAFC] border-b border-[#EDF2F5] text-[#62798A]">
                    <th class="py-2.5 px-3 font-semibold">Atribut / Field</th>
                    <th class="py-2.5 px-3 font-semibold text-[#B91C1C]">Nilai Lama (Sebelum)</th>
                    <th class="py-2.5 px-3 font-semibold text-[#19734A]">Nilai Baru (Sesudah)</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-[#EDF2F5]">
                  <template x-for="(key, i) in getDiffKeys()" :key="i">
                    <tr class="hover:bg-gray-50">
                      <td class="py-2 px-3 font-medium text-[#102A43]" x-text="key"></td>
                      <td class="py-2 px-3 text-[#B91C1C] font-mono text-[11px] bg-red-50/40" x-text="formatValue(selectedLog?.old_values[key])"></td>
                      <td class="py-2 px-3 text-[#19734A] font-mono text-[11px] bg-emerald-50/40" x-text="formatValue(selectedLog?.new_values[key])"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </template>

          <!-- Single Payload (New Values Only) -->
          <template x-if="!selectedLog?.old_values && selectedLog?.new_values">
            <div class="overflow-x-auto border border-[#EDF2F5] rounded-[8px]">
              <table class="w-full text-left text-[12px] font-['Inter']">
                <thead>
                  <tr class="bg-[#F8FAFC] border-b border-[#EDF2F5] text-[#62798A]">
                    <th class="py-2.5 px-3 font-semibold w-1/3">Parameter</th>
                    <th class="py-2.5 px-3 font-semibold">Nilai</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-[#EDF2F5]">
                  <template x-for="(val, key) in selectedLog?.new_values" :key="key">
                    <tr class="hover:bg-gray-50">
                      <td class="py-2 px-3 font-medium text-[#102A43]" x-text="key"></td>
                      <td class="py-2 px-3 text-[#314E60] font-mono text-[11px]" x-text="formatValue(val)"></td>
                    </tr>
                  </template>
                </tbody>
              </table>
            </div>
          </template>

          <!-- No Payload Available -->
          <template x-if="!selectedLog?.old_values && !selectedLog?.new_values">
            <div class="text-center py-4 text-[#7890A0] text-[12px] italic">
              Tidak ada perubahan data spesifik yang dicatat pada aktivitas ini.
            </div>
          </template>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="flex items-center justify-end px-6 py-3.5 bg-[#F8FAFC] border-t border-[#EDF2F5] shrink-0">
        <button 
          type="button" 
          @click="detailModal = false" 
          class="h-9 px-4.5 rounded-[8px] bg-[#147D92] text-white font-['Inter'] font-semibold text-[13px] hover:bg-[#0f677a] transition-colors cursor-pointer border-none shadow-xs">
          Tutup
        </button>
      </div>

    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  function activityTable() {
    return {
      logs: [],
      loading: false,
      error: '',
      filterOpen: false,
      detailModal: false,
      selectedLog: null,
      copiedUA: false,
      showRawJson: false,

      // Real-time & Synchronization States
      autoRefresh: true,
      refreshTimer: null,
      nowTicker: Date.now(),
      tickerInterval: null,
      lastSynced: '',

      // Filter States
      filters: {
        search: '',
        user_id: '',
        role: '',
        action: '',
        date_from: '',
        date_to: '',
      },

      // Pagination Meta
      meta: {
        current_page: 1,
        last_page: 1,
        from: 0,
        to: 0,
        total: 0,
        per_page: 10,
      },

      init() {
        this.fetchLogs(1);
        this.startTicker();
        this.startAutoRefresh();
      },

      startTicker() {
        if (this.tickerInterval) clearInterval(this.tickerInterval);
        // Perbarui ticker tiap 10 detik agar label waktu relatif update secara real-time
        this.tickerInterval = setInterval(() => {
          this.nowTicker = Date.now();
        }, 10000);
      },

      startAutoRefresh() {
        if (this.refreshTimer) clearInterval(this.refreshTimer);
        // Polling background tiap 15 detik jika autoRefresh aktif
        this.refreshTimer = setInterval(() => {
          if (this.autoRefresh && !this.detailModal && !this.filterOpen && this.meta.current_page === 1) {
            this.fetchLogs(1, true); // silent refresh tanpa skeleton
          }
        }, 15000);
      },

      toggleAutoRefresh() {
        this.autoRefresh = !this.autoRefresh;
        if (this.autoRefresh) {
          this.fetchLogs(this.meta.current_page);
          this.startAutoRefresh();
        } else if (this.refreshTimer) {
          clearInterval(this.refreshTimer);
          this.refreshTimer = null;
        }
      },

      formatTimeAgo(isoString, fallback) {
        if (!isoString) return fallback || '-';
        // Dependensi reaktif terhadap nowTicker agar Alpine.js me-render ulang otomatis
        const _tick = this.nowTicker;
        const target = new Date(isoString).getTime();
        if (isNaN(target)) return fallback || '-';

        const diffSec = Math.floor((Date.now() - target) / 1000);

        if (diffSec < 45) return 'Baru saja';
        if (diffSec < 90) return '1 menit lalu';
        const diffMin = Math.floor(diffSec / 60);
        if (diffMin < 60) return `${diffMin} menit lalu`;
        const diffHour = Math.floor(diffMin / 60);
        if (diffHour < 24) return `${diffHour} jam lalu`;
        const diffDay = Math.floor(diffHour / 24);
        if (diffDay === 1) return 'Kemarin';
        if (diffDay < 30) return `${diffDay} hari lalu`;
        const diffMonth = Math.floor(diffDay / 30);
        if (diffMonth < 12) return `${diffMonth} bulan lalu`;
        return fallback || `${Math.floor(diffDay / 365)} tahun lalu`;
      },

      get activeFilterCount() {
        let count = 0;
        if (this.filters.user_id) count++;
        if (this.filters.role) count++;
        if (this.filters.action) count++;
        if (this.filters.date_from || this.filters.date_to) count++;
        return count;
      },

      getUserFilterLabel() {
        if (this.filters.user_id === 'system') return 'System Auto';
        const select = document.querySelector('select[x-model="filters.user_id"]');
        if (select && select.selectedOptions[0]) {
          return select.selectedOptions[0].text;
        }
        return this.filters.user_id;
      },

      getExportUrl(type) {
        const base = type === 'pdf' 
          ? '{{ route('superadmin.activity.export.pdf') }}' 
          : '{{ route('superadmin.activity.export.xlsx') }}';
        
        const params = new URLSearchParams();
        Object.entries(this.filters).forEach(([key, val]) => {
          if (val !== '' && val !== null && val !== undefined) {
            params.append(key, val);
          }
        });

        const qs = params.toString();
        return qs ? `${base}?${qs}` : base;
      },

      datePickerInstance: null,

      initDateRangePicker(el) {
        const setup = () => {
          if (typeof flatpickr === 'undefined') {
            setTimeout(setup, 50);
            return;
          }
          const self = this;
          this.datePickerInstance = flatpickr(el, {
            mode: 'range',
            dateFormat: 'd M Y',
            locale: (flatpickr.l10ns && flatpickr.l10ns.id) ? flatpickr.l10ns.id : 'default',
            conjunction: ' - ',
            onChange: function(selectedDates, dateStr, instance) {
              if (selectedDates.length === 2) {
                const formatDate = (d) => {
                  const year = d.getFullYear();
                  const month = String(d.getMonth() + 1).padStart(2, '0');
                  const day = String(d.getDate()).padStart(2, '0');
                  return `${year}-${month}-${day}`;
                };
                const [start, end] = selectedDates[0] <= selectedDates[1] 
                  ? [selectedDates[0], selectedDates[1]] 
                  : [selectedDates[1], selectedDates[0]];

                self.filters.date_from = formatDate(start);
                self.filters.date_to = formatDate(end);
                self.fetchLogs(1);
              } else if (selectedDates.length === 0) {
                if (self.filters.date_from !== '' || self.filters.date_to !== '') {
                  self.filters.date_from = '';
                  self.filters.date_to = '';
                  self.fetchLogs(1);
                }
              }
            },
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
              
              resetBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                instance.clear();
              });
              
              btnContainer.appendChild(infoText);
              btnContainer.appendChild(resetBtn);
              instance.calendarContainer.appendChild(btnContainer);
            }
          });
        };
        setup();
      },

      getDateFilterLabel() {
        if (this.datePickerInstance && this.datePickerInstance.input && this.datePickerInstance.input.value) {
          return this.datePickerInstance.input.value;
        }
        if (this.filters.date_from && this.filters.date_to) {
          return this.filters.date_from + ' s/d ' + this.filters.date_to;
        }
        return this.filters.date_from || this.filters.date_to || '';
      },

      clearDateFilter() {
        this.filters.date_from = '';
        this.filters.date_to = '';
        if (this.datePickerInstance) {
          this.datePickerInstance.clear();
        } else {
          this.fetchLogs(1);
        }
      },

      resetFilters() {
        this.filters.search = '';
        this.filters.user_id = '';
        this.filters.role = '';
        this.filters.action = '';
        this.filters.date_from = '';
        this.filters.date_to = '';
        if (this.datePickerInstance) {
          this.datePickerInstance.clear();
        }
        this.fetchLogs(1);
      },

      async fetchLogs(page = 1, silent = false) {
        if (page < 1 || (this.meta.last_page && page > this.meta.last_page && page !== 1)) return;
        if (!silent) this.loading = true;
        this.error = '';

        const params = new URLSearchParams({
          page: page,
          per_page: this.meta.per_page,
        });

        // Append filters if present
        Object.entries(this.filters).forEach(([key, val]) => {
          if (val !== '' && val !== null && val !== undefined) {
            params.append(key, val);
          }
        });

        try {
          const res = await fetch(`{{ route('superadmin.activity.data') }}?${params}`, {
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
            credentials: 'same-origin',
          });

          if (res.status === 401) {
            window.location.href = '{{ route('login') }}';
            return;
          }

          const data = await res.json();
          if (!res.ok) throw new Error(data.message || 'Gagal memuat riwayat aktivitas.');

          this.logs = data.data;
          this.meta = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from || 0,
            to: data.to || 0,
            total: data.total,
            per_page: data.per_page,
          };
          const now = new Date();
          this.lastSynced = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }) + ' WIB';
        } catch (e) {
          this.error = e.message || 'Terjadi kesalahan saat memuat data riwayat.';
          console.error(e);
        } finally {
          if (!silent) this.loading = false;
        }
      },

      openDetail(log) {
        this.selectedLog = log;
        this.copiedUA = false;
        this.showRawJson = false;
        this.detailModal = true;
      },

      copyToClipboard(text) {
        if (!text) return;
        navigator.clipboard.writeText(text).then(() => {
          this.copiedUA = true;
          setTimeout(() => { this.copiedUA = false; }, 2500);
        });
      },

      formatValue(val) {
        if (val === null || val === undefined) return '(kosong)';
        if (typeof val === 'boolean') return val ? 'true' : 'false';
        if (typeof val === 'object') return JSON.stringify(val);
        return String(val);
      },

      getDiffKeys() {
        if (!this.selectedLog) return [];
        const oldKeys = Object.keys(this.selectedLog.old_values || {});
        const newKeys = Object.keys(this.selectedLog.new_values || {});
        const allKeys = Array.from(new Set([...oldKeys, ...newKeys]));
        // Saring key internal jika ada
        return allKeys.filter(k => k !== 'description');
      },

      get pages() {
        const { current_page: c, last_page: l } = this.meta;
        if (l <= 7) return Array.from({ length: l }, (_, i) => i + 1);
        const out = [1];
        const start = Math.max(2, c - 1);
        const end = Math.min(l - 1, c + 1);
        if (start > 2) out.push('...');
        for (let i = start; i <= end; i++) out.push(i);
        if (end < l - 1) out.push('...');
        out.push(l);
        return out;
      },
    };
  }
</script>
@endpush
