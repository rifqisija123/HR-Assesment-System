@extends('layouts.hradmin')

@section('title', 'Kategori soal')
@section('page_title', 'Kategori soal')

@section('content')
<!-- Flatpickr Datepicker Assets -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<script>
  function initDateRangePicker(el, comp) {
    if (typeof flatpickr === 'undefined') return;
    const fp = flatpickr(el, {
      mode: 'range',
      dateFormat: 'd M Y',
      defaultDate: comp.filters.date_range ? comp.filters.date_range.split(' - ') : null,
      locale: (flatpickr.l10ns && flatpickr.l10ns.id) ? flatpickr.l10ns.id : 'default',
      conjunction: ' - ',
      onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
          comp.filters.date_range = dateStr;
          comp.fetchCategories(1);
          instance.close();
        } else if (selectedDates.length === 0 && comp.filters.date_range !== '') {
          comp.filters.date_range = '';
          comp.fetchCategories(1);
        }
      },
      onClose: function(selectedDates, dateStr) {
        if (selectedDates.length === 2 && comp.filters.date_range !== dateStr) {
          comp.filters.date_range = dateStr;
          comp.fetchCategories(1);
        }
      },
      onReady: function(selectedDates, dateStr, instance) {
        const btnContainer = document.createElement('div');
        btnContainer.style.cssText = 'display:flex; align-items:center; justify-content:space-between; padding:8px 12px; border-top:1px solid #EDF2F5; background-color:#F8FAFC; border-bottom-left-radius:12px; border-bottom-right-radius:12px;';
        
        const infoText = document.createElement('span');
        infoText.style.cssText = 'color:#7890A0; font-size:11px; font-weight:500; font-family:Inter,system-ui,sans-serif;';
        infoText.innerText = 'Pilih rentang tanggal';

        const clearBtn = document.createElement('button');
        clearBtn.type = 'button';
        clearBtn.style.cssText = 'color:#62798A; font-size:12px; font-weight:600; font-family:Inter,system-ui,sans-serif; background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:6px;';
        clearBtn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg> Bersihkan';
        
        clearBtn.addEventListener('click', function() {
          instance.clear();
          el.value = '';
          comp.filters.date_range = '';
          comp.fetchCategories(1);
        });
        
        btnContainer.appendChild(infoText);
        btnContainer.appendChild(clearBtn);
        instance.calendarContainer.appendChild(btnContainer);
      }
    });
    el._flatpickrInstance = fp;
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

