@extends('layouts.hradmin')

@section('title', 'Bank soal')
@section('page_title', 'Bank soal')

@section('content')

@php
  $categories = $categories ?? \App\Models\QuestionCategory::orderBy('name')->get();
  $questions  = $questions ?? \App\Models\Question::with(['category', 'creator', 'options'])
      ->latest('updated_at')
      ->latest('id')
      ->paginate(10);
@endphp

<div x-data="bankSoalPage()" x-init="init()">

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
        Bank soal
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
        Kelola soal, kategori, dan kualitas materi asesmen.
      </div>
    </div>
    <a href="{{ url('/hr/question-bank/create') }}" class="flex items-center bg-[#147D92] rounded-[10px] shrink-0 gap-[9px] h-[42px] px-4 cursor-pointer hover:bg-[#126f82] transition-colors no-underline">
      <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
        <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
        <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
      </svg>
      <div class="text-white font-['Inter',system-ui,sans-serif] text-[14px]/[20px] font-[650]">
        Tambah soal
      </div>
    </a>
  </div>

  <!-- Table Card -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] overflow-hidden">
    <!-- Filter Toolbar -->
    <div class="flex items-center justify-between border-b border-[#EDF2F5] shrink-0 gap-4 h-[76px] py-4 px-5">
      <div class="flex items-center border border-[#DDE6ED] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[340px] focus-within:border-[#147D92] transition-colors bg-white">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0 pointer-events-none">
          <circle cx="11" cy="11" r="7" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m20 20-4-4" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <input type="text" x-model="filters.search" @input.debounce.300ms="fetchQuestions(1)" placeholder="Cari pertanyaan atau kata kunci..." class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full placeholder:text-[#92A4B0]">
        <button type="button" x-show="filters.search" @click="filters.search = ''; fetchQuestions(1)" title="Hapus pencarian" style="display: none;" class="bg-transparent border-none p-0.5 text-[#7890A0] hover:text-[#314E60] cursor-pointer flex items-center justify-center shrink-0">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="flex items-center gap-2.5">
        <button type="button" x-show="selectedIds.length > 0" @click="deleteSelectedQuestions()" style="display: none;" class="h-10 px-3.5 rounded-[10px] border border-[#FECACA] bg-[#FEF2F2] hover:bg-[#FEE2E2] text-[#E53E3E] font-['Inter',system-ui,sans-serif] font-semibold text-[13px]/[18px] flex items-center gap-2 cursor-pointer transition-colors shrink-0">
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
            <path d="M3 6h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <span x-text="'Hapus terpilih (' + selectedIds.length + ')'"></span>
        </button>

        <div class="relative">
          <select name="category_id" x-model="filters.category_id" @change="fetchQuestions(1)" class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua kategori</option>
            @foreach ($categories as $category)
              <option value="{{ $category->id }}">
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <div class="relative">
          <select x-model="filters.tipe" @change="fetchQuestions(1)" class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua tipe</option>
            <option value="pilihan_ganda">Pilihan Ganda</option>
            <option value="essay">Essay</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>

        <div class="relative">
          <select x-model="filters.status" @change="fetchQuestions(1)" class="appearance-none h-10 pl-3 pr-9 rounded-[10px] border border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/[18px] outline-none focus:border-[#147D92]">
            <option value="">Semua status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
          <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Table Header -->
    <div class="flex items-center bg-[#F3F7F9] shrink-0 h-[42px] px-5">
      <div class="shrink-0 w-[36px] flex items-center">
        <input type="checkbox" :checked="isAllSelected" @change="toggleSelectAll($event.target.checked)" :disabled="questions.length === 0" title="Pilih semua soal di halaman ini" class="w-4 h-4 rounded border-[#CBD5E1] accent-[#147D92] cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed">
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] flex-1 min-w-0">
        PERTANYAAN
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[160px]">
        KATEGORI
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[110px]">
        TIPE
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[80px]">
        SKOR
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold tracking-[0.07em] shrink-0 w-[90px]">
        STATUS
      </div>
      <div class="shrink-0 w-[38px]"></div>
    </div>

    <!-- Table Rows Container -->
    <div class="flex flex-col relative" :class="loading ? 'opacity-60 pointer-events-none' : ''">
      <!-- Loading progress indicator -->
      <div x-show="loading" class="absolute inset-x-0 top-0 h-[2px] bg-[#147D92] animate-pulse z-10" style="display: none;"></div>

      <template x-for="question in questions" :key="question.id">
        <div class="flex items-center border-b border-[#EDF2F5] shrink-0 min-h-[70px] py-3 px-5 hover:bg-gray-50/50 transition-colors" :class="isSelected(question.id) ? 'bg-[#F0FAF9]/60' : ''">
          <div class="shrink-0 w-[36px] flex items-center">
            <input type="checkbox" :checked="isSelected(question.id)" @change="toggleSelectOne(question.id, $event.target.checked)" class="w-4 h-4 rounded border-[#CBD5E1] accent-[#147D92] cursor-pointer">
          </div>
          <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
            <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate" :title="question.question_text" x-text="question.question_text"></div>
            <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate" x-text="'Dibuat ' + formatDate(question.created_at) + ' · ' + (question.essay_rubric ? question.essay_rubric : ('terakhir diperbarui ' + (question.creator ? question.creator.name : 'HR Admin')))"></div>
          </div>

          <div class="shrink-0 w-[160px] pr-2">
            <div class="inline-flex items-center justify-center rounded-[6px] h-6 px-2.5 max-w-full" :class="question.type === 'essay' ? 'bg-[#EFE9FB]' : 'bg-[#E7EEF9]'">
              <div class="font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold truncate" :class="question.type === 'essay' ? 'text-[#7257B7]' : 'text-[#3B5B93]'" :title="question.category ? question.category.name : '-'" x-text="question.category ? question.category.name : '-'"></div>
            </div>
          </div>

          <div class="shrink-0 w-[110px]">
            <div x-show="question.type === 'essay'" class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 px-2.5">
              <div class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">
                Essay
              </div>
            </div>
            <div x-show="question.type !== 'essay'" class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 px-2.5">
              <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">
                Pilihan ganda
              </div>
            </div>
          </div>

          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold shrink-0 w-[80px]" x-text="question.type === 'essay' ? '-' : (formatScore(question.max_score) + ' poin')"></div>

          <div class="shrink-0 w-[90px]">
            <div x-show="question.status === 'active'" class="inline-flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 px-2.5">
              <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Aktif</div>
            </div>
            <div x-show="question.status === 'archived'" class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 px-2.5">
              <div class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Arsip</div>
            </div>
            <div x-show="question.status !== 'active' && question.status !== 'archived'" class="inline-flex items-center justify-center bg-[#F0F3F5] rounded-[6px] h-6 px-2.5">
              <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Nonaktif</div>
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

            <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-0 top-9 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-20 overflow-hidden flex flex-col py-1">
              <a :href="'{{ url('/hr/question-bank/edit') }}/' + question.id" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2 no-underline">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Edit
              </a>
              <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M21 8v13H3V8" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M1 3h22v5H1z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M10 12h4" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Arsip
              </button>
              <button type="button" @click.stop="menuOpen = false; deleteQuestion(question)" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
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
      <div x-show="!loading && questions.length === 0" style="display: none;" class="flex flex-col items-center justify-center py-16 px-4 text-center">
        <div class="w-14 h-14 rounded-full bg-[#F0F5F8] flex items-center justify-center text-[#7890A0] mb-3">
          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
          </svg>
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[16px] font-bold text-[#102A43] mb-1">
          Belum ada soal di Bank Soal
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#7890A0] max-w-sm mb-4" x-text="hasActiveFilters ? 'Tidak ada soal yang cocok dengan filter pencarian saat ini.' : 'Tambahkan soal pertama Anda ke dalam kategori asesmen.'">
        </div>
        <div class="flex items-center gap-3">
          <button type="button" x-show="hasActiveFilters" @click="resetAllFilters()" style="display: none;" class="inline-flex items-center gap-2 px-4 py-2 rounded-[8px] bg-white border border-[#DDE6ED] text-[#486174] font-['Inter',system-ui,sans-serif] text-[13px] font-semibold hover:bg-gray-50 transition-colors cursor-pointer">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
            Bersihkan filter
          </button>
          <a href="{{ url('/hr/question-bank/create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-[8px] bg-[#147D92] text-white font-['Inter',system-ui,sans-serif] text-[13px] font-semibold hover:bg-[#116a7c] transition-colors no-underline">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            Tambah soal baru
          </a>
        </div>
      </div>
    </div>

    <!-- Table Footer / Pagination -->
    <div class="flex items-center justify-between p-5 border-t border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
        <span x-show="meta.total > 0">Menampilkan <span x-text="meta.from"></span>-<span x-text="meta.to"></span> dari <span x-text="meta.total"></span> soal</span>
        <span x-show="meta.total === 0">Menampilkan 0 soal</span>
      </div>

      <div class="flex items-center gap-2.5" x-show="meta.last_page > 1">
        <button type="button" @click="fetchQuestions(meta.current_page - 1)" :disabled="meta.current_page <= 1 || loading" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
          Sebelumnya
        </button>

        <div class="flex items-center gap-1 mx-1">
          <template x-for="(p, idx) in pages" :key="'p' + idx">
            <div>
              <span x-show="p === '...'" class="text-[#62798A] px-1 font-['Inter',system-ui,sans-serif] text-[13px]">...</span>
              <button x-show="p !== '...'" type="button" @click="fetchQuestions(p)" :class="p === meta.current_page ? 'bg-[#147D92] text-white' : 'border border-[#DDE6ED] bg-white text-[#62798A] hover:bg-[#F8FAFC]'" class="size-8 rounded-[6px] cursor-pointer text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors" x-text="p"></button>
            </div>
          </template>
        </div>

        <button type="button" @click="fetchQuestions(meta.current_page + 1)" :disabled="meta.current_page >= meta.last_page || loading" class="h-8 px-3 rounded-[6px] border border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
          Selanjutnya
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function bankSoalPage() {
    return {
      questions: {!! json_encode($questions->items()) !!},
      selectedIds: [],
      loading: false,
      filters: {
        search: '{{ request('search') }}',
        category_id: '{{ request('category_id') }}',
        tipe: '{{ request('tipe') }}',
        status: '{{ request('status') }}',
      },
      meta: {
        current_page: {{ $questions->currentPage() }},
        last_page: {{ $questions->lastPage() }},
        from: {{ $questions->firstItem() ?? 0 }},
        to: {{ $questions->lastItem() ?? 0 }},
        total: {{ $questions->total() }},
        per_page: {{ $questions->perPage() }},
      },
      toast: {
        show: {{ session('success') || session('error') ? 'true' : 'false' }},
        type: '{{ session('success') ? 'success' : (session('error') ? 'error' : '') }}',
        message: {!! json_encode(session('success') ?? session('error') ?? '') !!},
      },

      init() {
        const flash = sessionStorage.getItem('bankSoalFlash');
        if (flash) {
          sessionStorage.removeItem('bankSoalFlash');
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
        return !!(this.filters.search || this.filters.category_id || this.filters.tipe || this.filters.status);
      },

      resetAllFilters() {
        this.filters.search = '';
        this.filters.category_id = '';
        this.filters.tipe = '';
        this.filters.status = '';
        this.fetchQuestions(1);
      },

      async fetchQuestions(page = 1) {
        this.loading = true;
        try {
          const params = new URLSearchParams();
          params.append('page', page);
          if (this.filters.search) params.append('search', this.filters.search);
          if (this.filters.category_id) params.append('category_id', this.filters.category_id);
          if (this.filters.tipe) params.append('tipe', this.filters.tipe);
          if (this.filters.status) params.append('status', this.filters.status);

          const queryParams = new URLSearchParams();
          if (this.filters.search) queryParams.append('search', this.filters.search);
          if (this.filters.category_id) queryParams.append('category_id', this.filters.category_id);
          if (this.filters.tipe) queryParams.append('tipe', this.filters.tipe);
          if (this.filters.status) queryParams.append('status', this.filters.status);
          if (page > 1) queryParams.append('page', page);
          const queryString = queryParams.toString();
          window.history.replaceState({}, '', queryString ? `${window.location.pathname}?${queryString}` : window.location.pathname);

          const res = await fetch(`{{ url('/api/question-bank') }}?${params.toString()}`, {
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
            },
          });

          if (res.status === 401) {
            window.location.href = '{{ route('login') }}';
            return;
          }

          if (res.ok) {
            const data = await res.json();
            this.questions = data.data || [];
            this.selectedIds = [];
            this.meta = {
              current_page: data.current_page || 1,
              last_page: data.last_page || 1,
              from: data.from || 0,
              to: data.to || 0,
              total: data.total || 0,
              per_page: data.per_page || 10,
            };
          }
        } catch (e) {
          console.error('Gagal memuat daftar soal:', e);
        } finally {
          this.loading = false;
        }
      },

      formatScore(score) {
        const num = Number(score || 0);
        return Number.isInteger(num) ? String(num) : num.toFixed(2).replace(/\.?0+$/, '');
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

      get isAllSelected() {
        if (!this.questions || this.questions.length === 0) return false;
        return this.questions.every(q => this.selectedIds.includes(Number(q.id)));
      },

      isSelected(id) {
        return this.selectedIds.includes(Number(id));
      },

      toggleSelectAll(checked) {
        if (checked) {
          this.selectedIds = this.questions.map(q => Number(q.id));
        } else {
          this.selectedIds = [];
        }
      },

      toggleSelectOne(id, checked) {
        const numId = Number(id);
        if (checked) {
          if (!this.selectedIds.includes(numId)) {
            this.selectedIds.push(numId);
          }
        } else {
          this.selectedIds = this.selectedIds.filter(item => item !== numId);
        }
      },

      async deleteSelectedQuestions() {
        if (this.selectedIds.length === 0) return;

        const count = this.selectedIds.length;
        let isConfirmed = false;

        if (typeof Swal !== 'undefined') {
          const result = await Swal.fire({
            title: `Hapus ${count} Soal Terpilih?`,
            text: `Apakah Anda yakin ingin menghapus ${count} soal yang dipilih? Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E53E3E',
            cancelButtonColor: '#7890A0',
            confirmButtonText: 'Ya, Hapus Semua',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true,
            customClass: {
              popup: 'rounded-[16px] font-sans',
              confirmButton: 'rounded-[8px] font-medium text-sm px-4 py-2',
              cancelButton: 'rounded-[8px] font-medium text-sm px-4 py-2',
            },
          });
          isConfirmed = result.isConfirmed;
        } else {
          isConfirmed = confirm(`Apakah Anda yakin ingin menghapus ${count} soal yang dipilih?`);
        }

        if (!isConfirmed) return;

        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const res = await fetch(`{{ url('/api/question-bank/bulk-delete') }}`, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({ ids: this.selectedIds }),
          });

          const data = await res.json().catch(() => ({}));

          if (res.ok) {
            const successMsg = data.message || `${count} soal terpilih berhasil dihapus.`;
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Berhasil!',
                text: successMsg,
                icon: 'success',
                confirmButtonColor: '#147D92',
                timer: 2000,
                showConfirmButton: false,
              });
            }
            this.showToast({ type: 'success', message: successMsg });
            const remainingOnPage = this.questions.length - count;
            const targetPage = remainingOnPage <= 0 && this.meta.current_page > 1
              ? this.meta.current_page - 1
              : this.meta.current_page;
            this.selectedIds = [];
            this.fetchQuestions(targetPage);
          } else {
            const errorMsg = data.message || 'Gagal menghapus soal terpilih.';
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Gagal!',
                text: errorMsg,
                icon: 'error',
                confirmButtonColor: '#147D92',
              });
            } else {
              this.showToast({ type: 'error', message: errorMsg });
            }
          }
        } catch (e) {
          const connError = 'Terjadi kesalahan koneksi.';
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              title: 'Terjadi Kesalahan!',
              text: connError,
              icon: 'error',
              confirmButtonColor: '#147D92',
            });
          } else {
            this.showToast({ type: 'error', message: connError });
          }
        }
      },

      async deleteQuestion(question) {
        let isConfirmed = false;
        const snippet = question.question_text && question.question_text.length > 80
          ? question.question_text.substring(0, 80) + '...'
          : (question.question_text || '');

        if (typeof Swal !== 'undefined') {
          const result = await Swal.fire({
            title: 'Hapus Soal?',
            text: `Apakah Anda yakin ingin menghapus soal "${snippet}"? Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E53E3E',
            cancelButtonColor: '#7890A0',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            focusCancel: true,
            customClass: {
              popup: 'rounded-[16px] font-sans',
              confirmButton: 'rounded-[8px] font-medium text-sm px-4 py-2',
              cancelButton: 'rounded-[8px] font-medium text-sm px-4 py-2',
            },
          });
          isConfirmed = result.isConfirmed;
        } else {
          isConfirmed = confirm(`Apakah Anda yakin ingin menghapus soal "${snippet}"?`);
        }

        if (!isConfirmed) return;

        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const res = await fetch(`{{ url('/api/question-bank') }}/${question.id}`, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token,
            },
          });

          const data = await res.json().catch(() => ({}));

          if (res.ok) {
            const successMsg = data.message || 'Soal berhasil dihapus.';
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Berhasil!',
                text: successMsg,
                icon: 'success',
                confirmButtonColor: '#147D92',
                timer: 2000,
                showConfirmButton: false,
              });
            }
            this.showToast({ type: 'success', message: successMsg });
            const targetPage = this.questions.length === 1 && this.meta.current_page > 1
              ? this.meta.current_page - 1
              : this.meta.current_page;
            this.fetchQuestions(targetPage);
          } else {
            const errorMsg = data.message || 'Gagal menghapus soal.';
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Gagal!',
                text: errorMsg,
                icon: 'error',
                confirmButtonColor: '#147D92',
              });
            } else {
              this.showToast({ type: 'error', message: errorMsg });
            }
          }
        } catch (e) {
          const connError = 'Terjadi kesalahan koneksi.';
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              title: 'Terjadi Kesalahan!',
              text: connError,
              icon: 'error',
              confirmButtonColor: '#147D92',
            });
          } else {
            this.showToast({ type: 'error', message: connError });
          }
        }
      },

      get pages() {
        const c = this.meta.current_page, l = this.meta.last_page;
        if (l <= 7) return Array.from({ length: l }, (_, i) => i + 1);
        if (c <= 4) return [1, 2, 3, 4, 5, '...', l];
        if (c >= l - 3) return [1, '...', l - 4, l - 3, l - 2, l - 1, l];
        return [1, '...', c - 1, c, c + 1, '...', l];
      },
    };
  }
</script>
@endpush
