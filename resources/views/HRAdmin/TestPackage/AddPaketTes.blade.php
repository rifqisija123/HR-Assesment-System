@extends('layouts.hradmin')

@section('title', 'Buat Paket Tes')
@section('page_title', 'Buat paket tes')

@section('content')

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">
      KONTEN ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">
      Buat paket tes
    </div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">
      Susun soal dari bank soal menjadi paket tes siap pakai.
    </div>
  </div>
  <a href="{{ url('/hr/test-packages') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
      Kembali
    </div>
  </a>
</div>

<div class="flex flex-col gap-5 mt-2">
  <form class="flex flex-col gap-5">

    {{-- Card 1: Informasi Paket --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
          Informasi paket
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Isi detail dasar paket tes yang akan dibuat.
        </div>
      </div>

      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Nama Paket --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Nama paket tes <span class="text-[#E53E3E]">*</span>
          </label>
          <input type="text" name="nama_paket" placeholder="Contoh: Assessment Dasar — Batch 08"
            class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Gunakan nama yang mencerminkan tujuan atau batch rekrutmen.
          </div>
        </div>

        {{-- Deskripsi --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Deskripsi <span class="text-[#A2B0BA] font-normal">(opsional)</span>
          </label>
          <textarea name="deskripsi" rows="3" placeholder="Jelaskan tujuan dan cakupan materi paket tes ini..."
            class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
        </div>

        {{-- Durasi & Status (2 kolom) --}}
        <div class="grid grid-cols-2 gap-5">

          {{-- Durasi --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Durasi <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <select name="durasi"
                class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="" disabled selected hidden>Pilih durasi</option>
                <option value="45">45 menit</option>
                <option value="60">60 menit</option>
                <option value="75">75 menit</option>
                <option value="90">90 menit</option>
                <option value="120">120 menit</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Total waktu pengerjaan yang diberikan ke kandidat.
            </div>
          </div>

          {{-- Status --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Status <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <select name="status"
                class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="aktif" selected>Aktif</option>
                <option value=nonaktif">Nonaktif</option>
                <option value="draft">Draft</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Draft tidak dapat digunakan di sesi tes sampai diaktifkan.
            </div>
          </div>

        </div>

      </div>
    </div>

    {{-- Card 2: Pilih Soal --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]" x-data="{
      selected: [],
      allIds: [1, 2, 3],
      get isAllSelected() { return this.allIds.length > 0 && this.allIds.every(id => this.selected.includes(id)); },
      get isIndeterminate() { return this.selected.length > 0 && !this.isAllSelected; },
      toggleAll() {
        if (this.isAllSelected) { this.selected = []; }
        else { this.selected = [...this.allIds]; }
      }
    }">
      <div class="flex items-center justify-between pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="flex flex-col gap-1">
          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
            Pilih soal
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
            Tambahkan soal dari bank soal ke dalam paket ini.
          </div>
        </div>
        {{-- Soal terpilih badge --}}
        <div class="flex items-center gap-3">
          <span class="font-['Inter',system-ui,sans-serif] text-[13px]/[16px] text-[#62798A]">
            <span x-text="selected.length" class="font-bold text-[#102A43]">0</span> soal dipilih
          </span>
        </div>
      </div>

      {{-- Toolbar --}}
      <div class="flex items-center justify-between shrink-0 h-[64px] px-5 border-b border-[#EDF2F5]" x-data="{ search: '', filterKategori: '', filterTipe: '' }">
        <div class="flex items-center border border-[#DDE6ED] rounded-[10px] shrink-0 gap-2.5 h-10 px-3 w-[300px] focus-within:border-[#147D92] transition-colors">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="shrink-0">
            <circle cx="11" cy="11" r="7" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="m20 20-4-4" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <input type="text" x-model="search" placeholder="Cari soal..." class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] w-full placeholder:text-[#A2B0BA]">
        </div>
        <div class="flex items-center gap-2.5">
          <div class="relative">
            <select x-model="filterKategori" class="appearance-none h-10 pl-3 pr-8 border border-[#DDE6ED] rounded-[10px] bg-white text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] outline-none cursor-pointer hover:bg-gray-50 transition-colors">
              <option value="">Semua kategori</option>
              <option value="Logika">Logika &amp; Penalaran</option>
              <option value="Kompetensi">Kompetensi Bidang</option>
              <option value="Manajerial">Kepemimpinan &amp; Manajerial</option>
            </select>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">
              <polyline points="6 9 12 15 18 9" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div class="relative">
            <select x-model="filterTipe" class="appearance-none h-10 pl-3 pr-8 border border-[#DDE6ED] rounded-[10px] bg-white text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] outline-none cursor-pointer hover:bg-gray-50 transition-colors">
              <option value="">Semua tipe</option>
              <option value="pilihan_ganda">Pilihan Ganda</option>
              <option value="essay">Essay</option>
            </select>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" class="absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none">
              <polyline points="6 9 12 15 18 9" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
      </div>

      {{-- Soal List --}}
      <div class="flex flex-col">

        {{-- Header --}}
        <div class="flex items-center bg-[#F8FAFC] h-[40px] px-5 border-b border-[#E6EDF2]">
          <div class="shrink-0 w-8 flex items-center">
            <input type="checkbox"
              :checked="isAllSelected"
              :indeterminate.prop="isIndeterminate"
              @change="toggleAll()"
              class="accent-[#147D92] w-4 h-4 cursor-pointer rounded">
          </div>
          <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] flex-1 min-w-0 pr-4">PERTANYAAN</div>
          <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[120px]">KATEGORI</div>
          <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[110px]">TIPE</div>
          <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em] shrink-0 w-[70px]">SKOR</div>
        </div>

        {{-- Row 1 --}}
        <label :class="selected.includes(1) ? 'bg-[#F0FAFA]' : 'bg-white'" class="flex items-center min-h-[64px] px-5 border-b border-[#E6EDF2] cursor-pointer hover:bg-[#F8FAFC] transition-colors">
          <div class="shrink-0 w-8 flex items-center">
            <input type="checkbox" name="soal[]" value="1" x-model="selected" :value="1"
              class="accent-[#147D92] w-4 h-4 cursor-pointer rounded">
          </div>
          <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
            <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
              Jika A lebih besar dari B dan B lebih besar dari C, maka...
            </div>
            <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
              Dibuat 08 Agu 2026 &middot; Nadia Putri
            </div>
          </div>
          <div class="shrink-0 w-[120px]">
            <span class="inline-flex items-center justify-center bg-[#E7EEF9] rounded-[6px] h-6 px-2.5">
              <span class="text-[#3B5B93] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Logika</span>
            </span>
          </div>
          <div class="shrink-0 w-[110px]">
            <span class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 px-2.5">
              <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan ganda</span>
            </span>
          </div>
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold shrink-0 w-[70px]">10 poin</div>
        </label>

        {{-- Row 2 --}}
        <label :class="selected.includes(2) ? 'bg-[#F0FAFA]' : 'bg-white'" class="flex items-center min-h-[64px] px-5 border-b border-[#E6EDF2] cursor-pointer hover:bg-[#F8FAFC] transition-colors">
          <div class="shrink-0 w-8 flex items-center">
            <input type="checkbox" name="soal[]" x-model="selected" :value="2"
              class="accent-[#147D92] w-4 h-4 cursor-pointer rounded">
          </div>
          <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
            <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
              Ceritakan pencapaian profesional yang paling Anda banggakan.
            </div>
            <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
              Dibuat 07 Agu 2026 &middot; rubrik penilaian tersedia
            </div>
          </div>
          <div class="shrink-0 w-[120px]">
            <span class="inline-flex items-center justify-center bg-[#EFE9FB] rounded-[6px] h-6 px-2.5">
              <span class="text-[#7257B7] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Kompetensi</span>
            </span>
          </div>
          <div class="shrink-0 w-[110px]">
            <span class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 px-2.5">
              <span class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Essay</span>
            </span>
          </div>
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold shrink-0 w-[70px]">20 poin</div>
        </label>

        {{-- Row 3 --}}
        <label :class="selected.includes(3) ? 'bg-[#F0FAFA]' : 'bg-white'" class="flex items-center min-h-[64px] px-5 border-b border-[#E6EDF2] cursor-pointer hover:bg-[#F8FAFC] transition-colors">
          <div class="shrink-0 w-8 flex items-center">
            <input type="checkbox" name="soal[]" x-model="selected" :value="3"
              class="accent-[#147D92] w-4 h-4 cursor-pointer rounded">
          </div>
          <div class="flex flex-col flex-1 gap-[3px] min-w-0 pr-4">
            <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
              Sebuah proyek diselesaikan dalam 4 tahap: analisis, desain, implementasi, dan evaluasi...
            </div>
            <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
              Dibuat 05 Agu 2026 &middot; Nadia Putri
            </div>
          </div>
          <div class="shrink-0 w-[120px]">
            <span class="inline-flex items-center justify-center bg-[#E7F6EE] rounded-[6px] h-6 px-2.5">
              <span class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Manajerial</span>
            </span>
          </div>
          <div class="shrink-0 w-[110px]">
            <span class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 px-2.5">
              <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan ganda</span>
            </span>
          </div>
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-semibold shrink-0 w-[70px]">15 poin</div>
        </label>

        {{-- Footer soal list --}}
        <div class="flex items-center justify-between h-[52px] px-5">
          <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[18px]">
            Menampilkan 3 dari 24 soal tersedia
            &bull; <span x-text="selected.length" class="font-semibold text-[#102A43]">0</span> dipilih
          </div>
          <button type="button" class="font-['Inter',system-ui,sans-serif] text-[#147D92] text-[13px]/[16px] font-semibold bg-transparent border-none cursor-pointer hover:underline">
            Lihat semua soal →
          </button>
        </div>

      </div>
    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end gap-3">
      <a href="{{ url('/hr/test-packages') }}"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
          Batal
        </div>
      </a>
      <button type="submit" name="action" value="draft"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
          Simpan sebagai draft
        </div>
      </button>
      <button type="submit" name="action" value="aktif"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]">
          Buat &amp; aktifkan paket
        </div>
      </button>
    </div>

  </form>
</div>

@endsection