<div x-data="kategoriSoalPage()" x-init="init()">

  <!-- Toast Notification (Top Right) -->
  <div x-show="toast.show" 
       x-transition:enter="transition ease-out duration-300" 
       x-transition:enter-start="opacity-0 -translate-y-2" 
       x-transition:enter-end="opacity-100 translate-y-0" 
       x-transition:leave="transition ease-in duration-200" 
       x-transition:leave-start="opacity-100" 
       x-transition:leave-end="opacity-0" 
       style="display: none;"
       class="fixed top-6 right-6 z-50 max-w-[420px] flex items-start gap-3 px-4 py-3.5 rounded-[12px] shadow-[0_10px_30px_rgba(16,42,67,0.12)] border border-solid"
       :class="toast.type === 'success' ? 'bg-[#E7F6EE] border-[#BFE5CF]' : (toast.type === 'error' ? 'bg-[#FEF2F2] border-[#FBD5D5]' : 'bg-[#FFF7E6] border-[#F5D9A8]')">
    <svg x-show="toast.type === 'success'" width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="#198754"/><path d="m8 12 3 3 5-6" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
    <svg x-show="toast.type === 'error'" width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="#E53E3E"/><path d="M12 8v4M12 16h.01" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/></svg>
    <svg x-show="toast.type !== 'success' && toast.type !== 'error'" width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="#D69E2E"/><path d="M12 7v6M12 17h.01" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/></svg>
    <div class="font-['Inter',system-ui,sans-serif] text-[13px]/5 font-medium flex-1" :class="toast.type === 'success' ? 'text-[#19734A]' : (toast.type === 'error' ? 'text-[#C53030]' : 'text-[#8A5A00]')" x-text="toast.message"></div>
    <button type="button" @click="toast.show = false" class="ml-1 bg-transparent border-none cursor-pointer p-0.5 text-[#7890A0] hover:text-[#314E60]" aria-label="Tutup">
      <svg width="14" height="14" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
    </button>
  </div>

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
    <a href="{{ route('hr.question-categories.create') }}" class="flex items-center bg-[#147D92] rounded-[10px] shrink-0 gap-[9px] h-[42px] px-4 cursor-pointer hover:bg-[#126f82] transition-colors no-underline">
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
    <!-- Live Filter Toolbar -->
    <div class="flex items-center justify-between border-b border-[#EDF2F5] shrink-0 gap-4 h-[76px] py-4 px-5">
      <!-- Search Input (Live debounced) -->
      <div class="flex items-center border border-[#DDE6ED] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[340px] focus-within:border-[#147D92] transition-colors bg-white">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
          <circle cx="11" cy="11" r="7" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m20 20-4-4" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <input type="text" x-model="filters.search" @input.debounce.300ms="fetchCategories(1)" placeholder="Cari nama kategori atau deskripsi..." class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full placeholder:text-[#92A4B0]">
        <button type="button" x-show="filters.search" @click="filters.search = ''; fetchCategories(1)" title="Hapus pencarian" style="display: none;" class="bg-transparent border-none p-0.5 text-[#7890A0] hover:text-[#314E60] cursor-pointer flex items-center justify-center shrink-0">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="flex items-center gap-2.5">
        <!-- Date Range Picker Direct Calendar -->
        <div class="relative">
          <div class="flex items-center border border-[#DDE6ED] rounded-[10px] gap-2 h-10 px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
              <rect x="3" y="4" width="18" height="18" rx="2" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M16 2v4M8 2v4M3 10h18" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <input x-ref="dateRangeInput" x-init="initDateRangePicker($el, $data)" type="text" x-model="filters.date_range" placeholder="Pilih rentang tanggal..." class="bg-transparent border-none outline-none text-[#486174] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium w-[190px] cursor-pointer placeholder:text-[#92A4B0]">
            <button type="button" x-show="filters.date_range" @click.stop="clearDateRange()" title="Hapus rentang tanggal" style="display: none;" class="bg-transparent border-none p-0.5 text-[#7890A0] hover:text-[#C53030] cursor-pointer flex items-center justify-center shrink-0">
              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
            <svg x-show="!filters.date_range" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
              <polyline points="6 9 12 15 18 9" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <!-- Status Filter (Live change) -->
        <div class="relative">
          <select x-model="filters.status" @change="fetchCategories(1)" class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <!-- Tipe Filter (Live change) -->
        <div class="relative">
          <select x-model="filters.tipe" @change="fetchCategories(1)" class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua tipe</option>
            <option value="pilihan_ganda">Pilihan Ganda</option>
            <option value="essay">Essay</option>
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
        KATEGORI &amp; DESKRIPSI
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

    <!-- Table Rows Container -->
    <div class="flex flex-col relative" :class="loading ? 'opacity-60 pointer-events-none' : ''">
      <!-- Loading progress indicator -->
      <div x-show="loading" class="absolute inset-x-0 top-0 h-[2px] bg-[#147D92] animate-pulse z-10" style="display: none;"></div>

      <!-- Dynamic Rows via Alpine -->
      <template x-for="category in categories" :key="category.id">
        <div class="flex items-center border-b border-[#EDF2F5] shrink-0 min-h-[72px] py-3.5 px-5 hover:bg-gray-50/50 transition-colors">
          <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
            <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate" :title="category.name" x-text="category.name"></div>
            <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate" :title="category.description" x-text="category.description || 'Tidak ada deskripsi.'"></div>
          </div>
          <div class="shrink-0 w-[130px]">
            <div class="flex items-center gap-1.5">
              <span class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold" x-text="category.questions_count > 0 ? category.questions_count : (category.total_questions || 0)"></span>
              <span class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">soal</span>
            </div>
          </div>
          <div class="shrink-0 w-[110px]">
            <div x-show="category.type === 'essay'" class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 px-2.5">
              <div class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Essay</div>
            </div>
            <div x-show="category.type !== 'essay'" class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 px-2.5">
              <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan ganda</div>
            </div>
          </div>
          <div class="shrink-0 w-[110px]">
            <div x-show="category.is_active" class="inline-flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 px-2.5">
              <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Aktif</div>
            </div>
            <div x-show="!category.is_active" class="inline-flex items-center justify-center bg-[#F0F3F5] rounded-[6px] h-6 px-2.5">
              <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Nonaktif</div>
            </div>
          </div>
          <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 w-[170px] truncate" x-text="formatDate(category.updated_at || category.created_at) + ' · ' + (category.creator ? category.creator.name : 'HR Admin')"></div>
          
          <div class="flex justify-end shrink-0 w-[38px] relative" x-data="{ menuOpen: false }">
            <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded text-[#7890A0] hover:text-[#486174] hover:bg-gray-100 transition-colors flex items-center justify-center" aria-label="Menu opsi">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <circle cx="5" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                <circle cx="12" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                <circle cx="19" cy="12" r="1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
              </svg>
            </button>

            <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
              <a :href="'{{ url('/hr/question-categories/edit') }}/' + category.id" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2 no-underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit
              </a>
              <button type="button" @click.stop="menuOpen = false; deleteCategory(category)" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Delete
              </button>
            </div>
          </div>
        </div>
      </template>

      <!-- Empty State -->
      <div x-show="!loading && categories.length === 0" style="display: none;" class="flex flex-col items-center justify-center py-16 px-4 text-center">
        <div class="w-14 h-14 rounded-full bg-[#F0F5F8] flex items-center justify-center text-[#7890A0] mb-3">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/>
          </svg>
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[16px] font-bold text-[#102A43] mb-1">
          Belum ada kategori soal
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#7890A0] max-w-sm mb-4" x-text="hasActiveFilters ? 'Tidak ada kategori yang cocok dengan kriteria filter saat ini.' : 'Belum ada kategori soal yang ditambahkan.'">
        </div>
        <div class="flex items-center gap-3">
          <button type="button" x-show="hasActiveFilters" @click="resetAllFilters()" style="display: none;" class="inline-flex items-center gap-2 px-4 py-2 rounded-[8px] bg-white border border-[#DDE6ED] text-[#486174] font-['Inter',system-ui,sans-serif] text-[13px] font-semibold hover:bg-gray-50 transition-colors cursor-pointer">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            Bersihkan filter
          </button>
          <a href="{{ route('hr.question-categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-[8px] bg-[#147D92] text-white font-['Inter',system-ui,sans-serif] text-[13px] font-semibold hover:bg-[#116a7c] transition-colors no-underline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah kategori baru
          </a>
        </div>
      </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
        <span x-show="meta.total > 0">Menampilkan <span x-text="meta.from"></span>-<span x-text="meta.to"></span> dari <span x-text="meta.total"></span> kategori</span>
        <span x-show="meta.total === 0">Menampilkan 0 kategori</span>
      </div>

      <div class="flex items-center gap-2" x-show="meta.last_page > 1">
        {{-- Previous Button --}}
        <button type="button" @click="fetchCategories(meta.current_page - 1)" :disabled="meta.current_page <= 1 || loading" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:text-[#A2B0BA] disabled:opacity-50 disabled:cursor-not-allowed">
          Sebelumnya
        </button>

        {{-- Page Numbers --}}
        <div class="flex items-center gap-1 mx-1">
          <template x-for="(p, idx) in pages" :key="'p' + idx">
            <div>
              <span x-show="p === '...'" class="text-[#62798A] px-1 font-['Inter',system-ui,sans-serif] text-[13px]">...</span>
              <button x-show="p !== '...'" type="button" @click="fetchCategories(p)" :class="p === meta.current_page ? 'bg-[#147D92] text-white' : 'border border-[#DDE6ED] bg-white text-[#62798A] hover:bg-[#F8FAFC]'" class="size-8 rounded-[6px] cursor-pointer text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors" x-text="p"></button>
            </div>
          </template>
        </div>

        {{-- Next Button --}}
        <button type="button" @click="fetchCategories(meta.current_page + 1)" :disabled="meta.current_page >= meta.last_page || loading" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:text-[#A2B0BA] disabled:opacity-50 disabled:cursor-not-allowed">
          Selanjutnya
        </button>
      </div>
    </div>
  </div>

</div>
@endsection

@push('scripts')
<script>
  function kategoriSoalPage() {
    return {
      categories: {!! json_encode($categories->items()) !!},
      loading: false,
      filters: {
        search: '{{ request('search') }}',
        date_range: '{{ request('date_range') }}',
        status: '{{ request('status') }}',
        tipe: '{{ request('tipe') }}'
      },
      meta: {
        current_page: {{ $categories->currentPage() }},
        last_page: {{ $categories->lastPage() }},
        from: {{ $categories->firstItem() ?? 0 }},
        to: {{ $categories->lastItem() ?? 0 }},
        total: {{ $categories->total() }},
        per_page: {{ $categories->perPage() }}
      },
      toast: {
        show: {{ session('success') || session('error') ? 'true' : 'false' }},
        type: '{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}',
        message: {!! json_encode(session('success') ?? session('error') ?? '') !!}
      },
      init() {
        const flash = sessionStorage.getItem('kategoriFlash');
        if (flash) {
          sessionStorage.removeItem('kategoriFlash');
          try {
            this.showToast(JSON.parse(flash));
          } catch (e) {}
        } else if (this.toast.show) {
          setTimeout(() => { this.toast.show = false; }, 6000);
        }
      },
      showToast({ type = 'success', message = '' }) {
        this.toast = { show: true, type, message };
        setTimeout(() => { this.toast.show = false; }, 6000);
      },
      get hasActiveFilters() {
        return !!(this.filters.search || this.filters.date_range || this.filters.status || this.filters.tipe);
      },
      clearDateRange() {
        this.filters.date_range = '';
        const el = this.$refs.dateRangeInput;
        if (el && el._flatpickrInstance) {
          el._flatpickrInstance.clear();
        }
        this.fetchCategories(1);
      },
      resetAllFilters() {
        this.filters.search = '';
        this.filters.date_range = '';
        this.filters.status = '';
        this.filters.tipe = '';
        const el = this.$refs.dateRangeInput;
        if (el && el._flatpickrInstance) {
          el._flatpickrInstance.clear();
        }
        this.fetchCategories(1);
      },
      async fetchCategories(page = 1) {
        this.loading = true;
        try {
          const params = new URLSearchParams();
          params.append('page', page);
          if (this.filters.search) params.append('search', this.filters.search);
          if (this.filters.date_range) params.append('date_range', this.filters.date_range);
          if (this.filters.status) params.append('status', this.filters.status);
          if (this.filters.tipe) params.append('tipe', this.filters.tipe);

          // Update URL browser query string without reloading page
          const queryParams = new URLSearchParams();
          if (this.filters.search) queryParams.append('search', this.filters.search);
          if (this.filters.date_range) queryParams.append('date_range', this.filters.date_range);
          if (this.filters.status) queryParams.append('status', this.filters.status);
          if (this.filters.tipe) queryParams.append('tipe', this.filters.tipe);
          if (page > 1) queryParams.append('page', page);
          const queryString = queryParams.toString();
          window.history.replaceState({}, '', queryString ? `${window.location.pathname}?${queryString}` : window.location.pathname);

          const res = await fetch(`{{ url('/api/question-categories') }}?${params.toString()}`, {
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest'
            }
          });
          if (res.status === 401) {
            window.location.href = '{{ route('login') }}';
            return;
          }
          if (res.ok) {
            const data = await res.json();
            this.categories = data.data || [];
            this.meta = {
              current_page: data.current_page || 1,
              last_page: data.last_page || 1,
              from: data.from || 0,
              to: data.to || 0,
              total: data.total || 0,
              per_page: data.per_page || 10
            };
          }
        } catch (e) {
          console.error('Gagal memuat kategori:', e);
        } finally {
          this.loading = false;
        }
      },
      formatDate(dateStr) {
        if (!dateStr) return '-';
        const d = new Date(dateStr);
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const day = String(d.getDate()).padStart(2, '0');
        const month = months[d.getMonth()];
        const year = d.getFullYear();
        return `${day} ${month} ${year}`;
      },
      async deleteCategory(cat) {
        if (!confirm(`Apakah Anda yakin ingin menghapus kategori '${cat.name}'?`)) return;
        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
          const res = await fetch(`{{ url('/api/question-categories') }}/${cat.id}`, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token || ''
            }
          });
          const data = await res.json().catch(() => ({}));
          if (res.ok) {
            this.showToast({ type: 'success', message: data.message || 'Kategori soal berhasil dihapus.' });
            this.fetchCategories(this.meta.current_page);
          } else {
            this.showToast({ type: 'error', message: data.message || 'Gagal menghapus kategori.' });
          }
        } catch (e) {
          this.showToast({ type: 'error', message: 'Terjadi kesalahan koneksi.' });
        }
      },
      get pages() {
        const c = this.meta.current_page, l = this.meta.last_page;
        if (l <= 7) return Array.from({ length: l }, (_, i) => i + 1);
        if (c <= 4) return [1, 2, 3, 4, 5, '...', l];
        if (c >= l - 3) return [1, '...', l - 4, l - 3, l - 2, l - 1, l];
        return [1, '...', c - 1, c, c + 1, '...', l];
      }
    };
  }
</script>
@endpush
